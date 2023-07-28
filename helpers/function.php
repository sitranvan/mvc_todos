<?php
function loadLayout($layout = '', $title = '')
{
    $fileLayout = _DIR_ROOT . '/app/views/layouts/' . $layout . '.php';
    if (file_exists($fileLayout)) {
        require_once $fileLayout;
    } else {
        require_once _DIR_ROOT . '/app/views/errors/layout.php';
    }
}

function invalid($errors = [], $fieldName = '')
{
    return isset($errors[$fieldName]) ? 'is-invalid' : 'border-primary-subtle';
}

function showMessage($msg = '', $msgType = '')
{
    if (isset($msg) && isset($msgType)) {
        return
            '<div class="alert py-3 alert-' . $msgType . '" role="alert">
                ' . $msg . '
             </div>';
    }
}

function linkRoute($route = '/')
{
    return _WEB_ROOT . '/' . $route;
}

function getValueEdit($preData = [], $dataEdit = [])
{
    if (empty($preData) && !empty($dataEdit)) {
        return $dataEdit;
    }
    return $preData;
}

function isSelected($data = [])
{
    if ($data['is_completed'] == 1) {
        return 'selected';
    }
}

function getSelected($data = '', $value = '')
{
    if (isset($data) && $data == $value) {
        return 'selected';
    }
}

function getDueDate($dueDate = '')
{
    if (!empty($dueDate)) {
        return date('Y-m-d', strtotime($dueDate));
    }
}
