<?php
class AuthMiddleware
{
    private $model;
    public function __construct()
    {
        $this->model = Load::model('auth/UsersModel');
    }
    // Đã đăng nhập
    public function isAuthenticated()
    
    {
        $this->saveLastActivity();
        $this->autoRemoveToken();
        $getCookieToken = Cookie::get('token_login');
        if (isset($getCookieToken)) {
            $tokenLogin = Cookie::get('token_login');
            Session::data('token_temp', $tokenLogin);
            $checkLogin = $this->model->checkUserLogin("token='$tokenLogin'");
            if (empty($checkLogin)) {
                $this->model->deleteUserLogin("token='$tokenLogin'");
                Cookie::set('token_login', expires: time() - _COOKIE_EXPIRATION_TIME);
                Response::redirect('dang-nhap');
            }
        } else {
            $tokenLogin = Session::data('token_temp');
            $this->model->deleteUserLogin("token='$tokenLogin'");
            Cookie::set('token_login', expires: time() - _COOKIE_EXPIRATION_TIME);
            Response::redirect('dang-nhap');
        }
    }
    public function saveLastActivity()
    {
        $tokenLogin = Cookie::get('token_login');
        $dataUpdate = [
            'last_activity' => date('Y-m-d H:i:s')
        ];
        $this->model->updateLogin($dataUpdate, "token='$tokenLogin'");
    }
    public function autoRemoveToken()
    {
        $allLogin = $this->model->getAllLogin();
        foreach ($allLogin as $item) {
            $targetDateTime = new DateTime($item['last_activity']);
            $currentDateTime = new DateTime();
            $totalDaysDifference = Utils::getDaysDifference($targetDateTime, $currentDateTime);
            if ($totalDaysDifference >= _EXPIRATION_LAST_ACTIVITY) {
                $tokenLogin = $item['token'];
                $this->model->deleteUserLogin("token='$tokenLogin'");
            }
        }
    }
    // Chưa đăng nhập
    public function isNotAuthenticated()
    {
        $getCookieToken = Cookie::get('token_login');
        if (isset($getCookieToken)) {
            Response::redirect('danh-sach');
        }
    }
}
