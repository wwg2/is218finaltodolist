<?php include 'header.php'; ?>
    <main class="container">
      <?php include 'flashmessages.php'; ?>
        <div class="card mt-3">
          <div class="card-header bg-info text-white">
            Welcome, <?php echo($_SESSION['firstName'] . ' ' . $_SESSION['lastName']) ?>
          </div>