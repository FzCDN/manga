<?php
// src/models/User.php

namespace App\Models;

use App\Models\Database;

class User
{
    private $db;
    private $id;
    private $username;
    private $password;
    private $unique_code;
    private $email;

    public function __construct($db, $id, $username, $password, $unique_code, $email) {
        $this->db = $db;
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->unique_code = $unique_code;
        $this->email = $email;
    }

    public function createUser($username, $password)
    {
        $uniqueCode = uniqid(); // Generate unique code for password encryption

        // Encrypt the password using bcrypt
        $hashedPassword = password_hash($password . $uniqueCode, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO users (username, password, unique_code) VALUES (:username, :password, :unique_code)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':unique_code', $uniqueCode);
        $stmt->execute();

        // Return the newly created user's ID
        return $this->db->lastInsertId();
    }

    public function getUserByUsername($username)
    {
        // Retrieve user data from the database based on the username
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch();

        return $user;
    }
}
