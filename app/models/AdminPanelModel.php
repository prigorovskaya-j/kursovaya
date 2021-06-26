<?php

namespace app\models;

use app\core\BaseActiveRecord;

class AdminPanelModel extends BaseActiveRecord
{
    public $adminItems;

    public function __construct()
    {
        $this->adminItems = [
            "/blog/edit" => "Редактировать новость",
            "/blog/load" => "Загрузить новость",
            "/guest-book/load" => "Загрузить файл для книги предложений",
            "/catalog/edit" => "Редактировать  каталог",
            "/catalog/load" => "Добавить в каталог",
            "/admin/logout" => "Выйти из системы",
        ];
    }
}