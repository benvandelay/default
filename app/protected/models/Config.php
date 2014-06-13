<?php

/**
 * Config class.
 */
class Config extends CActiveRecord
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
        return 'config';
    }

    
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(

        );
    }

}