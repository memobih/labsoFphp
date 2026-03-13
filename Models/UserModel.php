<?php

namespace Models;

use Core\Database;
use mysqli;

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $result = $this->conn->query($sql);
        
        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createUser($data) {
        $sql = "INSERT INTO users (fname, lname, address, country, gender, skills, username, password, department, profile_pic) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bind_param(
            "ssssssssss", 
            $data['fname'], 
            $data['lname'], 
            $data['address'], 
            $data['country'], 
            $data['gender'], 
            $data['skills'], 
            $data['username'], 
            $data['password'], 
            $data['department'],
            $data['profile_pic']
        );
        
        return $stmt->execute();
    }

    public function updateUser($id, $data) {
        $updateFields = [
            "fname = ?", 
            "lname = ?", 
            "address = ?", 
            "country = ?", 
            "gender = ?", 
            "skills = ?", 
            "username = ?", 
            "department = ?"
        ];
        
        $params = [
            $data['fname'], 
            $data['lname'], 
            $data['address'], 
            $data['country'], 
            $data['gender'], 
            $data['skills'], 
            $data['username'], 
            $data['department']
        ];
        $types = "ssssssss";

        if (!empty($data['password'])) {
            $updateFields[] = "password = ?";
            $params[] = $data['password'];
            $types .= "s";
        }

        if (!empty($data['profile_pic'])) {
            $updateFields[] = "profile_pic = ?";
            $params[] = $data['profile_pic'];
            $types .= "s";
        }

        $params[] = $id;
        $types .= "i";

        $sql = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
