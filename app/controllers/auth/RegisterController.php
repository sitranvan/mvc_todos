<?php
class RegisterController extends Controller
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
        $this->data['payload']['errors'] = Session::flash('errors');
        $this->data['payload']['pre_data'] = Session::flash('pre_data');
        $this->data['payload']['msg'] = Session::flash('msg');
        $this->data['payload']['msg_type'] = Session::flash('msg_type');
        $this->data['title'] = 'Đăng ký';
        $this->data['view'] = 'auth/register';
        $this->render('layouts/layout_public', $this->data);
    }
    public function register()
    {
        $request = new Request();
        $validate = new Validate();
        if ($request->isPost()) {
            // Validate
            $validate->username(unique: true);
            $validate->email(unique: true);
            $validate->password();
            $validate->confirmPassword();
        }
        if (empty($validate->getErrors())) {
            // Xử lý thêm dữ liệu vào database
            $dataField = $validate->getDataField();
            $dataInsert = [
                'username' => $dataField['username'],
                'email' => $dataField['email'],
                'password' => password_hash($dataField['password'], PASSWORD_DEFAULT),
                'create_at' => date('Y-m-d H:i:s')
            ];
            $status = $this->usersModel->insertUser($dataInsert);
            if ($status) {
                Session::flash('msg', 'Đăng ký tài khoản thành công!');
                Session::flash('msg_type', 'success');
                Response::redirect('dang-nhap');
            } else {
                Session::flash('msg', 'Hệ thống đang gặp lỗi!');
                Session::flash('msg_type', 'danger');
            }
        } else {
            Session::flash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào!');
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('dang-ky');
    }
}
