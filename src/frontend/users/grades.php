<?php
// LOAD XML AND PARSE GRADES
$xml = simplexml_load_file(__DIR__ . '/../../data/private/user-grades.xml');
$grades = [];

foreach ($xml->subject as $subject) {
    $name = (string)$subject['name'];
    $teacher = (string)$subject['teacher'];
    $grades[$name] = [
        'teacher' => $teacher,
        'q1' => floatval($subject->q1),
        'q2' => floatval($subject->q2),
        'q3' => floatval($subject->q3),
        'q4' => floatval($subject->q4),
    ];
}

// Compute final grade per quarter (average of all subjects)
$qTotals = ['q1' => 0, 'q2' => 0, 'q3' => 0, 'q4' => 0];
$subjectCount = count($grades);

foreach ($grades as $data) {
  $qTotals['q1'] += $data['q1'];
  $qTotals['q2'] += $data['q2'];
  $qTotals['q3'] += $data['q3'];
  $qTotals['q4'] += $data['q4'];
}

$finalGrades = [
  'q1' => round($qTotals['q1'] / $subjectCount, 2),
  'q2' => round($qTotals['q2'] / $subjectCount, 2),
  'q3' => round($qTotals['q3'] / $subjectCount, 2),
  'q4' => round($qTotals['q4'] / $subjectCount, 2),
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php $currentPage = 'dashboard'; ?>
  <title>User / <?= ucwords(str_replace('-', ' ', $currentPage)) ?></title>

  <!-- FAVICONS -->
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />

  <!-- CUSTOM FONTS -->
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- CORE STYLES -->
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../assets/css/user-grades.css">
</head>

<body id="page-top">

  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>

        <div class="grades-container">
          <h4 class="section-title">Grades and Remarks</h4>

          <div class="grades-card">
            <div class="grades-card-header">
              <i class="fas fa-book"></i>
              <select class="quarter-dropdown">
                <option value="q1">1st Quarter</option>
                <option value="q2">2nd Quarter</option>
                <option value="q3">3rd Quarter</option>
                <option value="q4">4th Quarter</option>
              </select>
            </div>

            <table class="grades-table">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Teacher</th>
                  <th>Status</th>
                  <th>Grade</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>

        <?php include __DIR__ . '/partials/footer.php'; ?>
      </div>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <!-- Core Scripts -->
  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>
  <script src="../../../assets/js/dashboard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- GRADES DROPDOWN FUNCTION -->
  <script>
    const grades = <?= json_encode($grades) ?>;
    const finalGrades = <?= json_encode($finalGrades) ?>;
    const tableBody = document.querySelector('.grades-table tbody');
    const quarterDropdown = document.querySelector('.quarter-dropdown');

    function renderGrades(quarter) {
      tableBody.innerHTML = '';

      // Subject rows
      for (let subject in grades) {
        const data = grades[subject];
        const grade = data[quarter];
        const status = grade > 75 ? 'Passed' : 'Failed';
        const statusClass = status === 'Passed' ? 'passed' : 'failed';

        const row = `
          <tr>
            <td>${subject}</td>
            <td>${data.teacher}</td>
            <td class="status ${statusClass}">${status}</td>
            <td>${grade.toFixed(2)}</td>
          </tr>
        `;
        tableBody.insertAdjacentHTML('beforeend', row);
      }

      // Final grade row
      const final = finalGrades[quarter];
      const finalStatus = final > 75 ? 'Passed' : 'Failed';
      const finalClass = finalStatus === 'Passed' ? 'passed' : 'failed';

      const summaryRow = `
        <tr style="font-weight: bold; background-color: #eafbea;">
          <td>Final Grade</td>
          <td>-</td>
          <td class="status ${finalClass}">${finalStatus}</td>
          <td>${final.toFixed(2)}</td>
        </tr>
      `;
      tableBody.insertAdjacentHTML('beforeend', summaryRow);
    }

    quarterDropdown.addEventListener('change', function () {
      renderGrades(this.value);
    });

    renderGrades("q1"); // default load
  </script>
</body>

</html>
