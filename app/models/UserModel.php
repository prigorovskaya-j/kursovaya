<?php


namespace app\models;

use app\core\BaseActiveRecord;

class UserModel extends BaseActiveRecord
{
    protected static $tablename = 'users';

    public $id;
    public $fio;
    public $email;
    public $login;
    public $password;

    public function __construct()
    {
        parent::__construct();
        $url = $_SERVER["REQUEST_URI"];
        if( $url == "/user/login" ){
            $this->validator->SetRule("login", "isEmpty", "Логин");
            $this->validator->SetRule("password", "isEmpty", "Пароль");
        } else if( $url == "/user/register" ) {
            $this->validator->SetRule("fio", "checkFio");
            $this->validator->SetRule("email", "isEmail");
            $this->validator->SetRule("login", "isEmpty", "Логин");
            $this->validator->SetRule("password", "isEmpty", "Пароль");
        }
    }

    public function Validate($postData){
        return $this->validator->Validate($postData);
    }
}