<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo "Unauthorized access.";
  exit();
}
?>
