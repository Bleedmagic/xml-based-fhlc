<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../../../vendor/autoload.php';

// Load env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

// Paths
$usersFile = __DIR__ . '/../../data/private/users.xml';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: forgot-password.php');
  exit();
}

$email = trim($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['error_notif'] = 'Invalid email address.';
  header('Location: forgot-password.php');
  exit();
}

// Load users.xml
if (!file_exists($usersFile)) {
  $_SESSION['error_notif'] = 'User database is not available.';
  header('Location: forgot-password.php');
  exit();
}

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;
$dom->formatOutput       = true;
$dom->load($usersFile);

$xpath = new DOMXPath($dom);
// Case-insensitive match on email
$query = sprintf(
  "//user[translate(email, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz') = '%s']",
  strtolower($dom->createTextNode($email)->nodeValue)
);
$users = $xpath->query($query);

if ($users->length === 1) {
  $userNode = $users->item(0);

  // Generate new token
  $token  = bin2hex(random_bytes(16));
  $expiry = (new DateTime('now', new DateTimeZone('Asia/Manila')))
    ->add(new DateInterval('PT1H'))  // 1 hour
    ->format(DateTime::ATOM);

  // Remove old reset_token & token_expiry if present
  foreach (['reset_token', 'token_expiry'] as $tag) {
    $old = $userNode->getElementsByTagName($tag);
    foreach ($old as $node) {
      $userNode->removeChild($node);
    }
  }

  // Append new nodes
  $userNode->appendChild($dom->createElement('reset_token', $token));
  $userNode->appendChild($dom->createElement('token_expiry', $expiry));

  // Save XML
  $dom->save($usersFile);

  // Send email
  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME'];
    $mail->Password   = $_ENV['MAIL_PASSWORD'];
    $mail->SMTPSecure = 'tls';
    $mail->Port       = $_ENV['MAIL_PORT'];

    $mail->setFrom('no-reply@fhlc.com', 'Full House Learning Center');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'FHLC Password Reset Request';

    $resetLink = "http://localhost/_XAMPP/XML-FHLC/src/frontend/auth/reset-password.php?token=$token";

    $mail->Body = "
    <p>Dear User,</p>
    <p>We received a request to reset your password for your FHLC account.</p>
    <p>Please click the link below to reset your password. This link will expire in 1 hour.</p>
    <p><a href=\"$resetLink\">Reset Your Password</a></p>
    <p>If you did not request this, please ignore this email or contact our support team.</p>
    <p>Best regards,<br/>Full House Learning Center Support Team</p>
    ";

    $mail->AltBody = "Dear User,\n\nWe received a request to reset your password for your Full House Learning Center account.\n\n"
      . "Reset your password using the link below (expires in 1 hour):\n"
      . "$resetLink\n\n"
      . "If you did not request this, please ignore this email or contact support.\n\n"
      . "Best regards,\nFull House Learning Center Support Team";

    $mail->send();
    $_SESSION['success_notif'] = 'A reset link has been sent.';
  } catch (Exception $e) {
    error_log("Mailer Error: {$mail->ErrorInfo}");
    $_SESSION['error_notif'] = 'Failed to send reset email. Please try again later.';
  }
} else {
  // Always success-style so attackers can't enumerate emails
  $_SESSION['success_notif'] = 'If this email exists in our system, a reset link has been sent.';
}

header('Location: forgot-password.php');
exit();
