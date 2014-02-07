<?php

class AdminUser extends CWebUser
{
    public function isAdmin() {
        return $this->id;
    }
    
    public function resetUserInfo(){
        $user=User::model()->findByPk($this->id);
        $this->setState('permission', $user->permission);
        $this->setState('first_name', $user->first_name);
        $this->setState('last_name', $user->last_name);
        $this->setState('avatar', $user->image->filename);
    }
}