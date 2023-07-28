<?php
$publicRoutes = [
    'dang-ky',
    'dang-nhap',
    'quen-mat-khau',
    'khoi-phuc-mat-khau'
];
$privateRoutes = [
    'doi-mat-khau',
    'dang-xuat',
    'danh-sach',
    'them-cong-viec',
    'sua-cong-viec/(.+)',
    'xoa-cong-viec/(.+)',
    'chi-tiet/(.+)',
];

$authMiddleware = AuthMiddleware::class;
$providerMiddleware = ProviderMiddleware::class;
$checkMiddleware = CheckMiddleware::class;
