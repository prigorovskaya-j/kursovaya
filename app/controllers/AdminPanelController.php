<?php


namespace app\controllers;

use app\core\Controller;
use app\core\View;

class AdminPanelController extends Controller
{

    public function indexAction()
    {
        $this->view->render("Администратор", [
            "menuIndex" => 0
        ]);
    }

    public function loginAction()
    {
        $errors = [];

        if (!empty($_POST)) {
            $loginRes = $this->login();

            if( !$loginRes ) $errors[] = "Неверный логин или пароль";
        }

        $this->view->render("Вход в раздел администратора", [
            "menuIndex" => 0,
            "errors" => $errors,
        ]);
    }

    public function logoutAction(){
        $_SESSION['isAdmin'] = 0;
        View::redirect("/");
    }

    public function login()
    {
        if (($_POST["login"] == 'admin') && (md5($_POST["password"]) == 'd8578edf8458ce06fbc5bb76a58c5ca4')) {
            $_SESSION['isAdmin'] = 1;
            return true;
        }

        $_SESSION['isAdmin'] = 0;
        return false;
    }

    public static function authenticate(){
        if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] == 0) {
            setcookie("redirect", 1, 0, "/");
            View::redirect("/admin/login");
            die();
        }
    }
}