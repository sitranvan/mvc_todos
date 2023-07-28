<?php
class LoginController extends Controller
{
    private $usersModel;
    private $loginModel;
    private $data;

    public function __construct()
    {
        $this->usersModel = $this->loadModel('auth/UsersModel');
        $this->loginModel = $this->loadModel('auth/LoginModel');
        $this->data = [];
    }
    public function index()
    {
        // Payload là giá trị gửi từ layout qua các view action tương ứng, vì gửi dữ liệu bây giờ không trực tiếp qua view nữa mà thông qua 
        // layout
        $this->data['payload']['errors'] = Session::flash('errors');
        $this->data['payload']['pre_data'] = Session::flash('pre_data');
        $this->data['payload']['msg'] = Session::flash('msg');
        $this->data['payload']['msg_type'] = Session::flash('msg_type');
        $this->data['title'] = 'Đăng nhập';
        $this->data['view'] = 'auth/login';
        $this->render('layouts/layout_public', $this->data);
    }
    public function login()
    {
        $request = new Request();
        $validate = new Validate();
        if ($request->isPost()) {
            // Validate
            $validate->email();
            $validate->password();
        }
        if (empty($validate->getErrors())) {
            // Xử lý thêm dữ liệu vào database
            $email = $validate->getDataField()['email'];
            $password = $validate->getDataField()['password'];
            $userLogin = $this->usersModel->getUser("email='$email'");
            if (!empty($userLogin)) {
                $userId = $userLogin['id'];
                $passwordHash = $userLogin['password'];
                if (password_verify($password, $passwordHash)) {
                    $tokenLogin = sha1(uniqid() . time());
                    $dataInsert = [
                        'user_id' => $userId,
                        'token' => $tokenLogin,
                        'create_at' => date('Y-m-d H:i:s'),
                    ];
                    $status = $this->loginModel->insertLogin($dataInsert);
                    if ($status) {
                        setcookie('token_login', $tokenLogin, time() + _COOKIE_EXPIRATION_TIME, '/');
                        Response::redirect('danh-sach');
                    } else {
                        Session::flash('msg', 'Hệ thống đang gặp lỗi!');
                        Session::flash('msg_type', 'danger');
                    }
                } else {
                    Session::flash('msg', 'Mật khẩu chưa chính xác!');
                    Session::flash('msg_type', 'danger');
                    Session::flash('pre_data', $validate->getDataField());
                }
            } else {
                Session::flash('msg', 'Email chưa chính xác!');
                Session::flash('msg_type', 'danger');
                Session::flash('pre_data', $validate->getDataField());
            }
        } else {
            Session::flash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào!');
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('dang-nhap');
    }
}
