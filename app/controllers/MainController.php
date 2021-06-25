<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller
{

    public function indexAction(){

        $vars = [
            "fio" => "Пригоровская Юлия Ивановна",
            "img" => "/public/img/1.jpg",
            "group" => "Чем мы занимаемся?",
            "desc" => "Уже много лет мы предоставляем книги заинтересованным читателям. 
                        <br>Книги современных авторов, творчество совершенно новое - ждет тебя!",
            "menuIndex" => 1
        ];

        $this->view->render("О нас", $vars);
    }

}