<?php

namespace app\controllers;

use app\core\Controller;

class HistoryController extends Controller {

    public function indexAction(){
        $vars = [
            "menuIndex" => 8
        ];

        $this->view->render("История", $vars);
    }

}