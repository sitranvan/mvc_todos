<?php
class UsersModel extends Model
{
    public function getAllLogin()
    {
        return $this->fetchAll('login');
    }

    public function insertUser($data = [])
    {
        return $this->insertRecord('users', $data);
    }

    public function insertLogin($data = [])
    {
        return $this->insertRecord('login', $data);
    }

    public function updateUser($data = [], $condition = '')
    {
        return $this->updateRecord('users', $data, $condition);
    }

    public function getUser($condition = '')
    {
        return $this->fetch('users', '*', $condition);
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
