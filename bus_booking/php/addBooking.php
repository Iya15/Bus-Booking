<?php
require_once 'db.php';

use MongoDB\BSON\UTCDateTime;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $busesCollection = $db->getCollection('buses');

    // Generate reference number
    $referenceNo = strtoupper(substr(md5(uniqid()), 0, 8));
    $bookingDateTime = new DateTime();

    $modeOfPayment = $_POST['modeOfPayment'] ?? 'Cash';

    if (
        empty($_POST['busNumber']) ||
        empty($_POST['firstName']) ||
        empty($_POST['lastName']) ||
        empty($_POST['contact']) ||
        empty($_POST['totalFare'])
    ) {
        echo json_encode([
            'success' => true,
            'message' => 'Booking created successfully!',
            'bookingReferenceNo' => $referenceNo //  return to JavaScript
        ]);
        exit;
    }

    $busNumber = $_POST['busNumber'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $contact = $_POST['contact'];
    $totalFare = (float) $_POST['totalFare'];

    // Check if bus exists and has available seats
    $bus = $busesCollection->findOne(['busNumber' => $busNumber]);

    if (!$bus) {
        echo json_encode(['success' => false, 'message' => 'Bus not found.']);
        exit;
    }

    if ($bus['availableSeats'] <= 0) {
        echo json_encode(['success' => false, 'message' => 'No available seats.']);
        exit;
    }

    $bookingData = [
        'bookingReferenceNo' => $referenceNo,
        'bookingDateTime' => new UTCDateTime($bookingDateTime->getTimestamp() * 1000),
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

    // Add GCash details only if mode of payment is GCash
    if ($modeOfPayment === 'GCash') {
        $gcashName = $_POST['gcashName'] ?? '';
        $gcashNumber = $_POST['gcashNumber'] ?? '';

        $bookingData['payment']['gcashName'] = $gcashName;
        $bookingData['payment']['gcashNumber'] = $gcashNumber;
    }


    try {
        $result = $db->insertBooking($bookingData);

        if ($result && $result->isAcknowledged()) {
            // 3. Decrease availableSeats by 1
            $busesCollection->updateOne(
                ['busNumber' => $busNumber],
                ['$inc' => ['availableSeats' => -1]]
            );

            echo json_encode([
                'success' => true,
                'message' => 'Booking created successfully!',
                'bookingReferenceNo' => $referenceNo  // Add this line
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save booking.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
