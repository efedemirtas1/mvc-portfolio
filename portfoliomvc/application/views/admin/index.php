<!DOCTYPE html>
<html lang="tr">
    <?php $this->load->view("admin/includes/head");  ?>
 
    <?php 
        if($nameModel == "login") {
            $this->load->view("admin/login");         
        }else {
    ?>    
    
        <body class="app">
            <!-- Mobile Menu -->
            <?php $this->load->view("admin/includes/mobile_sidebar");  ?>
            <!-- Mobile Menu -->
            <div class="flex">
                <?php $this->load->view("admin/includes/sidebar");  ?>
                <!-- Content -->
                <div class="content">
                    <div class="top-bar">
                        <!-- Breadcrumb -->
                        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> 
                            <a href="<?=base_url("admin")?>" class="">Yönetim Paneli</a> 
                            <?php
                                $subList = $this->uri->segment(3);

                                if($subList == "subList"){
                                    echo '<i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="'.base_url("admin/{$viewFolder}").'" class="">'.$nameModel.'</a>';
                                    echo '<i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="javascript:;" class="breadcrumb--active">Alt '.$nameModel.'</a>';
                                }else{
                                    echo '<i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="javascript:;" class="breadcrumb--active">'.$nameModel.'</a>';
                                }
                            ?>
                        </div>
                        <!-- Breadcrumb -->
                        <?php $this->load->view("admin/includes/top_bar");  ?>
                    </div>
                    <?php $this->load->view("admin/{$viewFolder}/{$viewDocument}");  ?>
                </div>
                <!-- Content -->
            </div>
            <?php $this->load->view("admin/includes/footer_links");  ?>
        </body>

    <?php } ?>
</html>