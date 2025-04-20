<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    // Handle image upload (optional saving to folder)
    $busImagePath = '../uploads/bus_' . time() . '_' . basename($_FILES['busImage']['name']);
    move_uploaded_file($_FILES['busImage']['tmp_name'], $busImagePath);
    $qrImagePath = '../uploads/qr_' . time() . '_' . basename($_FILES['gcashQR']['name']);
    move_uploaded_file($_FILES['gcashQR']['tmp_name'], $qrImagePath);

    if (isset($_FILES['busImage'])) {
        $busImagePath = 'uploads/bus_' . time() . '_' . basename($_FILES['busImage']['name']);
        move_uploaded_file($_FILES['busImage']['tmp_name'], $busImagePath);
    }

    if (isset($_FILES['gcashQR'])) {
        $qrImagePath = 'uploads/qr_' . time() . '_' . basename($_FILES['gcashQR']['name']);
        move_uploaded_file($_FILES['gcashQR']['tmp_name'], $qrImagePath);
    }

    // Prepare document
    $busData = [
        'busName' => $_POST['busName'],
        'busNumber' => $_POST['busNumber'],
        'plateNumber' => $_POST['plateNumber'],
        'route' => $_POST['route'],
        'totalFare' => (float) $_POST['totalFare'],
        'travelTime' => $_POST['travelTime'],
        'driver' => [
            'name' => $_POST['driverName'],
            'contact' => $_POST['driverContact']
        ],
        'conductor' => [
            'name' => $_POST['conductorName'],
            'contact' => $_POST['conductorContact']
        ],
        'busImage' => $busImagePath,
        'gcashQR' => $qrImagePath
    ];

    // Insert into MongoDB
    $result = $db->insertBus($busData);

    echo json_encode([
        'success' => $result->isAcknowledged(),
        'message' => $result->isAcknowledged() ? 'Bus saved successfully!' : 'Failed to save bus.'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}