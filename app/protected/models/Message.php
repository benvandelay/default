<?php
class Message extends CActiveRecord
{
	public $search;
    public $verifyCode;
    public $page = 0;
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
        return 'message';
    }

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required

			array('name', 'required', 'message'=>'You must have at least a first name to talk to me', 'on'=>'insert'),
			array('email', 'required', 'message'=>'How am I supposed to reach you? ESP?', 'on'=>'insert'),
			array('body', 'required', 'message'=>'Nothing to say? Nothing at all?', 'on'=>'insert'),
			// email has to be a valid email address
			array('email', 'email', 'message'=>'You and I both know that\'s not a valid email address', 'on'=>'insert'),
			array('phone','match','pattern'=>'^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$^', 'message'=>'umm... that\'s not a phone number..', 'on'=>'insert'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'insert'),
			
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
    
    public function beforeSave()
    {
        parent::beforeSave();
        unset($this->date);
        return true;
    }
    
    public function scopes() {
        return array(
            'all'=>array(
                'condition'=>'t.status != 2',
            ),
            'unread'=>array(
                'condition'=>'t.status = 0',
            ),
            'read'=>array(
                'condition'=>'t.status = 1',
            ),
            'deleted'=>array(
                'condition'=>'t.status = 2',
            ),
        );
    }
    
    public function search($scope = false)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $limit = 10;

        if($scope) $criteria->scopes= $scope;

        $criteria->compare('name',$this->search,true, 'OR');
        $criteria->compare('email',$this->search,true, 'OR');
        $criteria->compare('body',$this->search,true, 'OR');
        $criteria->compare('phone',$this->search,true, 'OR');
        
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