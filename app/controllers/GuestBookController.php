<?php


namespace app\controllers;

use app\core\Controller;

class GuestBookController extends Controller
{

    public function indexAction()
    {
        $errors = [];

        if (!empty($_POST)) {
            $errors = $this->model->errors;

            if (count($errors) == 0)
                $this->model->saveMessageToFile("public/messages.inc");
        }

        $message = $this->model->getMessageFromFile("public/messages.inc");
        $message = $this->model->messageToArray($message);

        $this->view->render("Книга предложений", [
            "menuIndex" => 9,
            "messages" => $message,
            "errors" => $errors
        ]);
    }

    public function loadAction(){
        AdminPanelController::authenticate();

        $message = "";
        $errors = [];

        if ( !empty($_FILES) ) {
            $filename = "public/" . $_FILES["file"]["name"];

            if( file_exists( $filename ) && !is_dir( $filename ) ){
                $message = $this->model->getMessageFromFile($filename);
                $message = $this->model->messageToArray($message);
            } else $errors[] = "Файл не существует";
        }

        $this->view->render("Гостевая книга (загрузка файла)", [
                "menuIndex" => 9,
                "messages" => $message,
                "errors" => $errors
            ]);
    }

}