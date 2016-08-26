<?php

namespace App;


class Fundme
{
    public static function getCurrency($amount){
        return number_format($amount, 2, '.', '');
    }
}