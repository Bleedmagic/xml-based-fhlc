<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (isset($_SESSION['complaints'][$id])) {
        $_SESSION['complaints'][$id]['type'] = $_POST['type'];
        $_SESSION['complaints'][$id]['date'] = $_POST['submitted_date'];
        $_SESSION['complaints'][$id]['subject'] = $_POST['subject'];
        $_SESSION['complaints'][$id]['message'] = $_POST['message'];
        $_SESSION['complaints'][$id]['status'] = 'Pending';
    }
}

header('Location: complaints-requests.php');
exit;
