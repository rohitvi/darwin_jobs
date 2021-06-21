<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>General Settings</h1>
          </div>
          <div class="col-sm-4">
         <!-- get flash meassage display -->

          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Settings</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<form method='post' action="<?= base_url('admin/add_general_settings')?>" enctype="multipart/form-data">
    <section>
    <div class='container-fluid'>
    <div class='row'>
    <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">General Setting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Email Setting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Social Media Setting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Google reCAPTCHA</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-payment-tab" data-toggle="pill" href="#custom-tabs-four-payment" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">Payment Settings</a>
                  </li>
                </ul>
              </div>
              <div class="card-body"><!--card body start 1 -->
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade  active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab"><!--general setting start 1 -->
                  
                  <div class="card-body">

                  <div class="form-group">
                  <label class="control-label">Favicon (25*25)</label>
                  <?php if(!empty($gsetting['favicon'])):?>
                    <img src="<?= $gsetting['favicon']; ?>" class="favicon">
                  <?php endif; ?>
                    <input type="file" name="favicon" class="form-control">
                    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                  </div>

                  <div class="form-group">
                  <label class="control-label">Logo</label>
                  <?php if(!empty($gsetting['logo'])):?>
                    <img src="<?= $gsetting['logo']; ?>" class="favicon">
                  <?php endif; ?>
                    <input type="file" name="logo" class="form-control">
                    <p><small class="text-success">Allowed Types: gif, jpg, png, jpeg</small></p>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Application Name</label>
                    <input type="text" class="form-control" name="application_name" value="<?= $gsetting['application_name'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Copyright</label>
                      <input type="text" class="form-control" name="copyright" value="<?= $gsetting['copyright'];?>">
                  </div>

                  
                <!--row start-->
    <div class="row">
        <div class="col-md-12">
            <h5>Footer Settings</h5>
            <p>Manage your website footer</p>
        </div>
        <div class="col-md-12">
            <div class="footer-widget">
                <div class="footer-widget-header">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Title</label> 
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Size</label>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Content</label>
                        </div>
                        <div class="col-md-1">
              
                        </div>
                    </div>
                </div>

            <div class="footer-widget-body">
      
            <?php foreach ($footer_settings as $footer): ?>
            <div class="widget">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                  <input type="text" class="form-control" name="widget_field_title_add[]" value="<?= $footer['title'] ?>">
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">

                  <?php 
                    $options = array('4' => '1/4','3' => '1/3','2' => '1/2',);
                    $others = array('class' => 'form-control');
                    echo form_dropdown('widget_field_column_add[]',$options,$footer['grid_column'],$others);
                    ?> 
                 
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <textarea class="form-control" name="widget_field_content_add[]"><?= $footer['content'] ?></textarea>
                  </div>
                </div>
                <div class="col-md-1">
                  <!-- <button type="button" class="btn btn-danger remove-footer-widget"><i class="fa fa-trash"></i></button> -->
                  <a title="Delete"  class="btn btn-danger remove-footer-widget" href="<?= base_url('admin/delete_footer_setting/'.$footer['id']); ?>"> <i class="nav-icon fas fa-trash"></i></a>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
          
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-info btn-add-widget"><i class="fa fa-plus"></i> Add Widget</button>
        </div>
      </div>
    </div>
  </div>
                <!--row end-->


                 </div> <!--card body end 1-->
                  </div><!--General setting end 1 -->

<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab"><!--Email setting start -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input type="text" class="form-control" name="admin_email" value="<?= $gsetting['system_email'];?>"  placeholder="my-email@admin.com">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email From/ Reply to</label>
                    <input type="text" class="form-control" name="email_from" value="<?= $gsetting['email_from'];?>" placeholder="no-reply@domain.com">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SMTP Host</label>
                    <input type="text" class="form-control" name="smtp_host" value="<?= $gsetting['smtp_host'];?>" placeholder="SMTP Host">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SMTP Port</label>
                    <input type="text" class="form-control" name="smtp_port" value="<?= $gsetting['smtp_port'];?>" placeholder="SMTP Port">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SMTP User</label>
                    <input type="text" class="form-control" name="smtp_user" value="<?= $gsetting['smtp_user'];?>" placeholder="SMTP User">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SMTP Password</label>
                    <input type="password" class="form-control" name="smtp_pass" value="<?= $gsetting['smtp_pass'];?>" placeholder="SMTP Password">
                  </div>
</div><!--Email setting end -->

<div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab"><!--Social setting start -->
                    <div class="form-group">
                    <label for="exampleInputEmail1">Facebook</label>
                    <input type="text" class="form-control" name="facebook_link" value="<?= $gsetting['facebook_link'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Twitter</label>
                    <input type="text" class="form-control" name="twitter_link" value="<?= $gsetting['twitter_link'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Google Plus</label>
                    <input type="text" class="form-control" name="google_link" value="<?= $gsetting['google_link'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Youtube</label>
                    <input type="text" class="form-control" name="youtube_link" value="<?= $gsetting['youtube_link'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">LinkedIn</label>
                    <input type="text" class="form-control" name="linkedin_link" value="<?= $gsetting['linkedin_link'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram</label>
                    <input type="text" class="form-control" name="instagram_link" value="<?= $gsetting['instagram_link'];?>">
                  </div>

</div><!--Social setting end -->

<div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab"><!--google recaptcha setting start -->
                    <div class="form-group">
                    <label for="exampleInputEmail1">Site Key</label>
                    <input type="text" class="form-control" name="recaptcha_site_key" value="<?= $gsetting['recaptcha_site_key'];?>" placeholder="Site Key">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Secret Key</label>
                    <input type="text" class="form-control" name="recaptcha_secret_key" value="<?= $gsetting['recaptcha_secret_key'];?>" placeholder="Secret Key">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Language</label>
                    <input type="text" class="form-control" name="recaptcha_lang" value="<?= $gsetting['recaptcha_lang'];?>" placeholder="Language Code">
                    <a href="https://developers.google.com/recaptcha/docs/language" target="_blank">https://developers.google.com/recaptcha/docs/language</a>
                  </div>
</div><!--google recaptcha setting end -->

<div class="tab-pane fade" id="custom-tabs-four-payment" role="tabpanel" aria-labelledby="custom-tabs-four-payment-tab"><!--payment setting starts -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Rozarpay Secret</label>
                    <input type="text" class="form-control" name="razorpay_secret" value="<?= $gsetting['razorpay_secret'];?>" placeholder="Secret Key">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Rozarpay Key</label>
                    <input type="text" class="form-control" name="razorpay_key" value="<?= $gsetting['razorpay_key'];?>" placeholder="Secret Key">
                  </div>

                  <hr>
                  <label>STRIPE Payment Settings</label>

                  <div class="form-group">
                    <label for="exampleInputEmail1">x Key</label>
                    <input type="text" class="form-control" name="x-key" value="<?= $gsetting['x-key'];?>" placeholder="Secret Key">
                  </div>
    
                  <div class="form-group">
                    <label for="exampleInputEmail1">x Secret</label>
                    <input type="text" class="form-control" name="x-secret" value="<?= $gsetting['x-secret'];?>" placeholder="Publishable Key">
                  </div>

</div><!--payment setting end -->

                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
    </div>
    </div>


    <!--save button start-->
    <div class="card card-outline card-primary">
              <div class="card-header">
                <div class="card-tools">
                <input type="submit" name="submit" value="Save Changes" class="btn btn-info pull-left">
                </div>
              </div>
              <!-- /.card-header -->
    </div>
    <!--save button ends-->


    </section>
  </form>
    </div>
    
<script>
$(document).ready(function(){
// Add new widget
$('.btn-add-widget').on('click',function()
{
widget = '<div class="widget">\
    <div class="row">\
        <div class="col-md-3">\
          <div class="form-group">\
            <input type="text" class="form-control" name="widget_field_title_add[]" >\
          </div>\
        </div>\
        <div class="col-md-2">\
        <div class="form-group">\
        <select class="form-control" name="widget_field_column_add[]">\
        <option value="4">1/4</option>\
        <option value="3">1/3</option>\
        <option value="2">1/2</option>\
        </select>\
        </div>\
        </div>\
        <div class="col-md-6">\
          <div class="form-group">\
            <textarea class="form-control" name="widget_field_content_add[]"></textarea>\
          </div>\
        </div>\
        <div class="col-md-1">\
            <button type="button" class="btn btn-danger remove-footer-widget"><i class="fa fa-trash"></i></button>\
        </div>\
    </div>\
</div>';

$('.footer-widget-body').append(widget);
  });



// Remove Widget
$(document).on('click','.remove-footer-widget',function()
{
  a = confirm('are you sure?');
  (a) ? $(this).closest('div.widget').remove() : '';
    
});

});
    
</script>

<script>
$(document).ready(function(){
<?php if (session()->getFlashdata('status')) {?>
      swal({
        title: "<?= session()->getFlashdata('status') ?>",
        icon: "<?= session()->getFlashdata('status_icon') ?>",
        button: "OK",
        });
<?php }?>

$('.swal-overlay').delay(3000).fadeOut('slow');
});
</script>

    <?php include(VIEWPATH.'admin/include/footer.php'); ?>