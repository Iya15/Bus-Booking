<?php
require_once 'db.php';

use MongoDB\BSON\UTCDateTime;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    // Generate a random reference number
    $referenceNo = strtoupper(substr(md5(uniqid()), 0, 8));

    // Get current date and time
    $bookingDateTime = new UTCDateTime();

    // Collect form data
    $busNumber = $_POST['busNumber']; // sent from modal selection
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $modeOfPayment = $_POST['modeOfPayment'];
    $totalFare = (float) $_POST['totalFare'];

    // Prepare booking document
    $bookingData = [
        'bookingReferenceNo' => $referenceNo,
        'bookingDateTime' => $bookingDateTime,
        'busNumber' => $busNumber,
        'passenger' => [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'contactNumber' => $contact
        ],
        'payment' => [
            'totalFare' => $totalFare,
            'modeOfPayment' => $modeOfPayment
        ],
        'status' => 'pending'
    ];

    // Include GCash info if mode is GCash
    if (strtolower($modeOfPayment) === 'gcash') {
        $bookingData['payment']['gcashDetails'] = [
            'name' => $_POST['gcashName'],
            'number' => $_POST['gcashNumber']
        ];
    }

    // Insert into MongoDB
    $result = $db->insertBooking($bookingData);

    echo json_encode([
        'success' => $result->isAcknowledged(),
        'message' => $result->isAcknowledged() ? 'Booking created successfully!' : 'Failed to save booking.'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}