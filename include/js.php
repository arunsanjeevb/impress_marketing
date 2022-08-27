<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/spin.js/spin.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/select2/select2.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/multi-select/jquery.multi-select.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/moment/moment.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/toastr/toastr.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/App.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppNavigation.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppOffcanvas.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppCard.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppForm.js"></script>
<!--<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/ckeditor/ckeditor.js"></script>-->
<!--<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/ckeditor/adapters/jquery.js"></script>-->
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/libs/summernote/summernote.min.js"></script>
<script  src="<?php echo $prefix1; ?>include/daterange/daterangepicker.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppNavSearch.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/source/AppVendor.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/demo/Demo.js"></script>
<script src="../<?php echo $prefix1; ?>templeteV2/assets/js/core/demo/DemoFormComponents.js"></script>
<script  src="../include/daterange/daterangepicker.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="../../templeteV2/assets/js/libs/raphael/raphael-min.js"></script>
<script src="../../templeteV2/assets/js/libs/morris.js/morris.min.js"></script>
<!--<script src="include/DashboardCharts.js"></script>-->

<script type="text/javascript">
    $(document).ready(function () {

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
</script>
<script>
    $('#datatable1').DataTable({
        "dom": 'lCfrtip',
        "order": [],
        "colVis": {
            "buttonText": "Columns",
            "overlayFade": 0,
            "align": "right"
        },
        "language": {
            "lengthMenu": '_MENU_ entries per page',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                "next": '<i class="fa fa-angle-right"></i>'
            }
        }

    });

</script>
