<section id="breadcrumb" class="breadcrumb_section relative-position"
  data-background="<?=base_url("assets/tema/images/banner.jpg")?>">
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

<section id="contact_page" class="contact_page_section" style="padding-top:75px;">

  <div class="container">
    <div class="contactpage_details mt-5 mb-5" style="top:0">
      <div class="row">

        <?php 
          $say = 1;
          foreach($iletisim as $rows){ 
        ?>
          <div class="col-lg-4 col-md-6">
            <div class="contact_d_icontext text-center">
              <div class="con_icon relative-position">
                <i class="fa fa-<?=$rows->icon?>"></i>
              </div>
              <div class="con_text headline">
                <h4><?=$rows->title?></h4>
                <?=$rows->description?>
                <div class="con_bg">
                  <i class="fa fa-<?=$rows->icon?>"></i>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</section>
<section id="estimate" class="estimate_contact_section">
	<div class="container">
		<div class="section_title_area text-center headline pera-content">			
			<h2> 
				Bana Yazın
			</h2>
		</div>
		<div class="estimate_form">
			<form  action="<?php echo base_url("forms/iletisim")?>" method="post"  enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="contact-info">
							<input name="adsoyad" type="text" placeholder="<?=terms('form-ad-soyad')?>">
							<div class="icon-bg">
								<i class="fa fa-user"></i>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="contact-info">
							<input name="eposta" type="email" placeholder="<?=terms('form-eposta')?>">
							<div class="icon-bg">
								<i class="fa fa-envelope"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="contact-info">
							<input name="tel" type="text" placeholder="<?=terms('form-tel')?>">
							<div class="icon-bg">
								<i class="fa fa-phone"></i>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="contact-info">
							<input name="konu" type="text" placeholder="<?=terms('form-konu')?>">
							<div class="icon-bg">
								<i class="fa fa-circle"></i>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="contact-info">
							<textarea name="mesaj" placeholder="<?=terms('form-mesaj')?>"></textarea>
							<div class="icon-bg">
								<i class="fa fa-edit"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="sub-button  text-uppercase">
					<button type="submit" value="Submit"><?=terms('btn-gonder')?></button> 
				</div> 
			</form>
		</div>
	</div>
</section>
