<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('includes/head') ?>
</head>
<body class="">
<div class="wrapper ovh">
  <div class="preloader"></div>
    <?= $this->include('includes/header-template2') ?>
    <?= $this->include('includes/navbar') ?>
    <div class="body_content">
    <!-- Content Section -->
    <?= $this->renderSection('content') ?>
    </div>
    <?= $this->include('includes/footer') ?>
    <?= $this->include('includes/footer-includes') ?>
</div>
</body>
</html>
