<?php


namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\UserModel;

class UserController extends Controller
{
    private $errors = [];

    public function loginAction(){
        if( !empty( $_POST ) ){
            $this->errors = $this->model->Validate($_POST);
            if( count( $this->errors ) == 0 ){
                $userData = UserModel::find($_POST["login"], "login");
                if( $userData != null ){
                    if( $userData->password == md5(md5("salt") . $_POST["password"]) ){
                        $_SESSION["user_login"] = $_POST["login"];
                    } else {
                        $this->errors[] = "Неверный пароль";
                    }
                } else {
                    $this->errors[] = "Пользователь с таким логином не найден";
                }
            }
        }

        $this->view->render("Вход", [
            "menuIndex" => 0,
            "errors" => $this->errors
        ]);
    }

    public function registerAction(){
        if( !empty( $_POST ) ){
            $user = new UserModel();
            $this->errors = $user->Validate($_POST);

            if( count( $this->errors ) == 0 ){
                if( UserModel::find($_POST["login"], "login") == null ){
                    $this->save();
                } else {
                    $this->errors[] = "Пользователь с таким логином уже существует";
                }
            }
        }

        $this->view->render("Регистрация", [
            "menuIndex" => 0,
            "errors" => $this->errors
        ]);
    }

    public function checkLoginAction(){
        if( isset( $_GET["login"] ) ){
            header ('Content-Type: text/javascript');
            $loginBusy = UserModel::find($_GET["login"], "login");
            if( $loginBusy == null ){
                echo "checkLogin(false)";
            } else echo "checkLogin(true)";
            die();
        }
    }

    public function logoutAction(){
        $_SESSION['user_login'] = "";
        View::redirect("/");
    }


    public static function isUserLogin(){
        if( !isset($_SESSION["user_login"]) || $_SESSION["user_login"] == "" ){
            return false;
        } else return true;
    }

    function save(){
        $user = new UserModel();

        $user->fio = $_POST["fio"];
        $user->email = $_POST["email"];
        $user->login = $_POST["login"];
        $user->password = md5(md5("salt") . $_POST["password"]);

        $user->save();
    }
}