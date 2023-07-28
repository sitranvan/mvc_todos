<?php
class ResetController extends Controller
{
    private $usersModel;
    private $data;
    public function __construct()
    {
        $this->usersModel = $this->loadModel('auth/UsersModel');
        $this->data = [];
    }
    public function index()
    {
        $request = new Request();
        $this->data['payload']['errors'] = Session::flash('errors');
        $this->data['payload']['pre_data'] = Session::flash('pre_data');
        $this->data['payload']['msg'] = Session::flash('msg');
        $this->data['payload']['msg_type'] = Session::flash('msg_type');
        $this->data['title'] = 'Khôi phục mật khẩu';
        $this->data['view'] = 'auth/reset';
        $forgotToken = $request->getBody()['token'];
        Session::data('forgot_token', $forgotToken);
        $userInfo = $this->usersModel->getUser("forgot_token='$forgotToken'");
        if (empty($userInfo)) {
            App::getApp()->renderError();
        } else {
            $this->render('layouts/layout_public', $this->data);
        }
    }
    public function reset()
    {
        $forgotToken =  Session::data('forgot_token');
        $request = new Request();
        $validate = new Validate();
        if ($request->isPost()) {
            // Validate
            $validate->password();
            $validate->confirmPassword();
        }
        if (empty($validate->getErrors())) {
            if (!empty($forgotToken)) {
                $userInfo = $this->usersModel->getUser("forgot_token='$forgotToken'");
                $userId = $userInfo['id'];
                $password = $validate->getDataField()['password'];
                $dataUpdate = [
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'forgot_token' => null,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->usersModel->updateUser($dataUpdate, "id='$userId'");
                if ($status) {
                    Session::flash('msg', 'Khôi phục mật khẩu thành công!');
                    Session::flash('msg_type', 'success');
                    Response::redirect('dang-nhap');
                } else {
                    Session::flash('msg', 'Có lỗi xảy ra, thử lại sau!');
                    Session::flash('msg_type', 'danger');
                }
            }
        } else {
            Session::flash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào!');
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('khoi-phuc-mat-khau?token=' . $forgotToken);
    }
}
