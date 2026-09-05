<?php
require_once "../models/Payment.php";
require_once "../helpers/response.php";

class PaymentController
{
    private $payment;

    public function __construct($db)
    {
        $this->payment = new Payment($db);
    }

    public function index()
    {
        jsonResponse($this->payment->getAll());
    }

    public function show($id)
    {
        $data = $this->payment->getById($id);
        $data ? jsonResponse($data) : jsonResponse(["message" => "Payment not found"], 404);
    }

    public function store($data)
    {
        if (!$data['booking_id'] || !$data['amount']) {
            jsonResponse(["message" => "Invalid data"], 422);
        }
        $this->payment->create($data['booking_id'], $data['amount'], $data['payment_method']);
        jsonResponse(["message" => "Payment created"]);
    }

    public function update($id, $data)
    {
        $this->payment->update($id, $data['payment_status'], $data['proof_url']);
        jsonResponse(["message" => "Payment updated"]);
    }

    public function destroy($id)
    {
        $this->payment->delete($id);
        jsonResponse(["message" => "Payment deleted"]);
    }
}