<?php
class Booking
{
    private $conn;
    private $table = "bookings";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($userId, $tourId, $date, $participants, $total)
    {
        $sql = "INSERT INTO {$this->table} (user_id, tour_id, booking_date, participants, total_price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $tourId, $date, $participants, $total]);
    }

    public function getAll()
    {
        $sql = "SELECT id, user_id, tour_id, booking_date, status FROM {$this->table}";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $status, $notes)
    {
        $sql = "UPDATE {$this->table} SET status = ?, notes = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $notes, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}