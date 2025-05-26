<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['first_name'] . ' ' .
                (!empty($_POST['middle_name']) ? $_POST['middle_name'] . ' ' : '') .
                $_POST['last_name'];

    $entry = [
        'type' => $_POST['type'],
        'date' => $_POST['incident_date'],
        'subject' => $_POST['subject'],
        'message' => $_POST['message'],
        'guardian' => $fullName,
        'status' => 'Pending'
    ];

    // Initialize session array if not set
    if (!isset($_SESSION['complaints'])) {
        $_SESSION['complaints'] = [];
    }

    // Add entry
    $_SESSION['complaints'][] = $entry;
}

header('Location: complaints-requests.php');
exit;
