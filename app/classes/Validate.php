<?php
class Validate
{
    private $errors;
    private $db;
    private $request;
    public function __construct()
    {
        $this->db = new DataBase();
        $this->errors = [];
        $this->request = new Request();
    }
    public function username($unique = false)
    {
        if (empty(trim($this->request->getBody()['username']))) {
            $this->errors['username'] = 'Tên đăng nhập không bỏ trống';
        } else {
            if (strlen(trim($this->request->getBody()['username'])) < 4) {
                $this->errors['username'] = 'Tên đăng nhập phải >= 4 ký tự';
            } else {
                if ($unique == true) {
                    $username = $this->request->getBody()['username'];
                    $checkExists = $this->db->exists("SELECT id FROM users WHERE username='$username'");
                    if ($checkExists > 0) {
                        $this->errors['username'] = 'Tên đăng nhập đã tồn tại trong hệ thống';
                    }
                }
            }
        }
    }
    public function email($unique = false)
    {
        if (empty(trim($this->request->getBody()['email']))) {
            $this->errors['email'] = 'Email không bỏ trống';
        } else {
            if (!filter_var($this->request->getBody()['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = 'Email không hợp lệ';
            } else {
                if ($unique == true) {
                    $email = $this->request->getBody()['email'];
                    $checkExists = $this->db->exists("SELECT id FROM users WHERE email='$email'");
                    if ($checkExists > 0) {
                        $this->errors['email'] = 'Email đã tồn tại trong hệ thống';
                    }
                }
            }
        }
    }

    public function password($duplicate = false)
    {
        if (empty(trim($this->request->getBody()['password']))) {
            $this->errors['password'] = 'Mật khẩu không bỏ trống';
        } else {
            if (strlen(trim($this->request->getBody()['password'])) < 6) {
                $this->errors['password'] = 'Mật khẩu phải >= 6 ký tự';
            } else {
                if ($duplicate == true) {
                    $userLogin = new UserLogin();
                    $passwordHash = $userLogin->get()['password'];
                    if (password_verify((trim($this->request->getBody()['password'])), $passwordHash)) {
                        $this->errors['password'] = 'Mật khẩu mới phải khác mật khẩu cũ';
                    }
                }
            }
        }
    }

    public function confirmPassword()
    {
        if (empty(trim($this->request->getBody()['confirm_password']))) {
            $this->errors['confirm_password'] = 'Xác nhận mật không bỏ trống';
        } else {
            if (trim($this->request->getBody()['password']) != trim($this->request->getBody()['confirm_password'])) {
                $this->errors['confirm_password'] = 'Mật khẩu không khớp';
            }
        }
    }
    public function requiredTodos($field = null, $fieldName = '', $messError = '')
    {
        if (empty(trim($field))) {
            $this->errors[$fieldName] = $messError;
        }
    }
    public function getDataField()
    {
        return $this->request->getBody();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
