<?php
// auth.php

function login($username, $password)
{
  global $pdo;

  // Check if user exists
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    // User is valid, start session
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    return true;
  }

  return false;
}

function register($username, $password, $email)
{
  global $pdo;

  // Check if username already exists
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  if ($stmt->rowCount() > 0) {
    return false; // Username taken
  }

  // Hash password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert new user
  $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, 'user')");
  $stmt->execute(['username' => $username, 'password' => $hashed_password, 'email' => $email]);

  return true;
}

function logout()
{
  session_start();
  session_unset();
  session_destroy();
}
