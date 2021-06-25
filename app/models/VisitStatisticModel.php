<?php

namespace app\models;

use app\core\BaseActiveRecord;

class VisitStatisticModel extends BaseActiveRecord
{
    protected static $tablename = 'visit_statistics';

    public $id;
    public $date;
    public $ip_address;
    public $host_name;
    public $browser_name;
}