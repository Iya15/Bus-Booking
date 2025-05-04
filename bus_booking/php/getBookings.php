<?php
require_once 'db.php';
header('Content-Type: application/json');

try {
    $db = new Database();
    $bookings = $db->getAllBookings();

    // Get the buses collection to perform lookups
    $busesCollection = $db->getCollection('buses');

    // Set the timezone to Philippine time
    $phTimeZone = new DateTimeZone('Asia/Manila');

    $formattedBookings = [];

    foreach ($bookings as $doc) {
        // Find the corresponding bus using busNumber
        $bus = $busesCollection->findOne(['busNumber' => $doc['busNumber']]);

        // Convert UTCDateTime to Philippine time
        $utcDateTime = $doc['bookingDateTime']->toDateTime();
        $phDateTime = $utcDateTime->setTimezone($phTimeZone);

        $formattedBookings[] = [
            'referenceNo' => $doc['bookingReferenceNo'],
            'dateTime' => $phDateTime->format('Y-m-d h:i A'), // Now in PH time
            'busNumber' => $doc['busNumber'],
            'firstName' => $doc['passenger']['firstName'],
            'lastName' => $doc['passenger']['lastName'],
            'contact' => $doc['passenger']['contactNumber'],
            'busName' => $bus['busName'] ?? '',
            'route' => $bus['route'] ?? '',
            'status' => $doc['status'],

            'travelTime' => $bus['travelTime'] ?? '',
            'driver' => $bus['driver']['name'] ?? '',
            'conductor' => $bus['conductor']['name'] ?? '',
            'modeOfPayment' => $doc['payment']['modeOfPayment'] ?? '',
            'totalFare' => $bus['totalFare'] ?? 0,
        ];
    }

    echo json_encode(['success' => true, 'data' => $formattedBookings]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
