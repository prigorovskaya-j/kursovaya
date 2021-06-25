<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($what, $die = true){
    echo "<pre>";
    var_dump($what);
    echo "</pre>";
    if($die) die();
}