<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // FIND USER BY EMAIL
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //CHECK ROW if SOMETHING WAS FOUND
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
