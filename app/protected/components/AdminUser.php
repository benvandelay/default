<?php

class AdminUser extends CWebUser
{
    public function isAdmin() {
        return $this->id;
    }
}