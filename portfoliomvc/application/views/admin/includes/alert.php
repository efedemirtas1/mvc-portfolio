<?php 
$alert = $this->session->userdata("alert");
    if($alert){
?>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })     
    Toast.fire({
        icon: '<?=$alert["icon"]?>',
        title: '<?=$alert["title"]?>'
    }) 
</script>
<?php 
    }
?>
