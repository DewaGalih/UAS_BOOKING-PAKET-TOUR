<?php
require_once "../models/Tour.php";
require_once "../helpers/response.php";

class TourController
{
    private $tour;

    public function __construct($db)
    {
        $this->tour = new Tour($db);
    }

    public function index()
    {
        jsonResponse($this->tour->getAll());
    }

    public function show($id)
    {
        $data = $this->tour->getById($id);
        $data ? jsonResponse($data) : jsonResponse(["message" => "Tour not found"], 404);
    }

    public function store($data)
    {
        if (!$data['name'] || !$data['price']) {
            jsonResponse(["message" => "Invalid data"], 422);
        }
        $this->tour->create($data['name'], $data['destination'], $data['price'], $data['duration_days'], $data['max_participants']);
        jsonResponse(["message" => "Tour created"]);
    }

    public function update($id, $data)
    {
        $this->tour->update($id, $data['name'], $data['price'], $data['status']);
        jsonResponse(["message" => "Tour updated"]);
    }

    public function destroy($id)
    {
        $this->tour->delete($id);
        jsonResponse(["message" => "Tour deleted"]);
    }
}