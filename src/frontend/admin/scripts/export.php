<?php
header('Content-Type: application/json');

$backupBaseDir = __DIR__ . '/../../../data/backup';

$page = isset($_GET['page']) ? basename($_GET['page']) : null;
if (!$page || !preg_match('/^[a-zA-Z0-9_-]+$/', $page)) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid or missing page parameter']);
  exit;
}

$sourceXmlFile = __DIR__ . "/../../../data/private/{$page}.xml";
if (!file_exists($sourceXmlFile)) {
  http_response_code(404);
  echo json_encode(['error' => 'Source XML file not found']);
  exit;
}

$timestamp = date('Ymd_His');
$backupFolder = "{$backupBaseDir}/backup_{$page}_{$timestamp}";

if (!is_dir($backupFolder)) {
  if (!mkdir($backupFolder, 0755, true)) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create backup directory']);
    exit;
  }
}

$xmlContent = file_get_contents($sourceXmlFile);
if ($xmlContent === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to read XML file']);
  exit;
}

$xmlFilePath = "{$backupFolder}/{$page}.xml";
$txtFilePath = "{$backupFolder}/{$page}.txt";
$csvFilePath = "{$backupFolder}/{$page}.csv";
$zipFilePath = "{$backupFolder}.zip";

// Save XML
if (!copy($sourceXmlFile, $xmlFilePath)) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to copy XML file']);
  exit;
}

// Save TXT
if (file_put_contents($txtFilePath, $xmlContent) === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to save TXT backup']);
  exit;
}

// Parse XML
$xml = simplexml_load_string($xmlContent);
if ($xml === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to parse XML content']);
  exit;
}

// Extract CSV
$csvRows = [];
$headers = [];

foreach ($xml->children() as $record) {
  $row = [];
  foreach ($record->children() as $field) {
    $fieldName = $field->getName();
    if (!in_array($fieldName, $headers)) {
      $headers[] = $fieldName;
    }
    $row[$fieldName] = (string)$field;
  }
  $csvRows[] = $row;
}

// Write CSV
$fp = fopen($csvFilePath, 'w');
if ($fp === false) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to create CSV file']);
  exit;
}
fwrite($fp, "\xEF\xBB\xBF");
fputcsv($fp, $headers);
foreach ($csvRows as $row) {
  $line = [];
  foreach ($headers as $header) {
    $line[] = isset($row[$header]) ? $row[$header] : '';
  }
  fputcsv($fp, $line);
}
fclose($fp);

// Create ZIP archive
$zip = new ZipArchive();
if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to create ZIP archive']);
  exit;
}

$zip->addFile($xmlFilePath, "{$page}.xml");
$zip->addFile($txtFilePath, "{$page}.txt");
$zip->addFile($csvFilePath, "{$page}.csv");

$zip->close();

// Clean up uncompressed backup folder
array_map('unlink', glob("$backupFolder/*.*"));
rmdir($backupFolder);

// Respond
echo json_encode([
  'success' => true,
  'message' => 'Backup ZIP created successfully.',
  'zip_path' => str_replace(__DIR__ . '/../../../', '', $zipFilePath)
]);
