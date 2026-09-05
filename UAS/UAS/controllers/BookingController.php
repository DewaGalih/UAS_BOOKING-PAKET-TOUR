<?php
require_once "../models/Booking.php";
require_once "../helpers/response.php";

class BookingController
{
    private $booking;

    public function __construct($db)
    {
        $this->booking = new Booking($db);
    }

    public function index()
    {
        jsonResponse($this->booking->getAll());
    }

    public function show($id)
    {
        $data = $this->booking->getById($id);
        $data ? jsonResponse($data) : jsonResponse(["message" => "Booking not found"], 404);
    }

    public function store($data)
    {
        if (!$data['user_id'] || !$data['tour_id']) {
            jsonResponse(["message" => "Invalid data"], 422);
        }
        $this->booking->create($data['user_id'], $data['tour_id'], $data['booking_date'], $data['participants'], $data['total_price']);
        jsonResponse(["message" => "Booking created"]);
    }

    public function update($id, $data)
    {
        $this->booking->update($id, $data['status'], $data['notes']);
        jsonResponse(["message" => "Booking updated"]);
    }

    public function destroy($id)
    {
        $this->booking->delete($id);
        jsonResponse(["message" => "Booking deleted"]);
    }
}