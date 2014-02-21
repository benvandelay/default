<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    const ERROR_NOT_ACTIVATED = 3;
    
    public function authenticate()
    {
        $user=User::model()->findByAttributes(array('username'=>$this->username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        //use the one commented out after adding md5 to database
        //else if($user->password!==md5($this->password))
        else if($user->password!==$this->password)
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        elseif(!$user->active)
            $this->errorCode=self::ERROR_NOT_ACTIVATED;
        else
        {
            $this->_id = $user->id;
            
            $avatar = $user->image ? $user->image->filename : '';
            
            //save the following user info in session
            $this->setState('permission', $user->permission);
            $this->setState('first_name', $user->first_name);
            $this->setState('last_name', $user->last_name);
            $this->setState('avatar', $avatar);
            
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    

}