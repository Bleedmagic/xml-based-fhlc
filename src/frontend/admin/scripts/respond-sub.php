<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/../../../../vendor/autoload.php';

// 1. Authorization & request method
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  echo json_encode(['success' => false, 'message' => 'Unauthorized']);
  exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Invalid request method']);
  exit;
}

// 2. Gather & validate inputs
$id      = trim($_POST['id']      ?? '');
$to      = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$subject = trim($_POST['subject'] ?? '');
$rawResponse = trim($_POST['message'] ?? ''); // Keep original message here

if (!$id || !$to || !$subject || !$rawResponse) {
  echo json_encode(['success' => false, 'message' => 'All fields are required and must be valid.']);
  exit;
}

// 3. Load XML and update the submission
$xmlPath = __DIR__ . '/../../../data/private/complaints-requests.xml';
if (!file_exists($xmlPath)) {
  echo json_encode(['success' => false, 'message' => 'Data file not found']);
  exit;
}

libxml_use_internal_errors(true);
$xml = simplexml_load_file($xmlPath);
if ($xml === false) {
  error_log('XML parse errors: ' . print_r(libxml_get_errors(), true));
  echo json_encode(['success' => false, 'message' => 'Failed to parse data file']);
  exit;
}

$found = false;
foreach ($xml->submission as $submission) {
  if ((string)$submission->id === $id) {
    $found = true;
    // Add or overwrite response
    $submission->response      = htmlspecialchars($rawResponse);
    $submission->response_date = date('Y-m-d H:i:s');
    $submission->status        = 'Closed';
    break;
  }
}
if (! $found) {
  echo json_encode(['success' => false, 'message' => 'Submission not found']);
  exit;
}

// 4. Save updated XML
if ($xml->asXML($xmlPath) === false) {
  error_log("Failed to save XML to {$xmlPath}");
  echo json_encode(['success' => false, 'message' => 'Could not save your response']);
  exit;
}

// 5. Load .env and configure PHPMailer (Mailtrap)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../../../');
$dotenv->load();

// Validate Mailtrap credentials
foreach (['MAIL_HOST', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_PORT'] as $env) {
  if (empty($_ENV[$env])) {
    echo json_encode(['success' => false, 'message' => 'Mail configuration missing']);
    exit;
  }
}

// 6. Prepare email body with template
$templateHtml = "
<p>Dear Parent/Guardian,</p>
<p>Thank you for your submission regarding the matter with ID: <strong>{$id}</strong>.</p>
<p>We have reviewed your request and would like to inform you of the following response:</p>
<p>{$rawResponse}</p>
<p>If you have any further questions or need additional assistance, please do not hesitate to contact us.</p>
<p>Best regards,<br>School Administration Team</p>
";

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
  $mail->addAddress($to);
  $mail->Subject = $subject;

  $mail->Body    = $templateHtml;
  $mail->AltBody = strip_tags($templateHtml);

  $mail->send();
  echo json_encode(['success' => true, 'message' => 'Response sent and submission closed.']);
} catch (Exception $e) {
  error_log('Mailer Error: ' . $mail->ErrorInfo);
  echo json_encode(['success' => false, 'message' => 'Failed to send email.']);
}
