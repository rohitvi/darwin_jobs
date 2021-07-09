<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
    <h2>Complete Profile</h2>
  </div>
</div>
</header>
<main>
    <div class="job_container">
        <div class="container">
            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Languages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Resume/CV</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active">
                    <h3>Language</h3>
                    <div class="container">
                        <div class="row">
                            <div class='col-md-6'>
                                <label for="Language">Language</label>
                                <?php
                                    $educations = get_languages_list();
                                    $options = array('' => 'Select Option') + array_column($educations, 'lang_name', 'lang_id');
                                    echo form_dropdown('language', $options,'', 'class="form-control" ');
                                ?>
                            </div>

                            <div class='col-md-6'>
                                <label for="Language">Proficiency with this language</label>
                                <?php
                                    $options = get_language_levels();
                                    echo form_dropdown('lang_level', $options, '', 'class="form-control" ');
                                ?>
                            </div>
                            <div class='col-md-12'>
                                <button onclick="profile()" type="submit" class="btn btn-primary my-3" >Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include(VIEWPATH . 'users/include/footer.php'); ?>
<script>
    function profile(){
        window.location = 'resume';
    }
</script>