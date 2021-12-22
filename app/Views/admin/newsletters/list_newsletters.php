<?php include(VIEWPATH . 'admin/include/header.php'); ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Subscribers List</h1>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Subscribers</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-success" data-toggle="modal" data-target="#subscriberModal"><i class="fa fa-list"></i> &nbsp;Compose Email</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped" id="basic_filter">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="all-subscribers-checkbox"></th>
                    <th>Email</th>
                    <th>Date</th>
                    <th style="width: 150px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($newsletters as $row) : ?>

                    <tr>
                      <td><input type="checkbox" class="subscriber-checkbox" value="<?= $row['id']; ?>"></td>
                      <td><?= $row['email']; ?></td>
                      <td><?= date_time($row['created_at']); ?></td>
                      <td><a class="btn btn-danger btn-xs" onclick="return confirm('Are you Sure to Delete ?')" href="<?= base_url('admin/del_newsletters/' . $row['id']); ?>"><i class="fa fa-trash"></i> Delete</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

</div>

<!-- Modal -->
<div id="subscriberModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Compose Email</h4> -->
      </div>
      <div class="modal-body">
        <form action="newsletter" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <i class="fa fa-info-circle"></i> If you don't choose any recipeints then email will send to all subscribers
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="name" class="control-label">Subject</label>
              <input type="text" name="title" class="form-control" placeholder="Subject">
              <input type="hidden" name="recipients" class="subscriber-recipients" value="all">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="name" class="control-label">Content</label>
              <textarea name="content" class="textarea form-control" rows="10"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <!-- <input type="button" value="Preview" class="btn btn-warning pull-right" id="btn_preview_email"> -->
              &nbsp;&nbsp;
              <input type="submit" name="submit" value="Send Email" class="btn btn-primary">
            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>







<!-- /.content-wrapper -->
<?php include(VIEWPATH . 'admin/include/footer.php'); ?>

<script>
  $(function() {

    $('.all-subscribers-checkbox').on('click', function() {
      if ($(this).is(':checked')) {
        $('.subscriber-checkbox').prop('checked', true);
        $('input[name=recipients]').val('all');
      } else {
        $('.subscriber-checkbox').prop('checked', false);
        $('input[name=recipients]').val('all');
      }
    });

    $('.subscriber-checkbox').on('click', function() {
      if ($('.subscriber-checkbox:checked').length == $('.subscriber-checkbox').length) {
        $('.all-subscribers-checkbox').prop('checked', true);
        $('input[name=recipients]').val('all');
      } else {
        $('.all-subscribers-checkbox').prop('checked', false);
        var checkedVals = $('.subscriber-checkbox:checkbox:checked').map(function() {
          return this.value;
        }).get();
        $('input[name=recipients]').val(checkedVals.join(","));
      }
    });

  });
</script>