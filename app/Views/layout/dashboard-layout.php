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
    <?= $this->include('includes/footer-includes') ?>
    <div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-xl">
     <?= $this->include('includes/dashboard-sidebar') ?> 
      <div class="dashboard__main pl0-md">
        <div class="dashboard__content hover-bgc-color">          
            <?= $this->include('includes/dashboard-head') ?>
            
         
            <?= $this->renderSection('content') ?>            
            
         
          </div>
          <?= $this->include('includes/dashboard-footer2') ?> 
        </div>        
      </div>    
    </div>
  </div>
    </div>    
</div>
</body>
</html>
