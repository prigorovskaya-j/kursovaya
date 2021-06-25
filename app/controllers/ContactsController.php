<?php

namespace app\controllers;

use app\core\Controller;

class ContactsController extends Controller {

    public function indexAction(){
        $vars = [
            "menuIndex" => 6
        ];

        if( !empty( $_POST ) ){
            $vars["errors"] = $this->model->errors;
        }

        $this->view->render("Контакты", $vars);

    }

}