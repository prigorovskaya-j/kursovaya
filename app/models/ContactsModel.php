<?php


namespace app\models;

use app\core\Model;

class ContactsModel extends Model
{
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
        $this->validator->SetRule("fio", "checkFio");
        $this->validator->SetRule("email", "isEmail");
        $this->validator->SetRule("birthday", "isEmpty", "дата рождения");
        $this->validator->SetRule("message", "isEmpty", "текст сообщения");
        $this->validator->SetRule("phone", "isPhone");
        $this->errors = parent::Validate($_POST);
    }
}