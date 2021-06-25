<?php


namespace app\models\validators;


class CustomFormValidation extends FormValidation {

    public static function check_q_1($str){
        $strArr = explode (" ", $str);

        return false;
//        return count( $strArr ) < 30;
    }

}