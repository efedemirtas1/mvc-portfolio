<section id="breadcrumb" class="breadcrumb_section relative-position pageonesl" data-background="<?=base_url("assets/tema/images/banner.jpg")?>">
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
<section  class="service_style_two about_section_three relative-position" id="aboutshort">
    <div class="container">
        <div class="container">
            <div class="about_content_three">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about_img relative-position">
                            <div class="about_img1">
                                <img src="<?=dataCoverImg($icerik->id, "pages", "pages_model")?>" alt="Prof. Dr. Cevdet ERDÖL">
                            </div>                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about_area_content">    
                            <div class="section_title_area headline pera-content">
                                <p>
                                    <span class="title_shape_left"></span>
                                    <?=$icerik->title?>
                                </p>
                                <span class="mishdec"><?=$icerik->short_description?></span>
                            </div>
                            <div class="about_area_text">
                                <?=$icerik->description?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>