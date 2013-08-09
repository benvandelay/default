<?php

/**
 * This is the model class for table "prints".
 *
 * The followings are the available columns in table 'prints':
 * @property string $id
 * @property string $page
 * @property string $filename
 * @property string $caption
 * @property string $date
 */
class Image extends CActiveRecord
{
    public $search;
    public $doCrop = false;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Prints the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, title', 'length', 'max'=>200),
			array('filename, title', 'required'),
			array('date, body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, filename, title, date', 'safe', 'on'=>'search'),
		);
	}

    public function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord || $this->doCrop){

                $targetFile = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/' . Yii::app()->params['image']['uploadPath'] . '/' . $this->filename;
                $cropper = new CropImage;
                foreach(Yii::app()->params['image']['size'] as $size=>$dem)
                {
                    $cropper->process($targetFile, $dem['width'], $dem['height'], rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/' . Yii::app()->params['image']['uploadPath'] . '/' . $size.'_'.$this->filename);
                }
                
            }
            
            if(!$this->isNewRecord) unset($this->date);

            
        }
        return true;
     }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'filename' => 'Filename',
			'title' => 'Title',
			'date' => 'Date',
		);
	}

    public function afterFind()
    {
        $this->date = date('M d Y', strtotime($this->date));
        parent::afterFind();
    } 

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->search,true, 'OR');
		$criteria->compare('date',$this->search,true, 'OR');
        
        $sort = new CSort();
        $sort->attributes = array(
            'date'=>array(
                'asc'=>'id ASC',
                'desc'=>'id DESC', 
            ),
            '*', // this adds all of the other columns as sortable
        );
        $sort->defaultOrder = array(
            'date'=>'id DESC',
        );
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>$sort,
		));
	}
}