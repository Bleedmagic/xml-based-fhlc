<?php
// Path to your SQLite database file
$databasePath = 'C:/xampp/htdocs/_XAMPP/XML-FHLC/src/data/private/database.sqlite';

// Check if the file exists
if (!file_exists($databasePath)) {
  die('Database file not found.');
}

// Set headers to prompt download
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="database.sqlite"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($databasePath));

// Read the file and send it to the output buffer
readfile($databasePath);
exit;
