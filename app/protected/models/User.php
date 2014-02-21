<?php

class User extends CActiveRecord
{
    
    public $search;
    
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
        return 'user';
    }

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(

            array('username, email, password, permission, first_name, last_name, active', 'required'),
            array('username', 'unique', 'attributeName' => 'username', 'className' => 'User'),
            array('username, email, password, permission, first_name, last_name, image_id, active', 'safe'),
            
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {

    }
    
    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            
            'image'=>array(self::BELONGS_TO, 'Image', 'image_id')
            
        );
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

        $criteria->compare('id',$this->id);
        $criteria->compare('first_name',$this->search,true, 'OR');
        $criteria->compare('last_name',$this->search,true, 'OR');
        $criteria->compare('email',$this->search,true, 'OR');
        $criteria->compare('username',$this->search,true, 'OR');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>10,
            
            ),
        ));
    }
}