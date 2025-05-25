<?php
session_start();

// Helper function to sanitize input
function sanitize($data)
{
  return htmlspecialchars(trim($data));
}

// Common username and password blacklists
$usernameBlacklistPatterns = [
  '/admin/i',
  '/test/i',
  '/user/i',
  '/^\d+$/',
  '/guest/i'
];

$passwordBlacklist = [
  'admin123',
  'password',
  '12345678',
  'qwerty',
  'letmein',
  '123456789',
  'password1',
  '12345'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Collect and sanitize inputs
  $firstName = sanitize($_POST['first_name'] ?? '');
  $lastName = sanitize($_POST['last_name'] ?? '');
  $rawEmail = $_POST['email'] ?? '';
  $email = filter_var($rawEmail, FILTER_VALIDATE_EMAIL);
  $password = $_POST['password'] ?? '';
  $confirmPassword = $_POST['confirm_password'] ?? '';
  $terms = isset($_POST['terms']) ? true : false;

  // Validation
  $errors = [];

  // Required fields
  if (empty($firstName)) $errors[] = "First name is required.";
  if (empty($lastName)) $errors[] = "Last name is required.";
  if (empty($rawEmail)) {
    $errors[] = "Email is required.";
  } elseif (!$email) {
    $errors[] = "Valid email is required.";
  } else {
    $domainPart = substr(strrchr($email, "@"), 1);
    if (!preg_match('/\./', $domainPart)) {
      $errors[] = "Email domain must contain a dot.";
    }
  }

  // Length checks
  if (strlen($firstName) > 64) $errors[] = "First name must be 64 characters or less.";
  if (strlen($lastName) > 64) $errors[] = "Last name must be 64 characters or less.";
  if (strlen($rawEmail) > 128) $errors[] = "Email must be 128 characters or less.";

  // Prepare username (concatenate first and last name, remove spaces)
  $baseUsername = preg_replace('/\s+/', '', $firstName . $lastName);

  // Append 3 random digits
  $randomDigits = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);
  $username = $baseUsername . $randomDigits;

  // Username validation: length and blacklist
  if (strlen($username) < 3) {
    $errors[] = "Username must be at least 3 characters long.";
  }
  foreach ($usernameBlacklistPatterns as $pattern) {
    if (preg_match($pattern, $username)) {
      $errors[] = "Username contains forbidden terms or format.";
      break;
    }
  }

  // Password checks
  if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters.";
  }
  if (strlen($password) > 64) {
    $errors[] = "Password must be 64 characters or less.";
  }
  if (preg_match('/\s/', $password)) {
    $errors[] = "Password must not contain spaces.";
  }
  if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "Password must contain at least one uppercase letter.";
  }
  if (!preg_match('/[a-z]/', $password)) {
    $errors[] = "Password must contain at least one lowercase letter.";
  }
  if (!preg_match('/\d/', $password)) {
    $errors[] = "Password must contain at least one number.";
  }
  if (!preg_match('/[\W_]/', $password)) {
    $errors[] = "Password must contain at least one special character.";
  }
  if (stripos($password, $username) !== false) {
    $errors[] = "Password must not contain your username.";
  }
  if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
  }
  // Password blacklist check (case-insensitive)
  foreach ($passwordBlacklist as $badPass) {
    if (strcasecmp($password, $badPass) === 0) {
      $errors[] = "Password is too common or insecure.";
      break;
    }
  }

  // Terms acceptance
  if (!$terms) $errors[] = "You must accept the terms and conditions.";

  // If there are validation errors, redirect with errors
  if (!empty($errors)) {
    $_SESSION['error_notif'] = implode(" ", $errors);
    header('Location: register.php');
    exit;
  }

  // Hash password securely
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Load users.xml
  $usersFile = __DIR__ . '/../../data/private/users.xml';

  if (!file_exists($usersFile)) {
    $usersXml = new SimpleXMLElement('<users></users>');
  } else {
    $usersXml = simplexml_load_file($usersFile);
    if ($usersXml === false) {
      $_SESSION['error_notif'] = "Failed to load users data.";
      header('Location: register.php');
      exit;
    }
  }

  // Check if email already exists
  foreach ($usersXml->user as $user) {
    if (strcasecmp((string)$user->email, $email) === 0) {
      $_SESSION['error_notif'] = "Email is already registered.";
      header('Location: register.php');
      exit;
    }
  }

  // Append new user
  $newUser = $usersXml->addChild('user');
  $newUser->addChild('username', $username);
  $newUser->addChild('email', $email);
  $newUser->addChild('password', $hashedPassword);
  $newUser->addChild('role', 'guardian');

  // Add default picture element
  $defaultPicturePath = "C:\\xampp\\htdocs\\_XAMPP\\XML-FHLC\\assets\\svg\\default_profile.svg";
  $newUser->addChild('picture', $defaultPicturePath);

  // Add empty student element
  $newUser->addChild('student');

  // Save back to file with locking
  $fp = fopen($usersFile, 'w');
  if (flock($fp, LOCK_EX)) {
    fwrite($fp, $usersXml->asXML());
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
  } else {
    fclose($fp);
    $_SESSION['error_notif'] = "Could not save user data. Try again later.";
    header('Location: register.php');
    exit;
  }

  // Registration success, set flash and redirect
  $_SESSION['register_success'] = "Registration successful. You can now log in.";
  header('Location: login.php');
  exit;
} else {
  http_response_code(405);
  echo "Method Not Allowed";
}
