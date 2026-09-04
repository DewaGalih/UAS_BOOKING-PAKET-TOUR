<?php

class Database
{
    public function connect()
    {
        return new PDO(
            "mysql:host=localhost;dbname=UAS_BOOKING_PAKET_TOUR;charset=utf8",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
