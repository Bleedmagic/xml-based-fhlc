<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlPath = __DIR__ . '/../../../data/private/students.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (file_exists($xmlPath)) {
    $xml = simplexml_load_file($xmlPath);
  } else {
    $xml = new SimpleXMLElement('<students></students>');
  }

  $newStudent = $xml->addChild('student');
  $newStudent->addChild('id', uniqid());
  $newStudent->addChild('name', $_POST['name']);
  $newStudent->addChild('guardian_name', $_POST['guardian_name']);
  $newStudent->addChild('guardian_contact', $_POST['guardian_contact']);
  $newStudent->addChild('status', $_POST['status']);

  $xml->asXML($xmlPath);

  header('Location: ../students.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Student</title>
</head>

<body>
  <h2>Add Student</h2>
  <form method="POST" action="">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Guardian Name: <input type="text" name="guardian_name" required></label><br>
    <label>Guardian Contact: <input type="text" name="guardian_contact" required></label><br>
    <label>Status:
      <select name="status" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </label><br>
    <button type="submit">Add Student</button>
  </form>
</body>

</html>
