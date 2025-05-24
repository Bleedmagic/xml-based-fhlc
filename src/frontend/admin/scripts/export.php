<?php
$backupBaseDir = __DIR__ . '/../../../data/backup';

// Get 'page' parameter safely
$page = isset($_GET['page']) ? basename($_GET['page']) : null;
if (!$page) {
  http_response_code(400);
  echo json_encode(['error' => 'Page parameter missing']);
  exit;
}

// Source XML file path
$sourceXmlFile = __DIR__ . "/../../../data/private/{$page}.xml";

if (!file_exists($sourceXmlFile)) {
  http_response_code(404);
  echo json_encode(['error' => 'Source XML file not found']);
  exit;
}

// Create backup folder with timestamp inside base dir
$timestamp = date('Ymd_His');
$backupFolder = $backupBaseDir . "/backup_{$page}_{$timestamp}";

if (!is_dir($backupFolder)) {
  if (!mkdir($backupFolder, 0777, true)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create backup directory']);
    exit;
  }
}

// Copy original XML to backup folder as .xml
if (!copy($sourceXmlFile, $backupFolder . "/{$page}.xml")) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to backup XML file']);
  exit;
}

// Save XML content as .txt backup
$xmlContent = file_get_contents($sourceXmlFile);
if (file_put_contents($backupFolder . "/{$page}.txt", $xmlContent) === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to save TXT backup']);
  exit;
}

// Load XML and convert to CSV
$xml = simplexml_load_file($sourceXmlFile);
if ($xml === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to load XML']);
  exit;
}

$csvRows = [];
$headers = [];

// Extract all <student> elements
foreach ($xml->student as $student) {
  $row = [];
  foreach ($student->children() as $field) {
    $fieldName = $field->getName();
    if (!in_array($fieldName, $headers)) {
      $headers[] = $fieldName;
    }
    $row[$fieldName] = (string)$field;
  }
  $csvRows[] = $row;
}

// Prepare CSV file
$csvFile = $backupFolder . "/{$page}.csv";
$fp = fopen($csvFile, 'w');
if ($fp === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to create CSV file']);
  exit;
}

// Write headers
fputcsv($fp, $headers);

// Write data rows
foreach ($csvRows as $row) {
  $line = [];
  foreach ($headers as $header) {
    $line[] = isset($row[$header]) ? $row[$header] : '';
  }
  fputcsv($fp, $line);
}

fclose($fp);

// Success response
echo json_encode(['success' => true, 'backup_folder' => $backupFolder]);
