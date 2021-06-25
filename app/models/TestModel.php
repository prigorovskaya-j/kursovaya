<?php


namespace app\models;

use app\core\BaseActiveRecord;

class TestModel extends BaseActiveRecord
{
    protected static $tablename = 'test';

    public $id;
    public $created_at;
    public $fio;
    public $q_1;
    public $q_2;
    public $q_3;

    public function __construct()
    {
        parent::__construct();
        $this->validator->SetRule("fio", "checkFio");
        $this->validator->SetRule("q_1", "check_q_1");
    }

    public function Validate($postData){
        return $this->validator->Validate($postData);
    }
}