<?php
session_start();
session_regenerate_id(true);

// if (isset($_SESSION['username'])) {
//   error_log("User '" . $_SESSION['username'] . "' logged out at " . date("Y-m-d H:i:s"));
// }

// Clear session data
$_SESSION = array();

if (ini_get("session.use_cookies")) {
  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
}

session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: 0");
header("Pragma: no-cache");

header("Location: ../home.php");
exit;
