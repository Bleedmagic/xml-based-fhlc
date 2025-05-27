<?php
// Gatekeeper
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guardian') {
  header('Location: ../auth/login.php');
  exit();
}

$xmlFile = __DIR__ . '/../../data/private/complaints-requests-user.xml';

function loadComplaints($xmlFile)
{
  if (!file_exists($xmlFile)) {
    if (!file_exists(dirname($xmlFile))) {
      mkdir(dirname($xmlFile), 0777, true);
    }
    $xml = new SimpleXMLElement('<complaints></complaints>');
    $xml->asXML($xmlFile);
  }
  $xml = simplexml_load_file($xmlFile);
  if ($xml === false) {
    die('Failed to load XML file.');
  }

  $complaints = [];
  foreach ($xml->complaint as $complaint) {
    $status = strtolower((string)$complaint->status);
    if ($status === 'archived') {
      continue; // skip archived complaints
    }
    $id = (int)$complaint['id'];
    $complaints[$id] = [
      'type' => (string)$complaint->type,
      'subject' => (string)$complaint->subject,
      'date' => (string)$complaint->date,
      'status' => (string)$complaint->status,
      'message' => (string)$complaint->message ?? '',
    ];
  }
  return $complaints;
}

$complaints = loadComplaints($xmlFile);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>User / Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="apple-touch-icon" href="../../../assets/img/favicons/apple-touch-icon.png" sizes="180x180" />
  <link rel="icon" href="../../../assets/img/favicons/favicon.ico" />
  <link href="../../../assets/css/lib/fontawesome.all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet" />
  <link href="../../../assets/css/lib/startbootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../../../assets/css/complaints-request.css" />
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include __DIR__ . '/partials/topbar.php'; ?>

        <div class="container-fluid complains-request">
          <h4 class="section-title">Complaints / Requests</h4>

          <div class="controls-row">
            <div class="dropdown sort-dropdown">
              <button class="filter-btn dropdown-toggle" id="sortDropdownBtn">
                <span id="currentSort">Latest</span> <i class="fas fa-chevron-down ml-1"></i>
              </button>
              <ul class="dropdown-menu" id="sortMenu">
                <li data-sort="latest" class="selected">Latest</li>
                <li data-sort="oldest">Oldest</li>
              </ul>
            </div>

            <div class="search-add-group">
              <input type="text" placeholder="Search..." class="search-bar" id="searchInput" />
              <a href="add-complaints-request.php" class="add-btn"><i class="fas fa-plus"></i></a>
            </div>
          </div>

          <div class="table-container">
            <table class="custom-table">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Subject</th>
                  <th>Date Submitted</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($complaints)): ?>
                  <?php
                  uasort($complaints, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
                  foreach ($complaints as $id => $entry):
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($entry['type']) ?></td>
                      <td><?= htmlspecialchars($entry['subject']) ?></td>
                      <td><?= htmlspecialchars($entry['date']) ?></td>
                      <td><?= htmlspecialchars($entry['message']) ?></td>
                      <td><?= htmlspecialchars($entry['status']) ?></td>
                      <td class="action">
                        <a href="edit-complaints-requests.php?id=<?= $id ?>" class="edit-btn" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="archive-btn" data-id="<?= $id ?>" title="Archive">
                          <i class="fas fa-archive"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6">No complaints or requests submitted yet.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php include __DIR__ . '/partials/footer.php'; ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <script src="../../../assets/js/lib/jquery.min.js"></script>
  <script src="../../../assets/js/lib/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/lib/jquery.easing.min.js"></script>
  <script src="../../../assets/js/lib/startbootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const searchInput = document.getElementById("searchInput");
      const tableRows = document.querySelectorAll(".custom-table tbody tr");

      // Search filter
      searchInput.addEventListener("keyup", function() {
        const query = this.value.toLowerCase();
        tableRows.forEach(row => {
          const rowText = row.textContent.toLowerCase();
          row.style.display = rowText.includes(query) ? "" : "none";
        });
      });

      // Archive button
      document.querySelectorAll('.archive-btn').forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const id = this.getAttribute('data-id');

          Swal.fire({
            title: 'Archive this complaint/request?',
            text: "It will be moved to archive.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, archive it!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'archive-complaints-requests.php?id=' + id;
            }
          });
        });
      });

      // Sort dropdown
      const dropdownBtn = document.getElementById("sortDropdownBtn");
      const dropdownMenu = document.getElementById("sortMenu");
      const currentSort = document.getElementById("currentSort");

      dropdownBtn.addEventListener("click", function() {
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
      });

      document.addEventListener("click", function(e) {
        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.style.display = "none";
        }
      });

      dropdownMenu.querySelectorAll("li").forEach(item => {
        item.addEventListener("click", function() {
          dropdownMenu.querySelectorAll("li").forEach(li => li.classList.remove("selected"));
          this.classList.add("selected");

          const sortType = this.getAttribute("data-sort");
          currentSort.textContent = this.textContent;
          dropdownMenu.style.display = "none";

          const tbody = document.querySelector(".custom-table tbody");
          const rowsArray = Array.from(tbody.querySelectorAll("tr"));

          rowsArray.sort((a, b) => {
            const dateA = new Date(a.cells[2].textContent.trim());
            const dateB = new Date(b.cells[2].textContent.trim());
            return sortType === 'latest' ? dateB - dateA : dateA - dateB;
          });

          rowsArray.forEach(row => tbody.appendChild(row));
        });
      });

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
    });
  </script>

</body>

</html>
