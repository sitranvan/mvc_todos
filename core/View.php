<?php
class View
{
    static public $dataShare = [];
    public static function share($data)
    {
        self::$dataShare = $data;
    }
}
