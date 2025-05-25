<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  http_response_code(403);
  echo "Unauthorized access.";
  exit();
}
?>

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Full House Learning Center, Inc. <?= date('Y') ?></span>
    </div>
  </div>
</footer>
