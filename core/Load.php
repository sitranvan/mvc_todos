<?php
class Load
{
    public static function model($model = '')
    {
        $fileModel = _DIR_ROOT . '/app/models/' . $model . '.php';
        if (file_exists($fileModel)) {
            require_once $fileModel;
            $modelArr = explode('/', $model);
            $finalModel = end($modelArr);
            if (!empty($finalModel) && class_exists($finalModel)) {
                return new $finalModel();
            }
        }
        return false;
    }
    public static function render($viewPath, $data = [])
    {
        if (!empty(View::$dataShare)) {
            $data = array_merge($data, View::$dataShare);
        }
        extract($data);
        $fileView =  _DIR_ROOT . '/app/views/' . $viewPath . '.php';
        if (file_exists($fileView)) {
            require_once $fileView;
        }
    }
}
