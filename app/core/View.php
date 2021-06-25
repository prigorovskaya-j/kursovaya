<?php

namespace app\core;

class View {

    public $route;
    public $path;
    public $layout = "default";

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'] . "/" . $route['action'];
    }

    public function render($title, $vars = [], $pageName = ""){
        extract($vars);
        if( $pageName == "" ){
            $viewPage = "app/views/$this->path.php";
        } else {
            $viewPage = "app/views/$pageName.php";
        }

        $menu = [
            "/" => "Главная", //1
            "/aboutMe" => "О компании", //2
            "/interests" => "Интересы",//3
            "/education" => "Учеба", //4
            "/album" => "Фотоальбом",//5
         //   "/contacts" => "Контакты", //6
            "/test" => "Тест по дисциплине", //7
            "/history" => "История", //8
            "/guest-book" => "Гостевая книга", //9
            "/blog" => "Новости", //10
            "/catalog" => "Каталог", //10
            //visit-11
        ];

        if( file_exists( $viewPage ) ){
            ob_start();
            require $viewPage;
            $content = ob_get_clean();
            require "app/views/layouts/$this->layout.php";
        } else {
            echo "Не найден вид $this->path";
        }
    }

    public static function redirect($url){
        header("location: $url");
        exit;
    }

    public static function errorCode($code){
        http_response_code($code);
        $errorPage = "app/views/errors/$code.php";
        if( file_exists( $errorPage ) ){
            require $errorPage;
        }
        exit;
    }

}
