<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // REGISTER USER
    public function register($data)
    {
        //QUERY TO ADD USERS
        $this->db->query('INSERT INTO users (name,email,password) VALUES(:name, :email, :password)');
        //BIND VALUES
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //EXECUTE
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // LOGIN USER
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;

        // CHECK THE ENTERED PASSWORD AND THE CRYPTED PASSWORD IN DB
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // FIND USER BY EMAIL
    public function findUserByEmail($email)
    {
        // QUERY TO CHECK IF EMAILS EXISTS BEFORE REGISTRATION
        $this->db->query('SELECT * FROM users WHERE email = :email');
        //BIND VALUES
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
