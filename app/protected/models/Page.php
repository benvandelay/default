<?php

/**
 * This is the model class for table "prints".
 *
 * The followings are the available columns in table 'prints':
 * @property string $id
 * @property string $page_type_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $created
 * @property string $created
 */
class Page extends CActiveRecord
{
    public $search;
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
            array('page_type_id, slug, title', 'required'),
           
            array('date, body, status, categories, parent_id, author_id, modified, modifier_id, meta_keywords, meta_description', 'safe'),
            array('slug', 'unique', 'className'=> 'Page'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('page_type_id, slug, date, body, status, title', 'safe', 'on'=>'search'),
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
            'page_type' => array(self::BELONGS_TO, 'PageType', 'page_type_id'),
            'categories'=>array(self::MANY_MANY, 'Category',
                'page_category(page_id, category_id)','index'=>'id'),
                
            'parent_page' => array(self::BELONGS_TO,'Page','parent_id'),
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
            'slug'=>'URL',
            'categoryIds'=>'Category',
            'parent_id'=>'Parent Page'
        );
    }

    public function afterFind()
    {
        $this->date = date('M d Y', strtotime($this->date));
        $this->categoryIds = array_keys($this->categories);
        parent::afterFind();
    } 
    
    public function beforeSave()
    {
        parent::beforeSave();
         $this->modified = new CDbExpression('NOW()');
         $this->modifier_id = Yii::app()->user->id;
         if($this->isNewRecord) {
             $this->author_id = Yii::app()->user->id;
             $this->categories = -1;
         }
        return true;
    } 
    
    public function scopes() {
        return array(
            'parent'=>array(
                'condition'=>'t.page_type_id = 0',
            ),
            'child'=>array(
                'condition'=>'t.page_type_id = 1',
            ),
            'article'=>array(
                'condition'=>'t.page_type_id = 2',
            ),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($scope = false)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        if($scope) $criteria->scopes= $scope;

        $criteria->compare('title',$this->search,true, 'OR');
        $criteria->compare('date',$this->search,true, 'OR');
        $criteria->with=array('page_type');
        
        $sort = new CSort();
        $sort->attributes = array(
            'date'=>array(
                'asc'=>'date ASC',
                'desc'=>'date DESC', 
            ),
            'page_type.name'=>array(
                'asc'=>'page_type.name ASC',
                'desc'=>'page_type.name DESC', 
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