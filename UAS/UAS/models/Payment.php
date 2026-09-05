<?php
class Payment
{
    private $conn;
    private $table = "payments";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($bookingId, $amount, $method)
    {
        $sql = "INSERT INTO {$this->table} (booking_id, amount, payment_method) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$bookingId, $amount, $method]);
    }

    public function getAll()
    {
        $sql = "SELECT id, booking_id, amount, payment_status FROM {$this->table}";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $status, $proofUrl)
    {
        $sql = "UPDATE {$this->table} SET payment_status = ?, proof_url = ?, paid_at = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $proofUrl, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}