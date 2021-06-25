<?php

namespace app\controllers;

use app\core\Controller;

class AboutMeController extends Controller {

    public function indexAction(){
        $vars = [
            "img" => "/public/img/1.jpg",
            "text" => "<p> Немного о компании~</p>
    <p>Делаем то-то и то-то.</p>
    <p>А еще это</p>
    <p>А находимся мы тут.</p>
    <p>А вот и карта</p>
    <p></p>",
            "menuIndex" => 2
        ];

        $this->view->render("О компании", $vars);
    }

}