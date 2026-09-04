<?php
class Tour
{
    private $conn;
    private $table = "tours";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $destination, $price, $duration, $max)
    {
        $sql = "INSERT INTO {$this->table} (name, destination, price, duration_days, max_participants) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $destination, $price, $duration, $max]);
    }

    public function getAll()
    {
        $sql = "SELECT id, name, destination, price, status FROM {$this->table}";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $price, $status)
    {
        $sql = "UPDATE {$this->table} SET name = ?, price = ?, status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $price, $status, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}