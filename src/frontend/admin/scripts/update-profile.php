<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: ../auth/login.php');
  exit();
}

$xmlFile = __DIR__ . '/../../../data/private/users.xml';
$uploadDir = '../../../../assets/img/uploads/';
$allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
$allowedMime = ['image/jpeg', 'image/png', 'image/webp'];

// Validate required fields
$requiredFields = ['username', 'first_name', 'last_name'];
foreach ($requiredFields as $field) {
  if (empty(trim($_POST[$field] ?? ''))) {
    header('Location: ../settings.php?updated=0');
    exit();
  }
}

if (!file_exists($xmlFile) || !($xml = simplexml_load_file($xmlFile))) {
  header('Location: ../settings.php?updated=0');
  exit();
}

$userFound = false;

foreach ($xml->user as $user) {
  if ((string)$user->email === $_SESSION['email']) {
    $userFound = true;

    // Profile picture
    if (!empty($_FILES['profile_picture']['tmp_name'])) {
      $tmpPath  = $_FILES['profile_picture']['tmp_name'];
      $origName = basename($_FILES['profile_picture']['name']);
      $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

      if (!in_array($ext, $allowedExt, true)) {
        header('Location: ../settings.php?updated=0');
        exit();
      }

      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mimeType = $finfo->file($tmpPath);
      if (!in_array($mimeType, $allowedMime, true)) {
        header('Location: ../settings.php?updated=0');
        exit();
      }

      if (!empty($user->picture) && file_exists('../../../../' . $user->picture)) {
        unlink('../../../../' . $user->picture);
      }

      $newName = uniqid('prof_', true) . '.' . $ext;
      $destination = $uploadDir . $newName;

      if (!move_uploaded_file($tmpPath, $destination)) {
        header('Location: ../settings.php?updated=0');
        exit();
      }

      $user->picture = 'assets/img/uploads/' . $newName;
    }

    // Assign form values
    $user->username     = htmlspecialchars(trim($_POST['username']));
    $user->first_name   = htmlspecialchars(trim($_POST['first_name']));
    $user->middle_name  = htmlspecialchars(trim($_POST['middle_name'] ?? ''));
    $user->last_name    = htmlspecialchars(trim($_POST['last_name']));
    $user->phone_number = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
    $age = (int)($_POST['age'] ?? 0);
    if ($age < 18) {
      header('Location: ../settings.php?updated=0');
      exit();
    }
    $user->age = $age;
    $user->address      = htmlspecialchars(trim($_POST['address'] ?? ''));

    $xml->asXML($xmlFile);
    break;
  }
}

if (!$userFound) {
  header('Location: ../settings.php?updated=0');
  exit();
}

header('Location: ../settings.php?updated=1');
exit();
