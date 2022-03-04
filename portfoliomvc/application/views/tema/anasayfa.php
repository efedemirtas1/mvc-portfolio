<section id="slider_area" class="slider_section  slider_2 relative-position">
	<div id="slider_id" class="slider_style_two owl-carousel relative-position">
        <?php 
            foreach($sliderData as $rows){
                    
                echo '<div class="slider_priview" data-background="'.dataCoverImg($rows->id, "slides", "slides_model").'">';
                    echo '<div class="container">';
                        echo '<div class="slider_contect_box">';
                            echo '<div class="slider_text headline pera-content" style="color:white;padding-left: 0.7rem;";>';
                                echo "<h1>".$rows->title."</h1>";
                                echo $rows->description;
                            echo '</div>';
				
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
</section>
<section class="service_style_two about_section_three relative-position">
	<div class="container">
		<div class="container">
			<div class="about_content_three">
				<div class="row">
					<div class="col-lg-6">
						<div class="about_img relative-position">
							<div class="about_img1">
								<img src="<?=dataCoverImg($hakkimizda->id, "pages", "pages_model")?>">
							</div>

						</div>
					</div>
					<div class="col-lg-6">
						<div class="about_area_content">
							<div class="section_title_area headline pera-content">
								<p><span class="title_shape_left"></span><?=$hakkimizda->title?></p>
							</div>
							<div class="about_area_text">
                                <?=$hakkimizda->short_description?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<section id="rex_video" class="rex_video_section relative-position">
	<div class="container">
		<div class="video_img_area relative-position">
			<div class="video_img">
				<img src="<?=base_url("assets/tema/images/banner.jpg")?>" alt="Videolar">
			</div>

			<div class="video_play_area text-center">
				<span>Videolar</span>
				<div class="video_play_btn relative-position text-center">
					<a class="block-display js-video-button" href="javascript:void(0)" data-video-id="#">
						<i class="fa fa-play"></i>
						<span class="video_btn_border border_wrap-1"></span>
						<span class="video_btn_border border_wrap-2"></span>
						<span class="video_btn_border border_wrap-3"></span>
					</a>
				</div>
				<div class="video_text headline pera-content">
					<h4><?=terms('baslik-video')?></h4>
					<p><?=terms('text-video')?></p>
				</div>
			</div>
			<div class="shape_pattern_3" data-parallax='{"x" : -30}'><img src="<?=base_url("assets/tema/images/pt1-1.png")?>" alt="<?=terms('baslik-video')?>"></div>
		</div>
	</div>
	<div class="line_animation">
		<div class="line_area"></div>
		<div class="line_area"></div>
		<div class="line_area"></div>
		<div class="line_area"></div>
		<div class="line_area"></div>
	</div>
</section>
