<?php
class ChangePassController extends Controller
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
        $this->data['view'] = 'auth/change_pass';
        $this->data['title'] = 'Đổi mật khẩu';
        $this->render('layouts/layout_private', $this->data);
    }

    public function changePassword()
    {
        $request = new Request();
        $validate = new Validate();
        $userLogin = new UserLogin();
        if ($request->isPost()) {
            // Validate
            $validate->password(duplicate: true);
            $validate->confirmPassword();
        }
        if (empty($validate->getErrors())) {
            $userId = $userLogin->get()['id'];
            $passwordHash = password_hash($validate->getDataField()['password'], PASSWORD_DEFAULT);
            $dataUpdate = [
                'password' => $passwordHash,
                'update_at' =>  date('Y-m-d H:i:s')
            ];
            $status =  $this->usersModel->updateUser($dataUpdate, "id='$userId'");
            if ($status) {
                Session::flash('msg', 'Cập nhật thành công, hãy đăng nhập bằng mật khẩu mới!');
                Session::flash('msg_type', 'success');
                Response::redirect('dang-xuat');
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
        Response::redirect('doi-mat-khau');
    }
}
