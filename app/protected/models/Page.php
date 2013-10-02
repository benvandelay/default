<?php

/**
 * This is the model class for table "prints".
 *
 * The followings are the available columns in table 'prints':
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $created
 * @property string $created
 */
class Page extends CActiveRecord
{
    public $search;
    public $page = 0;
    public $categoryIds;
    
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
        return 'page';
    }

    public function getMenu() 
    {
        
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date, body, status, categories, user_id, meta_keywords, meta_description, slug', 'safe'),
            array('title, slug', 'required'),
            array('slug', 'unique', 'allowEmpty'=>false, 'className'=> 'Page'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('slug, date, body, status, title', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'categories'=>array(self::MANY_MANY, 'Category',
                'page_category(page_id, category_id)','index'=>'id'),
            'author'=>array(self::BELONGS_TO, 'User', 'author_id'),
        );
    }
    
    public function behaviors()
    {
        return array(
             'CAdvancedArBehavior' => array('class' => 'application.behaviors.CAdvancedArBehavior'),
        );
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'slug'=>'Url',
            'categoryIds'=>'Category',
        );
    }

    public function afterFind()
    {
        $this->categoryIds = array_keys($this->categories);
        parent::afterFind();
    } 
    
    public function beforeSave()
    {
        parent::beforeSave();
         //$this->modified = new CDbExpression('NOW()');
         //$this->modifier_id = Yii::app()->user->id;
         if($this->isNewRecord) {
             $this->author_id = Yii::app()->user->id;
             $this->categories = -1;
         }
        return true;
    } 
    

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $limit = 10;
        
        $criteria=new CDbCriteria;

        $criteria->compare('title',$this->search,true, 'OR');
        $criteria->compare('date',$this->search,true, 'OR');
        $criteria->limit = $limit;
        $criteria->offset = $this->page * $limit;
        
        $sort = new CSort();
        
        $sort->defaultOrder = array(
            'date'=>'id DESC',
        );
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false,
            'sort'=>$sort,
        ));
    }
}