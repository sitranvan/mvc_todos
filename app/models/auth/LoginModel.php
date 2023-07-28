<?php
class LoginModel extends Model
{
    public function getAllLogin()
    {
        return $this->fetchAll('login');
    }

    public function insertLogin($data = [])
    {
        return $this->insertRecord('login', $data);
    }

    public function checkUserLogin($condition = '')
    {
        return $this->checkExists('login', 'id', $condition);
    }

    public function deleteUserLogin($condition = '')
    {
        return $this->deleteRecord('login', $condition);
    }
    public function updateLogin($data = [], $condition = '')
    {
        return $this->updateRecord('login', $data, $condition);
    }
}
