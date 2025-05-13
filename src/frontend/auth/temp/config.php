<!-- DB Connection, Functions -->

<?php
$host = 'localhost';
$dbname = 'fhlc_db';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("ERROR: Could not connect. " . $e->getMessage());
}

session_start();

function isLoggedIn()
{
  return isset($_SESSION['user_id']);
}

// Function to get current user data
function getCurrentUser()
{
  global $pdo;

  if (!isLoggedIn()) {
    return null;
  }

  try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return null;
  }
}

// Function to get student grades
function getStudentGrades($studentId)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("SELECT * FROM grades WHERE student_id = ? ORDER BY date_recorded");
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return [];
  }
}

// Function to get student attendance
function getStudentAttendance($studentId)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("SELECT COUNT(*) as total, SUM(is_present) as present FROM attendance WHERE student_id = ?");
    $stmt->execute([$studentId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
      return round(($result['present'] / $result['total']) * 100);
    }

    return 0;
  } catch (PDOException $e) {
    return 0;
  }
}

// Function to get student homework
function getStudentHomework($studentId)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("SELECT h.*, COALESCE(s.is_completed, 0) as is_completed
                               FROM homework h
                               LEFT JOIN homework_submissions s ON h.id = s.homework_id AND s.student_id = ?
                               WHERE h.class_id IN (SELECT class_id FROM class_enrollments WHERE student_id = ?)
                               ORDER BY h.due_date DESC
                               LIMIT 5");
    $stmt->execute([$studentId, $studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return [];
  }
}

// Function to get student payments
function getStudentPayments($studentId)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE student_id = ? ORDER BY payment_date DESC");
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return [];
  }
}

// Function to get upcoming events
function getUpcomingEvents()
{
  global $pdo;

  try {
    $stmt = $pdo->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date LIMIT 5");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    return [];
  }
}
