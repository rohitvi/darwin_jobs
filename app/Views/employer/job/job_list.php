<?php include(VIEWPATH . 'employer/include/header.php'); ?>


<div class=" job_main_right">
  <div class="row job_section">
    <div class="col-sm-12">
      <div class="jm_headings">
        <h5>My Job List</h5>
        <a class="btn btn-primary mypbtn" href="<?= base_url('employer/cmp_info_update') ?>">Company profile</a>
      </div>
      <div class="section-divider">
      </div>
      <table id="sorting-table" class="table mb-0 mv_datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Applicants</th>
                <th>Industry</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th><span style="width:100px;">Actions</span></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
  </div>


</div>
</div>
</div>
</div>
</main>

<?php include(VIEWPATH . 'employer/include/footer.php'); ?>

<script>
  $(document).ready( function () {
      $('.mv_datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 25,
      "bDestroy": true,
      "ajax": "<?= base_url('employer/datatable_json') ?>",
      "order": [
        [5, 'desc']
      ],
      "columnDefs": [{
          "targets": 0,
          "name": "id",
          'searchable': false,
          'orderable': false
        },
        {
          "targets": 1,
          "name": "title",
          'searchable': true,
          'orderable': true,
          'width': '250px'
        },
        {
          "targets": 2,
          "name": "Applicants",
          'searchable': false,
          'orderable': true
        },
        {
          "targets": 3,
          "name": "industry",
          'searchable': true,
          'orderable': true
        },
        {
          "targets": 4,
          "name": "country",
          'searchable': false,
          'orderable': false
        },
        {
          "targets": 5,
          "name": "created_date",
          'searchable': true,
          'orderable': true
        },
        {
          "targets": 6,
          "name": "is_status",
          'searchable': true,
          'orderable': true
        },
        {
          "targets": 7,
          "name": "action",
          'searchable': false,
          'orderable': false,
          'width': '130px'
        }
      ]
    });
  });
</script>