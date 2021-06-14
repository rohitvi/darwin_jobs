<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Job type List</h3>
              <button class="float-right btn btn-primary btn-sm" onclick="show_modal('','','0')">Add New</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count=0; foreach($types as $row):?>
                    <tr>
                        <td><?= ++$count; ?></td>
                        <td><span id="type-<?= $row['id'] ?>"><?= $row['type']; ?></span></td>
                        <td><span id="slug-<?= $row['id'] ?>"><?= $row['slug']; ?></span></td>
                        <td><a title="Delete" class="btn-delete btn btn-sm btn-danger pull-right" href="<?= base_url('admin/job_type/del/'.$row['id']); ?>">delete</a>
                        <button type="button" class="btn btn-default pull-right btn-sm" onclick="show_modal('<?= $row['id'] ?>','<?= $row['type'] ?>','<?= $row['slug'] ?>');">Edit</button>   
                    </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Action</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="mymodal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class='modal-body'> 
                <div class="row">
                <!-- left column -->
                    <div class="col-md-12">
                        <form  name="addcategory" id="addcategory" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Job Type Name</label>
                                <input type="text" name="category" class="form-control" id="type" placeholder="Job Type Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" name="category" class="form-control" id="slug" placeholder="Slug Name">
                            </div>
                        </form>
                    </div>
                <!--/.col (left) -->
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="submit">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  <?php include(VIEWPATH.'admin/include/footer.php'); ?>

<script>
    function show_modal(id,name,slug){
        $('#submit').val(id);
        $('#type').val(name);
        $('#slug').val(slug);
        $('#mymodal').modal('show');
    };


    $('#submit').click(()=>{
        var type = $('#type').val();
        var slug = $('#slug').val();
        var submit = $('#submit').val();
        const params = new URLSearchParams();
          params.append('type', type);
          params.append('slug', slug);
          params.append('submit', submit);
          const response = await axios.post('<?= base_url('Admin/addBrand') ?>', params)  
          const data = response.data
          if(data == '1'){
            iziToast.warning({
                  title: 'Warning',
                  message: 'Brand added added',
                  position: 'topRight'
              })
          }
    });
</script>