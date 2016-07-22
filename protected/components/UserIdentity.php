<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
    public $user;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function getUser()
    {
        return User::model()->findByAttributes(array('username' => $this->username));
    }
    
    public function authenticate() {        
        $user = $this->getUser();
        
        if (!isset($user))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($user->password != User::model()->md5Cklt($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else{
            $this->setState("id", "$user->id");
            $this->setState("full_name", $user->full_name);
            $this->setState("group", "$user->group_id");
            $this->setState("dashboard_url", $user->group->dashboard_url);
            $user->updateAll(array("log"=>1, "log_date"=>  date("Y-m-d h:i:s", time())), "username='$this->username'");
            $this->errorCode = self::ERROR_NONE;
        }
        return!$this->errorCode;
    }
    
}