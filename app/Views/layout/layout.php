<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('includes/head') ?>
</head>
<body class="bgc-thm4">
<div class="wrapper ovh">
  <div class="preloader"></div>
    <?= $this->include('includes/header') ?>
    <?= $this->include('includes/navbar') ?>
    <div class="body_content">
    <!-- Content Section -->

    <?= $this->renderSection('content') ?>
    </div>
    <?= $this->include('includes/footer') ?>
    <?= $this->include('includes/footer-includes') ?>
    <?= $this->renderSection('scripts') ?>
</div>
</body>
</html>
