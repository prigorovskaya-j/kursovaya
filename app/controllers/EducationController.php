<?php

namespace app\controllers;

use app\core\Controller;

class EducationController extends Controller {

    public function indexAction(){
        $vars = [
            "menuIndex" => 4
        ];

        $this->view->render("Учёба", $vars);
    }

}