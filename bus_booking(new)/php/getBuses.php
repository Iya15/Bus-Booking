<?php
// getBuses.php
require_once 'db.php';

use MongoDB\BSON\ObjectId;

header('Content-Type: application/json');

$db = new Database();

if (isset($_GET['busId'])) {
    // Get one bus by ID
    try {
        $bus = $db->getBusesCollection()->findOne(['_id' => new ObjectId($_GET['busId'])]);

        if ($bus) {
            $bus['_id'] = (string) $bus['_id']; // Convert to string
            echo json_encode(['success' => true, 'bus' => $bus]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Bus not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID format']);
    }
} else {
    // Get all buses
    $buses = $db->getAllBuses();

    // Convert ObjectId to string for frontend
    foreach ($buses as &$bus) {
        $bus['_id'] = (string) $bus['_id'];
    }

    echo json_encode(['success' => true, 'buses' => $buses]);
}