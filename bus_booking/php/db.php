<?php
require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

class Database
{
    private $client;
    private $db;

    public function __construct()
    {
        // Connect to MongoDB (modify this if using auth/remote server)
        $this->client = new Client("mongodb://localhost:27017");
        $this->db = $this->client->bus_booking_system; // Change if using a different DB name
    }

    // Collection accessors
    public function getBusesCollection()
    {
        return $this->db->buses;
    }

    public function getBookingsCollection()
    {
        return $this->db->bookings;
    }

    public function getPassengersCollection()
    {
        return $this->db->passengers;
    }

    // ---------------- BUS FUNCTIONS ----------------

    public function insertBus($busData)
    {
        return $this->getBusesCollection()->insertOne($busData);
    }

    public function getAllBuses()
    {
        return $this->getBusesCollection()->find()->toArray();
    }

    public function getBusByNumber($busNumber)
    {
        return $this->getBusesCollection()->findOne(['busNumber' => $busNumber]);
    }

    public function updateBus($busNumber, $updatedData)
    {
        return $this->getBusesCollection()->updateOne(
            ['busNumber' => $busNumber],
            ['$set' => $updatedData]
        );
    }

    public function deleteBus($busNumber)
    {
        return $this->getBusesCollection()->deleteOne(['busNumber' => $busNumber]);
    }

    // ---------------- BOOKING FUNCTIONS ----------------

    public function insertBooking($bookingData)
    {
        return $this->getBookingsCollection()->insertOne($bookingData);
    }

    public function getBookingsByStatus($status)
    {
        return $this->getBookingsCollection()->find(['status' => $status])->toArray();
    }

    public function getAllBookings()
    {
        return $this->getBookingsCollection()->find()->toArray();
    }

    public function updateBookingStatus($referenceNo, $newStatus)
    {
        return $this->getBookingsCollection()->updateOne(
            ['bookingReferenceNo' => $referenceNo],
            ['$set' => ['status' => $newStatus]]
        );
    }

    // ---------------- PASSENGER FUNCTIONS ----------------

    public function insertPassenger($passengerData)
    {
        return $this->getPassengersCollection()->insertOne($passengerData);
    }

    public function getPassengerByContact($contactNumber)
    {
        return $this->getPassengersCollection()->findOne(['contactNumber' => $contactNumber]);
    }

    public function getAllPassengers()
    {
        return $this->getPassengersCollection()->find()->toArray();
    }
}
