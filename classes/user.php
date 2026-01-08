<?php
class User {
    private $user_id;
    private $email;
    private $password;
    private $role;
    private $balance;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function login($p_email, $p_password) {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindValue(":email", $p_email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($p_password, $user['password'])) {
            $this->user_id = $user['user_id'];
            $this->email = $user['email'];
            $this->role = $user['role'];
            $this->balance = $user['balance'];
            return true;
        }
        return false;
    }

     public function signup() {
        $check = $this->db->prepare(
            "SELECT user_id FROM users WHERE email = :email");
        $check->bindValue(":email", $this->email);
        $check->execute();

        if ($check->fetch()) {
            return false; 
        }

        $query = $this->db->prepare(
            "INSERT INTO users (email, password, role, balance)
             VALUES (:email, :password, :role, :balance)");

        $query->bindValue(":email", $this->email);
        $query->bindValue(":password", $this->password);
        $query->bindValue(":role", $this->role ?? 'user');
        $query->bindValue(":balance", $this->balance ?? 0);

        return $query->execute();
}}