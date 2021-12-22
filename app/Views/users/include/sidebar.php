<?php $ap = basename($_SERVER['PHP_SELF'], ".php"); ?>

<div class="sidebar">
  <h5>Account</h5>
  <ul class="user_navigation">
    <li class="<?= (uri_string(true) == "home/profile") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/profile') ?>"><i class="fas fa-user"></i> Update My Profile</a>
    </li>
    <li class="<?= (uri_string(true) == "home/applied_jobs") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/applied_jobs') ?>"><i class="fas fa-user"></i> My Application</a>
    </li>
    <li class="<?= (uri_string(true) == "home/matching_jobs") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/matching_jobs') ?>"><i class="fas fa-user"></i> Matching Jobs</a>
    </li>
    <li class="<?= (uri_string(true) == "home/saved_jobs") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/saved_jobs') ?>"><i class="fas fa-user"></i> Saved Jobs</a>
    </li>
    <li class="<?= (uri_string(true) == "home/change_password") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/change_password') ?>"><i class="fas fa-key"></i>Change Password</a>
    </li>
    <li class="<?= (uri_string(true) == "home/logout") ? "is-active" : '' ?>">
      <a href="<?= base_url('home/logout') ?>"><i class="fas fa-power-off"></i> Logout</a>
    </li>
  </ul>
</div>