<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CActiveRecord {

    public $username;
    public $password;
    public $email;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function tableName() {
        return 'cklt_user';
    }
    
    public function rules() {
        return array(
            // username and password are required
            array('username, password, email', 'required'),
            array('username, email', 'unique'),
            array('email', 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => 'Remember me next time',
        );
    }

    protected function beforeSave() {
        $this->password = User::model()->md5Cklt($this->password);
        $this->active_date = date("Y-m-d H:i:s",  time());
        return true;
    }

}
