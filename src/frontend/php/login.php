<?php
$inputUsername = $_POST['username'];
$inputPassword = $_POST['password'];

if (file_exists("users.xml")) {
  $xml = simplexml_load_file("users.xml");
} else {
  die("No users registered yet.");
}

$loginSuccess = false;
foreach ($xml->User as $user) {
  if ((string)$user->Username == $inputUsername && (string)$user->Password == $inputPassword) {
    $loginSuccess = true;
    break;
  }
}

if ($loginSuccess) {
  echo "<h2>Login Successful! Welcome, " . htmlspecialchars($inputUsername) . "!</h2>";
} else {
  echo "<h2>Login Failed! Incorrect username or password.</h2>";
}
?>
