<?php

namespace app\models;

use app\core\BaseActiveRecord;

class AdminPanelModel extends BaseActiveRecord
{
    public $adminItems;

    public function __construct()
    {
        $this->adminItems = [
            "/blog/edit" => "Редактировать блог",
            "/blog/load" => "Загрузить сообщения блога",
            "/guest-book/load" => "Загрузить файл для гостевой книги",
            "/catalog/edit" => "Редактировать  товар",
            "/catalog/load" => "Добавить товар",
            "/admin/logout" => "Выйти из системы",
        ];
    }
}