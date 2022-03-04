<div class="up">
    <a href="#" class="scrollup text-center"><i class="fa fa-chevron-up"></i></a>
</div>
<header id="header_id" class="main_header header_style_theree">
    <div class="header_main_menu">
        <div class="site_logo text-center float-left">
            <a href="<?=base_url();?>"><img src="<?=base_url("upload/settings/$ayarlar->logo");?>" alt="<?=$ayarlar->title?> logo" class="img-fluid"></a>
        </div> 
        <nav class="main_navigation ul-li">
            <ul>
                <?php echo $htmlHeaderMenu; ?>
            </ul>
        </nav>
        <div class="wide_side_bar open_side_area float-right">
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <div class="wide_side_inner">
            <div class="side_overlay open_side_area"></div>
            <div class="side_inner_content text-center">
                <div class="close_btn open_side_area">Kapat <i class="fa fa-close"></i></div>
                <div class="side_inner_logo">
                    <a href="<?=base_url();?>"><img src="<?=base_url("upload/settings/$ayarlar->logo");?>" alt="<?=$ayarlar->title?> logo" class="img-fluid"></a>
                </div>
                <p>
                <?=terms('footer-kurumsaltxt')?>
                </p>
                <div class="side_contact">
                    <div class="social_widget ul-li headline relative-position">
                        <h3> Sosyal Medya:</h3>
                        <ul>
                            <?php
                                foreach($sosyalMedyalar as $rows){
                                    echo '
                                        <li class="h-fb">
                                            <a href="'.$rows->link.'" target="_blank">
                                                <i class="fa fa-'.$rows->icon.'"></i>
                                            </a>
                                        </li>
                                    ';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
            
        <div class="float-right">
            <ul class="hedscoail">
                <?php
                    foreach($sosyalMedyalar as $rows){
                        echo '
                            <li class="h-fb">
                                <a href="'.$rows->link.'" target="_blank">
                                    <i class="fa fa-'.$rows->icon.'"></i>
                                </a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </div>
    
    <div class="mobile_menu">
        <div class="mobile_menu_button open_mobile_menu">
            <i class="fa fa-bars"></i>
        </div>
        <div class="mobile_menu_wrap">
            <div class="mobile_menu_overlay open_mobile_menu"></div>
            <div class="mobile_menu_content">
                <div class="mobile_menu_close open_mobile_menu">
                    <i class="fa fa-close"></i>
                </div>
                <div class="m-brand-logo text-center">
                    <img src="<?=base_url("upload/settings/$ayarlar->logo");?>" alt="<?=$ayarlar->title?> logo">
                </div>
                <nav class="main-navigation  clearfix ul-li">
                    <ul id="main-nav" class="navbar-nav text-capitalize clearfix">
                        <?php echo $htmlHeaderMenu; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
</header>