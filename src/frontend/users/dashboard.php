<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}

$xml = simplexml_load_file(__DIR__ . '/../../data/private/user-grades.xml');

// Grades calculation
$qTotals = ['q1' => 0, 'q2' => 0, 'q3' => 0, 'q4' => 0];
$count = 0;
foreach ($xml->subject as $subject) {
  $qTotals['q1'] += floatval($subject->q1);
  $qTotals['q2'] += floatval($subject->q2);
  $qTotals['q3'] += floatval($subject->q3);
  $qTotals['q4'] += floatval($subject->q4);
  $count++;
}
$finalGrades = [
  'q1' => round($qTotals['q1'] / $count, 2),
  'q2' => round($qTotals['q2'] / $count, 2),
  'q3' => round($qTotals['q3'] / $count, 2),
  'q4' => round($qTotals['q4'] / $count, 2),
];

// Assignments
$assignments = [
  "Mathematics" => [],
  "Science" => [
    ["task" => "What are the layers of the Earth?", "status" => "not done"],
    ["task" => "Deadline Tomorrow", "status" => "passed"]
  ],
  "Filipino" => [
    ["task" => "Mga halimbawa ng pambansang Prutas?", "status" => "not done"],
    ["task" => "Deadline Tomorrow", "status" => "passed"]
  ],
  "Values Education" => [],
  "Physical Education" => [],
  "MAPEH" => [],
  "Araling Panlipunan" => [],
  "English" => []
];

$submittedCount = 0;
$notSubmittedCount = 0;
foreach ($assignments as $tasks) {
  $hasNotDone = false;
  foreach ($tasks as $task) {
    if ($task['status'] === 'not done') {
      $hasNotDone = true;
      break;
    }
  }
  if ($hasNotDone) {
    $notSubmittedCount++;
  } else {
    $submittedCount++;
  }
}

// Load user events for Upcoming Events box
$userEvents = [];
$eventsXmlPath = __DIR__ . '/../../data/private/events-user.xml';
if (file_exists($eventsXmlPath)) {
  $eventsXml = simplexml_load_file($eventsXmlPath);
  foreach ($eventsXml->event as $event) {
    $userEvents[] = [
      'title' => (string)$event->title,
      'from' => (string)$event->from,
      'to' => (string)$event->to,
      'description' => (string)$event->description,
    ];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>User / Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/user-dashboard.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-success font-weight-bold">Dashboard</h1>
          </div>

          <div class="row row-margin-top">
            <!-- Grades Line Chart -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header font-weight-bold text-success">Grades Graph Analysis</div>
                <div class="card-body">
                  <canvas id="gradesLineChart"></canvas>
                </div>
              </div>
            </div>

            <!-- Assignment Pie Chart -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm text-center">
                <div class="card-body">
                  <p class="text-success mb-1">✔ Submitted</p>
                  <p class="text-danger mb-1">✘ Not Submitted</p>
                  <div class="chart-pie mb-2">
                    <canvas id="taskCompletionPieChart"></canvas>
                  </div>
                  <strong><?= $submittedCount + $notSubmittedCount > 0 ? round(($submittedCount / ($submittedCount + $notSubmittedCount)) * 100) : 0 ?>%</strong>
                </div>
              </div>
            </div>

            <!-- Homework -->
            <div class="col-md-4 mb-4">
              <div class="card h-100 shadow-sm homework-card text-white">
                <div class="card-header">TO DO!</div>
                <ul class="list-group list-group-flush">
                  <?php
                  $counter = 1;
                  foreach ($assignments as $subject => $tasks) {
                    foreach ($tasks as $task) {
                      if ($task['status'] === 'not done') {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        echo '<span>' . $counter++ . '. ' . htmlspecialchars($task['task']) . '</span>';
                        echo '<span class="text-danger"><i class="fas fa-times-circle"></i></span>';
                        echo '</li>';
                      }
                    }
                  }
                  if ($counter === 1) {
                    echo '<li class="list-group-item text-muted">No pending assignments</li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <!-- Payments -->
            <div class="col-lg-6 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header font-weight-bold">
                  Payments <span class="float-right text-success">Current Balance: PHP 15,300</span>
                </div>
                <div class="card-body p-0">
                  <table class="table mb-0">
                    <thead>
                      <tr>
                        <th>Fee Category</th>
                        <th class="text-right">Amount Due</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Tuition Fee</td>
                        <td class="text-right">₱10,000.00</td>
                      </tr>
                      <tr>
                        <td>Miscellaneous</td>
                        <td class="text-right">₱500.00</td>
                      </tr>
                      <tr>
                        <td>Laboratory Fee</td>
                        <td class="text-right">₱3,000.00</td>
                      </tr>
                      <tr>
                        <td>Field Trip</td>
                        <td class="text-right">₱2,000.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Events -->
            <div class="col-lg-6 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header font-weight-bold">Upcoming Events</div>
                <div class="card-body text-center">

                  <div class="d-flex justify-content-center align-items-center mb-3">
                    <?php
                    if (count($userEvents) > 0) {
                      $firstEventDate = new DateTime($userEvents[0]['from']);
                      $monthYear = $firstEventDate->format('F, Y');
                    } else {
                      $monthYear = date('F, Y');
                    }
                    ?>
                    <button class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-chevron-left"></i></button>
                    <strong><?= htmlspecialchars($monthYear) ?></strong>
                    <button class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-chevron-right"></i></button>
                  </div>

                  <div class="mb-2">
                    <?php if (count($userEvents) === 0): ?>
                      <div class="text-muted">No upcoming events at this time.</div>
                    <?php else: ?>
                      <?php foreach ($userEvents as $evt): ?>
                        <?php
                        // Determine button color & icon by keywords in title or just default
                        $titleLower = strtolower($evt['title']);
                        $btnClass = "btn-primary";
                        $iconClass = "fas fa-calendar";
                        if (strpos($titleLower, 'sports') !== false || strpos($titleLower, 'intramurals') !== false) {
                          $btnClass = "btn-success";
                          $iconClass = "fas fa-futbol";
                        } elseif (strpos($titleLower, 'family') !== false) {
                          $btnClass = "btn-warning";
                          $iconClass = "fas fa-users";
                        }
                        ?>
                        <div class="btn <?= $btnClass ?> w-100 mb-2" title="<?= htmlspecialchars($evt['description']) ?>">
                          <i class="<?= $iconClass ?>"></i> <?= htmlspecialchars($evt['title']) ?>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
            </div>
          </div>

        </div>
        <?php include __DIR__ . '/partials/footer.php'; ?>
      </div>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <!-- Scripts -->
  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Sign Out functionality
      const signoutLink = document.querySelector('.signout-link');
      if (signoutLink) {
        signoutLink.addEventListener('click', function(e) {
          e.preventDefault();
          Swal.fire({
            title: 'Sign Out',
            text: 'Are you sure you want to sign out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, sign out',
            cancelButtonText: 'Cancel',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../auth/logout.php';
            }
          });
        });
      }

      // Line Chart
      const ctx = document.getElementById("gradesLineChart");
      if (ctx) {
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'],
            datasets: [{
              label: "Final Grade",
              data: <?= json_encode(array_values($finalGrades)) ?>,
              backgroundColor: 'rgba(40,167,69,0.2)',
              borderColor: 'rgba(40,167,69,1)',
              borderWidth: 2,
              fill: true,
              tension: 0.3,
              pointRadius: 4
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true,
                suggestedMax: 100
              }
            },
            plugins: {
              legend: {
                display: true,
                position: 'bottom'
              }
            }
          }
        });
      }

      // Pie Chart
      const pie = document.getElementById("taskCompletionPieChart");
      if (pie) {
        new Chart(pie, {
          type: 'doughnut',
          data: {
            labels: ["Submitted", "Not Submitted"],
            datasets: [{
              data: [<?= $submittedCount ?>, <?= $notSubmittedCount ?>],
              backgroundColor: ['#28a745', '#FBCD5F'],
              hoverBackgroundColor: ['#218838', '#c82333'],
              hoverBorderColor: "rgba(234, 236, 244, 1)"
            }]
          },
          options: {
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
              legend: {
                display: false
              }
            }
          }
        });
      }
    });
  </script>
</body>

</html>
