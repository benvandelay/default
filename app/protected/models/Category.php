<?php

/**
 * Category class.
 */
class Category extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Prints the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'category';
    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
             'pages'=>array(self::MANY_MANY, 'Page',
                'page_category(category_id, page_id)'),
        );
    }
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'safe'),
            array('name', 'unique', 'className'=>'Category'),
        );
    }
    
    public function getActiveCategories()
    {
        $criteria=new CDbCriteria;
        $criteria->with = array('pages', 'pages.categories');
        $criteria->addCondition('pages.published_version IS NOT NULL AND pages.published_version != 0');
        $criteria->group = 't.name';
        $criteria->distinct = true;
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false,
        ));
    }
    
    public function search($term, $limit = 10)
    {

        $criteria=new CDbCriteria;
        $criteria->compare('name', $term, true);
        $criteria->limit = $limit;

        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => false,
        ));
    }


}