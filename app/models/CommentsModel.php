<?php

namespace app\models;

use app\core\BaseActiveRecord;
use app\core\Model;

class CommentsModel extends BaseActiveRecord
{
    protected static $tablename = 'comments';

    public $id;
    public $comment_text;
    public $blog_id;

    public function __construct()
    {
        parent::__construct();
    }
}