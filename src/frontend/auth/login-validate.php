<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require_once __DIR__ . '/../../../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();

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

  foreach ($users as $user) {
    $storedUsername = trim($user->getElementsByTagName('username')[0]->nodeValue);
    $storedEmail = trim($user->getElementsByTagName('email')[0]->nodeValue);
    $storedPassword = $user->getElementsByTagName('password')[0]->nodeValue;

    if (($storedUsername === $identifier || $storedEmail === $identifier) &&
      password_verify($password, $storedPassword)
    ) {

      // Generate and store OTP
      $otp = random_int(100000, 999999);
      $_SESSION['otp'] = $otp;
      $_SESSION['otp_expires'] = time() + 300; // 5 mins
      $_SESSION['pending_user'] = [
        'username' => $storedUsername,
        'email' => $storedEmail,
        'role' => $user->getElementsByTagName('role')[0]->nodeValue
      ];

      // Send OTP
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
        $mail->addAddress($storedEmail);

        $mail->isHTML(true);
        $mail->Subject = "Your FHLC Login OTP";
        $mail->Body = "
          <p>Dear $storedUsername,</p>
          <p>Your One-Time Password (OTP) is:</p>
          <h2>$otp</h2>
          <p>This OTP is valid for 5 minutes.</p>
          <p>Regards,<br>FHLC Team</p>
        ";
        $mail->AltBody = "Your OTP is: $otp. Valid for 5 minutes.";

        $mail->send();
        header("Location: enter-otp.php");
        exit();
      } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        $_SESSION['error_notif'] = "Failed to send OTP. Please try again.";
        header("Location: login.php");
        exit();
      }
    }
  }

  $_SESSION['error_notif'] = "Invalid email/username or password.";
  header("Location: login.php");
  exit();
}
