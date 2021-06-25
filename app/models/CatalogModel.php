<?php


namespace app\models;

use app\core\BaseActiveRecord;
use app\core\Model;

class CatalogModel extends BaseActiveRecord
{
    protected static $tablename = 'blog';

    public $id;
    public $created_at;
    public $title;
    public $img;
    public $text;

    public function __construct()
    {
        parent::__construct();
        $this->validator->SetRule("title", "isEmpty", "Тема сообщения");
        $this->validator->SetRule("img", "isEmpty", "Изображение");
        $this->validator->SetRule("text", "isEmpty", "Текст сообщения");
    }

    public function Validate($postData){
        return $this->validator->Validate($postData);
    }

    public static function getCSVData($filename){
        $row = 1;
        $result = [];

        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    $result[] = mb_convert_encoding($data[$c], "UTF-8", "CP1251");
                }
            }
            fclose($handle);
        }

        array_shift($result);
        $result = static::messageToArray($result);

        return $result;
    }

    public static function messageToArray($messages){
        $i = 0;
        foreach ($messages as $message){
            $messages[$i++] = explode(";", $message);
        }

        return array_reverse($messages);
    }
}