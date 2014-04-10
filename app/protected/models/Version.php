<?php

/**
 * Category class.
 */
class Version extends CActiveRecord
{
    public $version_count  = 0;
    public $latest = 0;
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
        return 'version';
    }

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('body, header, sub_header, image_id', 'safe')
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
            
            'image'=>array(self::BELONGS_TO, 'Image', 'image_id')
            
        );
    }
    
    public function getCount()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'COUNT(page_id) as version_count';
        $criteria->condition = ('page_id = ' . $this->page_id);
        return self::model()->find($criteria)->version_count;
    }
    
    public function getLatestId($page_id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id as latest';
        $criteria->condition = ('page_id = ' . $page_id);
        $criteria->order = 'id DESC';
        $criteria->limit = 1;
        return self::model()->find($criteria)->latest;
    }

    public function getIds($page_id)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, date';
        $criteria->condition = ('page_id = ' . $page_id);
        $criteria->order = 'id ASC';
        $result = self::model()->findAll($criteria);
        
        $array = array();
        
        foreach($result as $key=>$obj){
            $array[$obj->id] = array(
                'version'   => $key + 1,
                'date'      => $obj->date,
                'id'        => $obj->id,
            );
        }
        
        return array_reverse($array, true);
    }
}