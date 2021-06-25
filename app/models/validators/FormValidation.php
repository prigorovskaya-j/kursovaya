<?php

namespace app\models\validators;

class FormValidation
{
    private $rules = [];
    private $errors = [];

    public function isEmpty($data){
        return trim( $data ) == "";
    }

    public function isInteger($data){
        return is_numeric($data);
    }

    public function isPhone($data){
        return preg_match('/((8|\+7|\+3)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $data);
    }

    public function checkFio($fio){
        $fioArr = explode(" ", trim($fio) );

        return count($fioArr) < 3 ? false : true;
    }

    public function isEmail($data){
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    public function SetRule($fieldName, $validatorName, $errorText = ""){
        $this->rules[$fieldName] = [$validatorName, $errorText];
    }

    public function Validate($postData){

        if( !empty($postData) ){
            foreach ($this->rules as $fieldName => [$validatorName, $errorText]){
                switch ($validatorName){
                    case "isEmpty":
                        if( $this->isEmpty( $postData[$fieldName] ) ) $this->errors[] = "Поле <span>$errorText</span> должно быть заполнено!";
                        break;
                    case "isInteger":
                        if( !$this->isInteger( $postData[$fieldName] ) ) $this->errors[] = "Поле должно быть числом!";
                        break;
                    case "isEmail":
                        if( !$this->isEmail( $postData[$fieldName] ) ) $this->errors[] = "Неверно введён email!";
                        break;
                    case "check_q_1":
                        if( CustomFormValidation::check_q_1( $postData[$fieldName] ) ) $this->errors[] = "В первом вопросе должно быть минимум 30 слов!";
                        break;
                    case "isPhone":
                        if( !$this->isPhone( $postData[$fieldName] ) ) $this->errors[] = "Неверно введён телефон!";
                        break;
                    case "checkFio":
                        if( !$this->checkFio( $postData[$fieldName] ) ) $this->errors[] = "Введите фамилию имя отчество!";
                        break;
                }
            }
        }

        return $this->errors;
    }

}