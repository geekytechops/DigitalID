<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('includes/head') ?>
</head>
<body class="">
<div class="wrapper ovh">
  <div class="preloader"></div>
    <?= $this->include('includes/dashboard-header') ?>
    <?= $this->include('includes/navbar') ?>
    <div class="body_content">
    <!-- Content Section -->
    <?= $this->renderSection('content') ?>
    </div>    
    <?= $this->include('includes/footer-includes') ?>
</div>
</body>
</html>
