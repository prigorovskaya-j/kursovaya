<?php

namespace app\controllers;

use app\core\Controller;
use app\models\TestModel;

class TestController extends Controller {

    public function indexAction(){
        $errors = [];
        $testData = [];
        $testResults = TestModel::all("created_at");

        if( !empty( $_POST ) ){
            $errors = $this->model->Validate($_POST);

            if( count( $errors ) == 0 ){
                $testData = $this->save();
            }
        }

        $this->view->render("Тест по дисциплине (БЖД)", [
            "menuIndex" => 7,
            "errors" => $errors,
            "testData" => $testData,
            "testResults" => $testResults,
        ]);
    }

    function save(){
        $test = new TestModel();

        $test->fio = $_POST["fio"];
        $test->created_at = date('Y-m-d');
        $test->q_1 = $_POST["q_1"] == "4";
        $test->q_2 = $_POST["q_2"] == 2;
        $test->q_3 = $_POST["q_3"] == "2";

        $test->save();
        return $test;
    }

}