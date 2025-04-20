<?php
session_start();
$users = [
  'admin' => 'admin123'
];

if ($_POST['username'] && $_POST['password']) {
  $u = $_POST['username'];
  $p = $_POST['password'];
  if (isset($users[$u]) && $users[$u] === $p) {
    $_SESSION['user'] = $u;
    header("Location: dashboard.php");
  } else {
    echo "Invalid login.";
  }
}
