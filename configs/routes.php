<?php
$routesConfig = [
    'default_controller' => 'ListController',
    'danh-sach' => 'todos/ListController',
    'dang-ky' => 'auth/RegisterController',
    'submit-dang-ky' => 'auth/RegisterController/register',
    'dang-nhap' => 'auth/LoginController',
    'submit-dang-nhap' => 'auth/LoginController/login',
    'dang-xuat' => 'auth/LogoutController',
    'quen-mat-khau' => 'auth/ForgotController',
    'submit-quen-mat-khau' => 'auth/ForgotController/forgot',
    'khoi-phuc-mat-khau' => 'auth/ResetController',
    'submit-khoi-phuc-mat-khau' => 'auth/ResetController/reset',
    'doi-mat-khau' => 'auth/ChangePassController',
    'submit-doi-mat-khau' => 'auth/ChangePassController/changePassword',
    'them-cong-viec' => 'todos/AddController',
    'submit-them-cong-viec' => 'todos/AddController/add',
    'sua-cong-viec/(.+)' => 'todos/EditController/index/$1',
    'submit-sua-cong-viec' => 'todos/EditController/edit',
    'chi-tiet/(.+)' => 'todos/DetailController/index/$1',
    'xoa-cong-viec/(.+)' => 'todos/DeleteController/index/$1',
    'danh-dau-hoan-thanh/(.+)' => 'todos/CompletedController/index/$1'
];

/**
 * Với những route có tiền tố submit tức là liên quan đén xử lí form sẽ có 2 đường dẫn
 * 1. Hiển thị view, lỗi
 * 2. Xử lí logic khi submit thành công 
 * -> Với đường dẫn thứ 2 nếu không định nghĩa submit-duong-dan thì trong view action sẽ lấy luôn đường dẫn đến Controller tương ứng
 */
