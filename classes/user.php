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

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
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
        $check = $this->db->prepare("SELECT user_id FROM users WHERE email = :email");
        $check->bindValue(":email", $this->email);
        $check->execute();

        if ($check->fetch()) {
            return false; 
        }

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $query = $this->db->prepare(
            "INSERT INTO users (email, password, role, balance)
             VALUES (:email, :password, :role, :balance)");

        $query->bindValue(":email", $this->email);
        $query->bindValue(":password", $hashedPassword);
        $query->bindValue(":role", $this->role ?? 'user');
        $query->bindValue(":balance", $this->balance ?? 1000);

        return $query->execute();
    }

    // Fixed this method to match your class properties
    public function deductBalance($user_id, $amount) {
        $query = "UPDATE users SET balance = balance - :amount 
                  WHERE user_id = :user_id AND balance >= :amount";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':amount', $amount);
        return $stmt->execute();
    }

    public function find($id) {
        $query = $this->db->prepare("SELECT * FROM users WHERE user_id = :id");
        $query->bindValue(":id", $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}