<?php

namespace app\controllers;

use app\core\Controller;

class AlbumController extends Controller {
    private $photoNames;

    public function indexAction(){
        $photoNames = $this->model->getPhotoNames();

        $vars = [
            "photoNames" => $photoNames,
            "menuIndex" => 5
        ];

        $this->view->render("Фотоальбом", $vars);
    }

}