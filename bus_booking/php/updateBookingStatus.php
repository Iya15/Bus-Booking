<?php
require_once 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $referenceNo = $_POST['referenceNo'] ?? null;
    $newStatus = $_POST['newStatus'] ?? null;

    if (empty($referenceNo) || empty($newStatus)) {
        echo json_encode(['success' => false, 'message' => 'Reference number and new status are required.']);
        exit;
    }

    try {
        $db = new Database();
        $updateResult = $db->updateBookingStatus($referenceNo, $newStatus);

        if ($updateResult->getModifiedCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Booking status updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No booking found or status is already set.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
