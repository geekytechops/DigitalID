<?php

$url = current_url();  // Use CodeIgniter's helper to get the current URL
$lastSegment = basename(parse_url($url, PHP_URL_PATH));

?>
<div class="dashboard__sidebar d-none d-lg-block">
  <div class="dashboard_sidebar_list">
    <p class="fz15 fw400 ff-heading pl30">Start</p>
    <div class="sidebar_list_item">
      <a href="dashboard" class="items-center <?= $lastSegment=='dashboard' ? '-is-active' : '' ?>"><i class="flaticon-home mr15"></i>Dashboard</a>
    </div>
    <?php 
    
    if(session()->get('type')== 'superadmin' || session()->get('type')== 'admin'){

    ?>
    <div class="sidebar_list_item">
      <a href="users" class="items-center <?= $lastSegment=='users' ? '-is-active' : '' ?>"><i class="fa-light fa-users mr15"></i>Users</a>
    </div>        
    <?php } ?> 
  </div>
</div>