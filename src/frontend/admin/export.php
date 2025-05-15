<?php

// @TODO Put a gatekeeper here.

$dbPath = 'C:/xampp/htdocs/_XAMPP/XML-FHLC/src/data/private/database.sqlite';
$backupBaseDir = 'C:/xampp/htdocs/_XAMPP/XML-FHLC/src/data/backup';

if (!file_exists($dbPath)) {
  http_response_code(404);
  echo "Database file not found.";
  exit;
}

// Create timestamped backup folder
$timestamp = date('Y-m-d_H-i-s');
$backupDir = $backupBaseDir . DIRECTORY_SEPARATOR . 'backup_' . $timestamp;

if (!is_dir($backupDir) && !mkdir($backupDir, 0755, true)) {
  http_response_code(500);
  echo "Failed to create backup directory.";
  exit;
}

// Copy .sqlite file
$backupSqlite = $backupDir . DIRECTORY_SEPARATOR . 'database.sqlite';
if (!copy($dbPath, $backupSqlite)) {
  http_response_code(500);
  echo "Failed to backup .sqlite file.";
  exit;
}

// Open DB for dump and CSV exports
$db = new SQLite3($dbPath);

// Create SQL dump (.txt)
$sqlDump = '';
$results = $db->query("SELECT sql FROM sqlite_master WHERE sql NOT NULL ORDER BY type, name");
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
  $sqlDump .= $row['sql'] . ";\n\n";
}

$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
while ($table = $tables->fetchArray(SQLITE3_ASSOC)) {
  $tableName = $table['name'];
  $rows = $db->query("SELECT * FROM \"$tableName\"");
  while ($row = $rows->fetchArray(SQLITE3_ASSOC)) {
    $columns = array_keys($row);
    $values = array_map(function ($value) use ($db) {
      if ($value === null) return 'NULL';
      return "'" . $db->escapeString($value) . "'";
    }, array_values($row));
    $sqlDump .= "INSERT INTO \"$tableName\" (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $values) . ");\n";
  }
  $sqlDump .= "\n";
}

file_put_contents($backupDir . DIRECTORY_SEPARATOR . 'database_export.txt', $sqlDump);

// Export each table as CSV
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
while ($table = $tables->fetchArray(SQLITE3_ASSOC)) {
  $tableName = $table['name'];
  $csvFile = fopen($backupDir . DIRECTORY_SEPARATOR . $tableName . '.csv', 'w');

  // Get column names for CSV header
  $columnsRes = $db->query("PRAGMA table_info('$tableName')");
  $columns = [];
  while ($col = $columnsRes->fetchArray(SQLITE3_ASSOC)) {
    $columns[] = $col['name'];
  }
  fputcsv($csvFile, $columns);

  // Get rows
  $rows = $db->query("SELECT * FROM \"$tableName\"");
  while ($row = $rows->fetchArray(SQLITE3_ASSOC)) {
    // Write row to CSV
    fputcsv($csvFile, $row);
  }
  fclose($csvFile);
}

$db->close();
exit;
