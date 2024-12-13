<?php
class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getUsers()
    {
        $sql = "SELECT matric, name, role FROM users";
        return $this->conn->query($sql);
    }

    public function getUser($matric)
    {
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($matric, $name, $password, $role) {
        $query = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $matric, $name, $password, $role); // "ssss" indicates 4 string parameters
        return $stmt->execute();
    }
    

    public function updateUser($old_matric, $new_matric, $name, $role) {
        $query = "UPDATE users SET matric = ?, name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $new_matric, $name, $role, $old_matric); // Bind parameters
        return $stmt->execute();
    }
    public function getUserByMatric($matric) {
        $query = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    

    public function deleteUser($matric)
{
    $sql = "DELETE FROM users WHERE matric = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    return $stmt->execute();
}


}
