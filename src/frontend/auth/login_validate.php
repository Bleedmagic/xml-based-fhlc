<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $identifier = trim($_POST['email-username']);
  $password = trim($_POST['password']);

  if (empty($identifier) || empty($password)) {
    $_SESSION['error_notif'] = "Email/Username and password cannot be empty.";
    header("Location: login.php");
    exit();
  }

  if (strlen($password) < 8) {
    $_SESSION['error_notif'] = "Password must be at least 8 characters.";
    header("Location: login.php");
    exit();
  }

  $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);
  $isUsername = preg_match('/^[a-zA-Z0-9._-]{3,128}$/', $identifier);

  if (!$isEmail && !$isUsername) {
    $_SESSION['error_notif'] = "Invalid username or email format.";
    header("Location: login.php");
    exit();
  }

  $usersXml = new DOMDocument();
  $usersXml->load('../../data/private/users.xml');
  $users = $usersXml->getElementsByTagName('user');

  $isAuthenticated = false;

  foreach ($users as $user) {
    $storedUsername = trim($user->getElementsByTagName('username')[0]->nodeValue);
    $storedEmail = trim($user->getElementsByTagName('email')[0]->nodeValue);
    $storedPassword = $user->getElementsByTagName('password')[0]->nodeValue;

    if (($storedUsername === $identifier || $storedEmail === $identifier) &&
      password_verify($password, $storedPassword)
    ) {
      $isAuthenticated = true;
      $_SESSION['username'] = $storedUsername;
      $_SESSION['role'] = $user->getElementsByTagName('role')[0]->nodeValue;
      break;
    }
  }

  if ($isAuthenticated) {
    $role = $_SESSION['role'];

    if ($role === 'admin') {
      $redirect = '../admin/dashboard.php';
    } elseif ($role === 'guardian') {
      $redirect = '../users/dashboard.php';
    } else {
      $redirect = 'login.php';
    }

    header("Location: $redirect");
    exit();
  } else {
    $_SESSION['error_notif'] = "Invalid email/username or password.";
    header("Location: login.php");
    exit();
  }
}
