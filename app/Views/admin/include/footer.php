  <footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">DPIT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <!-- <script src="<?= base_url('public/admin/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script> -->
  <!-- jQuery -->
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('public/admin/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('public/admin/plugins/chart.js/Chart.min.js') ?>"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('public/admin/plugins/sparklines/sparkline.js') ?>"></script>
  <!-- JQVMap -->
  <script src="<?= base_url('public/admin/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('public/admin/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('public/admin/plugins/moment/moment.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
  <!-- Summernote -->
  <script src="<?= base_url('public/admin/plugins/summernote/summernote-bs4.min.js') ?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('public/admin/dist/js/adminlte.js') ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url('public/admin/dist/js/demo.js') ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url('public/admin/dist/js/pages/dashboard.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
  <script src="https://unpkg.com/izitoast@1.4.0/dist/js/iziToast.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('public/admin/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?= base_url('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('public/users/js/tagin.min.js') ?>"></script>
	<script>
		$(function() {
			$("#basic_filter").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
		});
	</script>
	<!-- Date Picker -->
  <script src="<?= base_url('public/admin/plugins/daterangepicker/daterangepicker.js') ?>"></script>
	<script type="text/javascript">
			$('.hr_datepicker').datepicker({ dateFormat: 'YY-mm-dd'});
	</script>
  <!-- Select2 -->
  <script src="<?= base_url('public/admin/plugins/select2/js/select2.full.min.js') ?>"></script>
  <script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  </script>
  <!-- Toastr -->
  <script src="<?= base_url('public/admin/plugins/toastr/toastr.min.js') ?>"></script>
  <script type="text/javascript">
    <?= (session()->getFlashdata('success')) ? "toastr.success('" . session()->getFlashdata('success') . "')" : '' ?>
    <?= (session()->getFlashdata('error')) ? "toastr.error('" . session()->getFlashdata('error') . "')" : '' ?>
    <?= (session()->getFlashdata('denied')) ? "toastr.warning('" . session()->getFlashdata('denied') . "')" : '' ?>
  </script>
  </body>

  </html>