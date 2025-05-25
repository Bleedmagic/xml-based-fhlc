<?php
session_start();

// Helper: redirect with messages
function redirect_with_message(string $location, string $success_msg = '', string $error_msg = ''): void
{
  if ($success_msg !== '') {
    $_SESSION['reset_success'] = $success_msg;
  }
  if ($error_msg !== '') {
    $_SESSION['error_notif'] = $error_msg;
  }
  header("Location: $location");
  exit();
}

// Password validation function consistent with register-validate.php
function validate_password(string $password, string $username): array
{
  $errors = [];

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
  foreach ($passwordBlacklist as $badPass) {
    if (strcasecmp($password, $badPass) === 0) {
      $errors[] = "Password is too common or insecure.";
      break;
    }
  }

  return $errors;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  redirect_with_message('reset-password.php', '', 'Invalid request method.');
}

// Retrieve POST data safely
$token = $_POST['token'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($token)) {
  redirect_with_message("reset-password.php?token=$token", '', 'Missing reset token.');
}

if ($password !== $confirm_password) {
  redirect_with_message("reset-password.php?token=$token", '', 'Passwords do not match.');
}

// Load users.xml
$usersFile = __DIR__ . '/../../data/private/users.xml';
if (!file_exists($usersFile)) {
  redirect_with_message("reset-password.php?token=$token", '', 'User data not found.');
}

$usersXml = new DOMDocument();
$usersXml->preserveWhiteSpace = false;
$usersXml->formatOutput = true;
$usersXml->load($usersFile);

$xpath = new DOMXPath($usersXml);
$userNodes = $xpath->query("//user[reset_token='$token']");

if ($userNodes->length === 0) {
  redirect_with_message("reset-password.php", '', 'Invalid or expired reset token.');
}

$userNode = $userNodes->item(0);

// Check expiry
$expiryNode = $userNode->getElementsByTagName('token_expiry')->item(0);
if ($expiryNode) {
  $expiryTime = DateTime::createFromFormat(DateTime::ATOM, $expiryNode->nodeValue);
  $now = new DateTime("now", new DateTimeZone('Asia/Manila'));

  if (!$expiryTime || $now > $expiryTime) {
    redirect_with_message("reset-password.php", '', 'Reset token has expired.');
  }
}

// Get username for password validation
$username = $userNode->getElementsByTagName('username')->item(0)->nodeValue ?? '';

// Validate password
$passwordErrors = validate_password($password, $username);
if (!empty($passwordErrors)) {
  redirect_with_message("reset-password.php?token=$token", '', implode(' ', $passwordErrors));
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
if ($hashedPassword === false) {
  redirect_with_message("reset-password.php?token=$token", '', 'Failed to hash the password.');
}

// Update password
$passwordNode = $userNode->getElementsByTagName('password')->item(0);
if ($passwordNode) {
  $passwordNode->nodeValue = $hashedPassword;
} else {
  $newPasswordNode = $usersXml->createElement('password', $hashedPassword);
  $userNode->appendChild($newPasswordNode);
}

// Remove reset_token and token_expiry
$resetTokenNode = $userNode->getElementsByTagName('reset_token')->item(0);
if ($resetTokenNode) {
  $userNode->removeChild($resetTokenNode);
}
$tokenExpiryNode = $userNode->getElementsByTagName('token_expiry')->item(0);
if ($tokenExpiryNode) {
  $userNode->removeChild($tokenExpiryNode);
}

// Save changes
if (!$usersXml->save($usersFile)) {
  redirect_with_message("reset-password.php?token=$token", '', 'Failed to update user data.');
}

// Redirect to login
redirect_with_message('login.php', 'Password reset successful. You can now log in.');
