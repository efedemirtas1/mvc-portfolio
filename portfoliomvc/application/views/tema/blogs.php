
<?php if(isset($icerik)){ ?>

    <section id="breadcrumb" class="breadcrumb_section relative-position" data-background="<?=base_url("assets/tema/images/banner.jpg")?>">
        <div class="background_overlay"></div>
        <div class="container">
            <div class="breadcrumb_item ul-li">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>"><?=terms('baslik-anasayfa')?></a></li>
                    <li class="breadcrumb-item"><a href="<?=base_url($menu->seo_url)?>"><?=$menu->title?></a></li>
                    <li class="breadcrumb-item active"><?=$icerik->title?></li>
                </ul>
            </div>
        </div>
    </section>
    <section id="blog_details" class="blog_news_post_section blog_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog_details_content headline">
                        <div class="blog_details_text headline">
                            <h2><?=$icerik->title?></h2>
                            <div class="blog_details_imgfull">
                                <img src="<?php echo dataBlokImg($icerik->id, "news", "news_model")?>" class="img-fluid" alt="<?=$icerik->title?>">
                            </div>
                            <?=$icerik->description?>
                        </div>
                        <div class="blog_details_extra_text">
                            <div class="related_postview">
                                <h3>Diğer Yazılar</h3>
                                <div class="row">
                                    <?php foreach($digericerikler as $rows){ ?>
                                    <div class="col-md-6">
                                        <div class="related_postitem">
                                            <div class="postitem_img">
                                                <img src="<?php echo dataBlokImg($icerik->id, "news", "news_model")?>" class="img-fluid" alt="<?=$rows->title?>">
                                            </div>
                                            <div class="postitem_text">
                                                <h3> <a href="<?=base_url("akademi-icerik/{$rows->seo_url}")?>" title="<?=$rows->title?>"> <?=$rows->title?> </a> </h3>
                                                <p><?=character_limiter(strip_tags($rows->short_description), 50)?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="site_sidebar">
                        <div class="single_widget headline">
                            <h3 class="widget_title">
                                <span class="title_shape_left"></span>
                                Sosyal Medya
                            </h3>
                            <div class="social_widget ul-li relative-position">
                                <ul>
                                <?php
                                    foreach($sosyalMedyalar as $rows){
                                        echo '
                                            <li>
                                                <a href="'.$rows->link.'" target="_blank">
                                                    <i class="fab fa-'.$rows->icon.'"></i>
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
            </div>
        </div>
    </section>

<?php }elseif(isset($icerikler)){ ?>

    <section id="breadcrumb" class="breadcrumb_section relative-position" data-background="<?=base_url("assets/tema/images/banner.jpg")?>">
        <div class="background_overlay"></div>
        <div class="container">
            <div class="breadcrumb_item ul-li">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>"><?=terms('baslik-anasayfa')?></a></li>
                    <li class="breadcrumb-item active"><?=$menu->title?></li>
                </ul>
            </div>
        </div>
    </section>
    <section id="blog_area" class="blog_section blog_section_two">
        <div class="container">            
            <div class="blog_content">
                <div class="row">

                <?php foreach($icerikler as $rows){ ?>

                    <div class="col-lg-4 col-md-6 mt-5" id="ediBac">
                        <div class="blog_img_text">
                            <div class="blog_text headline">
                                <h5 class="mb-3"><?=$rows->title?></h5>
                                <span><?=strip_tags($rows->short_description)?></span>
                                <br><a><?=strip_tags($rows->description)?></a>
                                <br><img src="<?php echo dataBlokImg($rows->id, "blogs", "blogs_model")?>">
                            </div>
                        </div>
                    </div>

                <?php } ?>

                </div>
            </div>
        </div>
    </section>
    
<?php } ?>