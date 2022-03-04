
<script src="<?=base_url("assets/tema/js/jquery.min.js")?>"></script>
<script src="<?=base_url("assets/admin")?>/js/sweetalert2.all.min.js"></script>
<script src="<?=base_url("assets/admin")?>/js/owl.carousel.min.js"></script>

<script src="<?=base_url("assets/tema/js/bootstrap.min.js")?>"></script>
<script src="<?=base_url("assets/tema/js/owl.carousel.min.js")?>"></script>
<script src="<?=base_url("assets/tema/js/jarallax.js")?>"></script>
<script src="<?=base_url("assets/tema/js/wow.min.js")?>"></script>
<script src="<?=base_url("assets/tema/js/parallax-scroll.js")?>"></script>
<script src="<?=base_url("assets/tema/js/jquery.magnific-popup.min.js")?>"></script>
<script src="<?=base_url("assets/tema/js/jquery-modal-video.min.js")?>"></script>
<script src="<?=base_url("assets/tema/js/script.js")?>"></script>

<script>
    $(".js-video-button").modalVideo({
        youtube: {
            controls: 0,
            nocookie: true
        }
    });
</script>

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
<?php } ?>

<?php if(!empty($popupData)){ ?>

    <script type="text/javascript">
        $(window).on('load', function() {

            var param = sessionStorage.pop;
            if (param) {
                $("#popupModal").css("display", "none");
                $("#popupModal").removeClass("show");
            }else{
                $('#popupModal').modal('show');
            }
            
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="popupModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" title="Bir daha gösterme" onclick="popupbtn();" ></button>
                </div>
                <div class="modal-body">
                    <a href="<?=base_url($popupData->link1)?>" title="<?=$popupData->title?>" target="_blank">
                     <img src="<?=dataBlokImg($popupData->id, "slides", "slides_model")?>" alt="<?=$popupData->title?>" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php } ?>