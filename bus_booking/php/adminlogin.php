<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        echo "<script>alert('Please fill in both fields.'); window.location.href='../admin/index.html';</script>";
        exit;
    }

    $db = new Database();
    $admin = $db->getAdminsCollection()->findOne(['username' => $username]);

    if ($admin && $admin['password'] === $password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: ../admin/manage.html'); // ✅ Redirect here after successful login
        exit;
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href='../admin/index.html';</script>";
        exit;
    }
} else {
    header('Location: ../admin/index.html');
    exit;
}
