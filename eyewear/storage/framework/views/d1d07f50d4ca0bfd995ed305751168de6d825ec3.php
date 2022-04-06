<div class="row">
<div class="col-md-12">
<div class="copyright">
<p>Copyright © 2020 Dial4web. All rights reserved. Designed by <a href="#">Dial4web.com</a>.</p>
</div>
</div>
</div>

<!-- Jquery JS-->

<script src="<?php echo e(asset('admin_assets/js/jquery-3.2.1.min.js')); ?>"></script>
<!-- Bootstrap JS-->
<script src="<?php echo e(asset('admin_assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/bootstrap.min.js')); ?>"></script>
<!-- Vendor JS       -->
<script src="<?php echo e(asset('admin_assets/js/slick.min.js')); ?>">
</script>
<script src="<?php echo e(asset('admin_assets/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/animsition.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/bootstrap-progressbar.min.js')); ?>">
</script>
<script src="<?php echo e(asset('admin_assets/js/jquery.waypoints.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/jquery.counterup.min.js')); ?>">
</script>
<script src="<?php echo e(asset('admin_assets/js/circle-progress.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/perfect-scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/Chart.bundle.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="<?php echo e(asset('admin_assets/js/custom.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
      $('#toggle-backup').bootstrapToggle({
        offstyle: 'danger'
      });
      $('#toggle-sitemap').bootstrapToggle({
        offstyle: 'danger'
      });

      $('.backup_option_toggle').change(function(){
        if($(this).prop('checked')){
            $('#admin_backup_option').val("Yes");
            $('#backup_schedule').fadeIn();
            }
        else{
            $('#admin_backup_option').val("No");
            $('#backup_schedule').fadeOut();
            }
      });

      $('.sitemap_option_toggle').change(function(){
        if($(this).prop('checked')){
            $('#admin_sitemap_option').val("Yes");
            $('#sitemap_schedule').fadeIn();
            }
        else{
            $('#admin_sitemap_option').val("No");
            $('#sitemap_schedule').fadeOut();
            }

      });

    });
  </script>
<!-- Main JS-->
<script src="<?php echo e(asset('admin_assets/js/main.js')); ?>"></script>
<script>
$(document).ready(function(){
 $('#userTable').DataTable();
 $('[data-toggle="tooltip"]').tooltip();
 $('[data-toggle="popover"]').popover();

 // POPOVER FOR PASSWORD RULES IN ::MANAGE USER::
 $('.password_rules').popover({
    title: "Password should contain",
    html: true,
    trigger: "hover",
    content: "<ul style='font-size:13px;text-align:justify;margin-left:10px'><li>At least 1 Uppercase letter.</li> <li>At least 1 Lowercase letter.</li>  <li>Must contain numbers.</li>  <li>Length must be greater than 8 characters.</li>  <li>Password must have at least one special symbol.</li></ul>"
 });

$("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });

});
</script>
<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/layouts/footer.blade.php ENDPATH**/ ?>