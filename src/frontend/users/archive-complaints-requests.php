<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['complaints'][$id])) {
        if (!isset($_SESSION['archived_complaints'])) {
            $_SESSION['archived_complaints'] = [];
        }

        $_SESSION['archived_complaints'][] = $_SESSION['complaints'][$id];
        unset($_SESSION['complaints'][$id]);

        // Reindex session
        $_SESSION['complaints'] = array_values($_SESSION['complaints']);
    }
}

header('Location: complaints-requests.php');
exit;
