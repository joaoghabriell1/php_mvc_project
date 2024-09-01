<?php


class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Find user by email
    public function findUserByEmail($email)
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $this->db->query($query);
        $this->db->bind(':email', $email, PDO::PARAM_STR);

        $this->db->getSingle();


        if ($this->db->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getUserById($user_id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $user_id);

        $row = $this->db->getSingle();


        return $row;
    }

    public function register($data)
    {
        $query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
        $this->db->query($query);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':password', $data['password']);
        $result = $this->db->execute();

        return $result;
    }


    public function login($email, $password)
    {

        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind('email', $email);

        $row = $this->db->getSingle();

        $passwordIsCorrect = password_verify($password, $row->password);

        if ($passwordIsCorrect) {
            return $row;
        }

        return false;
    }
}
