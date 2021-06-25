<?php


namespace app\models;

use app\core\Model;

class GuestBookModel extends Model
{
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
        if( $_SERVER["REQUEST_URI"] == "/guest-book" ){
            $this->validator->SetRule("fio", "checkFio");
            $this->validator->SetRule("email", "isEmail");
            $this->validator->SetRule("text", "isEmpty", "текст сообщения");
        }
        $this->errors = $this->validator->Validate($_POST);
    }

    public function saveMessageToFile($filename){
        $postData = [];

        foreach ($_POST as $key => $value){
            $postData[$key] = htmlspecialchars($value);
        }

        $messageData = $postData["fio"] . ";" . $postData["email"] . ";" . $postData["text"] . ";" . date("d.m.Y") . "\n***\n";
        file_put_contents($filename, $messageData, FILE_APPEND);
    }

    public function getMessageFromFile($filename){
        return file_get_contents($filename);
    }

    public function messageToArray($messages){
        $messages = explode("\n***\n", $messages);
        array_pop($messages);

        $i = 0;
        foreach ($messages as $message){
            $messages[$i++] = explode(";", $message);
        }

        return array_reverse($messages);
    }
}