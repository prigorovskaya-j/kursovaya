<?php

namespace app\controllers;

use app\core\Controller;

class InterestsController extends Controller {
    private $content = [];
    private $interests = [];

    public function indexAction(){
        $this->content = $this->model->getContent();
        $this->interests = $this->model->getInterests();

        $vars = [
            "menuIndex" => 3,
            "content" => $this->content,
            "interests" => $this->interests
        ];

        $this->view->render("Мои интересы", $vars);
    }

}