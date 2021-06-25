<?php

namespace app\core;

use app\models\validators\FormValidation;

class Model {
    public $validator;

    public function __construct()
    {
        $this->validator = new FormValidation();
    }
}