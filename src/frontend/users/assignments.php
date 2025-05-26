<?php
$xml = simplexml_load_file(__DIR__ . '/../../data/private/user-grades.xml');

// Calculate final average per quarter
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User / Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />

  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/assignments.css">
</head>

<body id="page-top">

  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>

        <!--start here-->
        <div class="container-fluid">
          <h4 class="section-title text-success">Assignments</h4>

          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"></span>
            <select id="assignmentFilter" class="form-select w-auto">
              <option value="all">All Assignments</option>
              <option value="submitted">Submitted</option>
              <option value="todo">Need to Do</option>
            </select>
          </div>

          <div class="row">
            <?php
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

            $colors = [
              "Mathematics" => "#dbe9ff",
              "Science" => "#e6b8b8",
              "Filipino" => "#dcb3cb",
              "Values Education" => "#bdecb6",
              "Physical Education" => "#f3d9a4",
              "MAPEH" => "#f9f2bd",
              "Araling Panlipunan" => "#f7c6a3",
              "English" => "#b8d2e6"
            ];

            foreach ($assignments as $subject => $tasks) {
              $status = 'submitted';
              foreach ($tasks as $task) {
                if ($task['status'] === 'not done') {
                  $status = 'todo';
                  break;
                }
              }

              echo '<div class="col-md-3 mb-4 assignment-item" data-status="' . $status . '">';
              echo '<div class="assignment-card" style="background-color:' . $colors[$subject] . '">';
              echo '<div class="assignment-card-header"><strong>' . htmlspecialchars($subject) . '</strong></div>';
              echo '<div class="assignment-card-body">';
              if (!empty($tasks)) {
                echo '<ul>';
                foreach ($tasks as $task) {
                  $taskClass = '';
                  if ($task['status'] === 'not done') $taskClass = 'not-done';
                  elseif ($task['status'] === 'passed') $taskClass = 'passed-deadline';

                  echo '<li class="' . $taskClass . '">' . htmlspecialchars($task['task']) . '</li>';
                }
                echo '</ul>';
              } else {
                echo '<p class="text-success">All Assignments Completed!</p>';
              }
              echo '</div></div></div>';
            }
            ?>
          </div>
        </div>

        <?php include __DIR__ . '/partials/footer.php'; ?>
      </div>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.getElementById('assignmentFilter').addEventListener('change', function () {
      const value = this.value;
      const cards = document.querySelectorAll('.assignment-item');

      cards.forEach(card => {
        const status = card.getAttribute('data-status');
        if (value === 'all' || status === value) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });

    // Sign Out functionality
    document.addEventListener('DOMContentLoaded', () => {
      const signoutLink = document.querySelector('.signout-link');
      if (signoutLink) {
        signoutLink.addEventListener('click', function (e) {
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
    });
  </script>

</body>
</html>
