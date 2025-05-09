<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $username = filter_var($username, FILTER_SANITIZE_EMAIL);
  $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

  if (empty($username) || empty($password)) {
    $_SESSION['error_email'] = "Username and password cannot be empty.";
    header("Location: login.php");
    exit();
  }

  if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_email'] = "Invalid email format.";
    header("Location: login.php");
    exit();
  }

  if (strlen($password) < 8) {
    $_SESSION['error_email'] = "Password must be at least 8 characters.";
    header("Location: login.php");
    exit();
  }

  $usersXml = new DOMDocument();
  $usersXml->load('../../data/private/users.xml');
  $users = $usersXml->getElementsByTagName('user');

  $isAuthenticated = false;

  foreach ($users as $user) {
    $storedUsername = trim($user->getElementsByTagName('username')[0]->nodeValue);
    $storedPassword = $user->getElementsByTagName('password')[0]->nodeValue;

    if ($storedUsername === $username && password_verify($password, $storedPassword)) {
      $isAuthenticated = true;
      $_SESSION['username'] = $username;
      $_SESSION['role'] = $user->getElementsByTagName('role')[0]->nodeValue;
      break;
    }
  }

  if ($isAuthenticated) {
    $role = $_SESSION['role'];

    if ($role === 'admin') {
      // $redirect = '../admin/dashboard.php';
      $redirect = '../admin/index.html';
    } elseif ($role === 'guardian') {
      // $redirect = '../users/dashboard.php';
      $redirect = '../users/index.html';
    } else {
      $redirect = 'login.php';
    }

    echo "<script>
    window.location.href = '$redirect';
    </script>";
    exit();
  } else {
    $_SESSION['error_email'] = "Invalid username or password.";
    header("Location: login.php");
    exit();
  }
}
