                    <!-- Begin Page Footer-->
                    <footer class="main-footer">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                                <p class="text-gradient-02">Design By DPIT</p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-end justify-content-lg-end justify-content-md-end justify-content-center">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="documentation.html">Documentation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="changelog.html">Changelog</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </footer>
                    <!-- End Page Footer -->
                    <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                </div>
                <!-- End Content -->
            </div>
            <!-- End Page Content -->
        </div>
        <!-- Begin Success Modal -->
        <div id="delay-modal" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="sa-icon sa-success animate" style="display: block;">
                            <span class="sa-line sa-tip animateSuccessTip"></span>
                            <span class="sa-line sa-long animateSuccessLong"></span>
                            <div class="sa-placeholder"></div>
                            <div class="sa-fix"></div>
                        </div>
                        <div class="section-title mt-5 mb-5">
                            <h2 class="text-dark">Meeting successfully created</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Success Modal -->
        <!-- Begin Modal -->
        <div id="modal-view-event" class="modal modal-top fade calendar-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title event-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">DPIT
                        <div class="media">
                            <div class="media-left align-self-center mr-3">
                                <div class="event-icon"></div>
                            </div>
                            <div class="media-body align-self-center mt-3 mb-3">
                                <div class="event-body"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        
    <script type="text/javascript">
        var base_url = "<?= base_url() ?>";
    </script>

    <!-- Begin Vendor Js -->
    <script src="<?= base_url('public/employer/assets/vendors/js/base/core.min.js')?>"></script>
    <!-- End Vendor Js -->
    <!-- Begin Page Vendor Js -->
    <script src="<?= base_url('public/employer/assets/vendors/js/bootstrap-select/bootstrap-select.min.js')?>"></script>    
    <script src="<?= base_url('public/employer/assets/vendors/js/app/app.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/nicescroll/nicescroll.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/chart/chart.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/progress/circle-progress.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/owl-carousel/owl.carousel.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/datatables.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/dataTables.buttons.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/jszip.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/buttons.html5.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/pdfmake.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/vfs_fonts.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datatables/buttons.print.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datepicker/moment.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/datepicker/daterangepicker.js')?>"></script>
    <!-- End Page Vendor Js -->
    <!-- Begin Page Snippets -->
    <script src="<?= base_url('public/employer/assets/js/dashboard/db-default.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/js/components/tables/tables.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/js/app/calendar/basic-calendar.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/js/components/datepicker/datepicker.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/js/app/contact/contact.min.js')?>"></script>
    <script src="<?= base_url('public/employer/assets/vendors/js/noty/noty.min.js')?>"></script>
    <!-- End Page Snippets -->

    <!-- End Custom -->

    <script type="text/javascript">
        $(".alert").delay(8000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
    <?php if (session()->getFlashdata('denied')) { ?>
    <script type="text/javascript">
        // Layouts (Warning)
             new Noty({
                type: 'warning',
                layout: 'topRight',
                text: 'Access Denied.',
                progressBar: true,
                timeout: 2500,
                animation: {
                    open: 'animated bounceInRight', // Animate.css class names
                    close: 'animated bounceOutRight' // Animate.css class names
                }
            }).show();
    </script>
    <?php } ?>
</body>
</html>