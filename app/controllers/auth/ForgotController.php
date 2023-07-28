<?php
class ForgotController extends Controller
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
        $this->data['title'] = 'Quên mật khẩu';
        $this->data['view'] = 'auth/forgot';
        $this->render('layouts/layout_public', $this->data);
    }
    public function forgot()
    {
        $request = new Request();
        $validate = new Validate();
        if ($request->isPost()) {
            // Validate
            $validate->email();
        }
        if (empty($validate->getErrors())) {
            $mailer = new MyMailer();
            $email = $validate->getDataField()['email'];
            $userInfo = $this->usersModel->getUser("email='$email'");
            if (!empty($userInfo)) {
                $userId = $userInfo['id'];
                $forgotToken = sha1(uniqid() . time());
                $dataForgot = [
                    'forgot_token' => $forgotToken,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $status = $this->usersModel->updateUser($dataForgot, "id='$userId'");
                if ($status) {
                    $linkReset = _WEB_ROOT . '/khoi-phuc-mat-khau?token=' . $forgotToken;
                    $subject = 'Yêu cầu khôi phục mật khẩu';
                    $content = 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn Vui lòng nhấn vào link sau để tiến hành khôi phục mật khẩu <br>';
                    $content .= $linkReset;
                    $result = $mailer->sendMail($email, $subject, $content);
                    if ($result) {
                        Session::flash('msg', 'Thành công vui lòng kiểm tra email!');
                        Session::flash('msg_type', 'success');
                    } else {
                        Session::flash('msg', 'Hệ thống đang gặp sự cố!');
                        Session::flash('msg_type', 'danger');
                    }
                }
            } else {
                Session::flash('msg', 'Địa chỉ email không tồn tại trong hệ thống!');
                Session::flash('msg_type', 'danger');
            }
        } else {
            Session::flash('msg', 'Vui lòng kiểm tra lại dữ liệu nhập vào!');
            Session::flash('msg_type', 'danger');
            Session::flash('errors', $validate->getErrors());
            Session::flash('pre_data', $validate->getDataField());
        }
        Response::redirect('quen-mat-khau');
    }
}
