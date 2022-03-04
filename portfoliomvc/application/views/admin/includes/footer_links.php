<script src="<?=base_url()?>/assets/admin/js/app.js"></script>
<script src="<?=base_url()?>/assets/admin/js/jquery.js"></script>
<script src="<?=base_url()?>/assets/admin/js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>/assets/admin/js/sweetalert2.all.min.js"></script>
<script src="<?=base_url()?>/assets/admin/ckeditor/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script>
<script src="<?=base_url()?>/assets/admin/js/default.js"></script>
<?php $this->load->view("admin/includes/alert"); ?>