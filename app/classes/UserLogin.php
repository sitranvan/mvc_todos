<?php
class UserLogin
{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase();
    }
    public function get()
    {
        $tokenLogin = Cookie::get('token_login');
        if (isset($tokenLogin)) {
            $query = "SELECT u.* FROM users u
            JOIN login l ON l.user_id = u.id
            WHERE l.token = '$tokenLogin'";
            return $this->db->get($query);
        }
    }
}
