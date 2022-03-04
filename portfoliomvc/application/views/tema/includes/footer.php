<div class="footer_copyright copyright_3">
    <div class="container">
        <div class="footer_copyright_content">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="footer_social ul-li clearfix">
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
                <div class="col-lg-4 col-md-12">
                    <div class="footer_logo text-center">
                        <a href="<?=base_url();?>"><img src="<?php echo base_url("upload/settings/$ayarlar->logo2")?>" alt="<?=$ayarlar->title?> logo"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>