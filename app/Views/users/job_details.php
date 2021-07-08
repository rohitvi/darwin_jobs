<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm header_job_single">
    <div class="header_job_single_inner container">
      <div class="poster_company">
        <img alt="brand logo" class="img img-fluid" src="<?= $data['company_logo'] ?>">
      </div>
      <div class="poster_details">
        <h2><?= $data['title'] ?></h2>
        <ul>
          <li>
            <i class="fas fa-landmark"></i>
            <?= get_company_name($data['company_id']) ?>
          </li>
          <li>
            <i class="fas fa-map-marker-alt"></i>
            <?= get_state_name($data['state']) ?>, <?= get_city_name($data['city']) ?>
          </li>
          <li>
            <i class="far fa-clock"></i>
            <?= time_ago($data['created_date']) ?>
          </li>
        </ul>
      </div>
      <div class="poster_action">
        <a class="addtofav" title="add to favourite" onclick="save(<?= $data['id']; ?>)" href="#"><i id="save" style="cursor:pointer" class="<?= (in_array($data['id'], $saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
        <a class="btn btn-third" onclick="apply(<?= $data['id'] ?>)" href="#">Apply Now</a>

      </div>
    </div>

  </div>
</div>
</header>
<main>
  <div class="single_job">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="row ">
            <div class="col-md-12 single_job_main">
              <h2>Job Description</h2>
              <p><?= $data['description'] ?></p>
            </div>
            <div class="col-md-12 single_job_main">
              <h2>Cover Letter</h2>
              <div class="form-group">
                <textarea id="cover" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="single-job-sidebar">
            <div class="sjs_box">
              <h3>Job Summary</h3>
              <ul class="single-job-sidebar-features">
                <li>
                  <i class="fas fa-map-marker-alt"></i>
                  <h6>Location</h6>
                  <p><?= get_state_name($data['state']) ?>, <?= get_city_name($data['city']) ?></p>
                </li>
                <li>
                  <i class="fas fa-briefcase"></i>
                  <h6>Job Type</h6>
                  <p><?= get_job_type_name($data['job_type']) ?></p>
                </li>
                <li>
                  <i class="fas fa-money-bill-alt"></i>
                  <h6>Salary</h6>
                  <p>₹<?= $data['min_salary'] ?> - ₹<?= $data['max_salary'] ?></p>
                </li>
                <li>
                  <i class="far fa-clock"></i>
                  <h6>Date Posted</h6>
                  <p><?= time_ago($data['created_date']) ?></p>
                </li>
              </ul>
            </div>
          </div>
          <div class="sjs_box_action">
            <a class="btn btn-third text-white" onclick="apply(<?= $data['id'] ?>)">Apply Job</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH . 'users/include/footer.php'); ?>
<script>
  function save(id) {
    event.preventDefault();
    var data = {
      job_id: id
    };
    $.ajax({
      url: '<?= base_url('home/save_job') ?>',
      method: 'POST',
      data: data,
      success: function(responses) {
        $("#save").toggleClass("fas far");
        var response = responses.split('~');
        if ($.trim(response[0]) == 0) {
          toastr.error(response[1]);
        }
        if ($.trim(response[0]) == 1) {
          toastr.success(response[1]);
        }
      }
    });
  }

  function apply(id) {
    event.preventDefault();
    var data = {
      'job_id': id,
      'employer_id': '<?= $data['employer_id'] ?>',
      'username': '<?= session('username') ?>',
      'cover_letter': $('#cover').val(),
      'email': '<?= $data['email'] ?>',
      'job_title': '<?= $data['title'] ?>',
      'job_actual_link': '<?= base_url('home/jobdetails/') ?>/' + id,
    };
    $.ajax({
      url: '<?= base_url('home/apply_job') ?>',
      method: 'post',
      data: data,
      success: function(responses) {
        var response = responses.split('~');
        if ($.trim(response[0]) == 0) {
          toastr.error(response[1]);
        }
        if ($.trim(response[0]) == 1) {
          toastr.success(response[1]);
        }
      }
    })
  }
</script>