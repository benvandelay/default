<?php

/**
 * This is the model class for table "prints".
 *
 * The followings are the available columns in table 'prints':
 * @property string $page_type_id
 * @property string $name
 */
class PageType extends CActiveRecord
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

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'page_type';
    }
    
    public function attributeLabels()
    {
        return array(
            'name' => 'Type',
        );
    }
    
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'page' => array(self::HAS_MANY, 'Page', 'page_type_id'),
        );
    }
}