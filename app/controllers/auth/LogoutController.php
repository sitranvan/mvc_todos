<?php
class LogoutController extends Controller
{
    private $usersModel;
    public function __construct()
    {
        $this->usersModel = $this->loadModel('auth/UsersModel');
    }
    public function index()
    {
        $tokenLogin = Cookie::get('token_login');
        if (isset($tokenLogin)) {
            $this->usersModel->deleteUserLogin("token='$tokenLogin'");
            Cookie::set('token_login', expires: time() - _COOKIE_EXPIRATION_TIME);
            session_destroy();
            Response::redirect('dang-nhap');
        }
    }
}
