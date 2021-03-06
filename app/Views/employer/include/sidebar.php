<div class="sidebar">

          <ul class="user_navigation">
            <li class="<?= (uri_string(true) == "employer/dashboard") ? "is-active" : '' ?>">
              <a href="<?= base_url('employer') ?>">
                <i class="fas fa-border-all"></i> Job Dashboard </a>
              </li>
              <li class="<?= (uri_string(true) == "employer/search") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/search') ?>"><i class="fas fa-user"></i>Find Candidates</a>
              </li>
              <li class="<?= (uri_string(true) == "employer/shortlisted") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/shortlisted') ?>"><i class="fas fa-user"></i>ShortListed Candidates</a>
              </li>
          </ul>
          <h5>Packages</h5>
          <ul class="user_navigation">
              <li class="<?= (uri_string(true) == "employer/packages") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/packages') ?>"><i class="fas fa-money-bill"></i>Buy Packages</a>
              </li>
          </ul>
          <h5>Organize and Manage</h5>
          <ul class="user_navigation">
              <li class="<?= (uri_string(true) == "employer/post") ? "is-active" : '' ?>">
              <a href="<?= base_url('employer/post') ?>"><i class="fas fa-paper-plane"></i> Post Job</a>
              </li>
              <li class="<?= (uri_string(true) == "employer/list_jobs") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/list_jobs') ?>"><i class="far fa-list-alt"></i> My job listings</a>
              </li>
              
              
          </ul>
          <h5>Account</h5>
          <ul class="user_navigation">
            <li class="<?= (uri_string(true) == "employer/profile") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/profile') ?>"><i class="fas fa-user"></i> Update My Profile</a>
            </li>
            <li class="<?= (uri_string(true) == "employer/cmp_info_update") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/cmp_info_update') ?>"><i class="fas fa-user"></i> Update My Company</a>
            </li>
            <li class="<?= (uri_string(true) == "employer/mypackages") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/mypackages') ?>"><i class="fas fa-list"></i> My packages</a>
            </li>
            <li class="<?= (uri_string(true) == "employer/changepassword") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/changepassword') ?>"><i class="fas fa-key"></i>Change Password</a>
            </li>
            <li class="<?= (uri_string(true) == "employer/logout") ? "is-active" : '' ?>">
                <a href="<?= base_url('employer/logout') ?>"><i class="fas fa-power-off"></i> Logout</a>
            </li>
          </ul>
        </div>