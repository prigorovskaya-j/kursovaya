<?php

namespace app\models;

use app\core\Model;

class AlbumModel extends Model {
    private $photoNames;

    public function generatePhotoNames(){
        for ($i = 1; $i <= 15; $i++){
            $this->photoNames["public/img/$i.jpg"] = "Автор $i";
        }
    }

    public function getPhotoNames() {
        $this->generatePhotoNames();
        return $this->photoNames;
    }
}