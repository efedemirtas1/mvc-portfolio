
    <?php $userData = get_login_user(); ?>

    <!-- Site Buton -->    
    <div class="intro-x dropdown relative mr-2">
        <a href="<?=base_url()?>" type="button" class="button box text-gray-700 mr-2 flex items-center ml-auto sm:ml-0" target="_blank"> <i class="w-4 h-4 mr-2" data-feather="eye"></i> Siteyi Görüntüle </a> 
    </div>
    <!-- Site Buton -->

    <!-- Language -->    
    <div class="intro-x dropdown relative mr-2">
        <a class="dropdown-toggle button box text-gray-700 flex items-center"> Tükçe </a>
    </div>
    <!-- Language -->

    <!-- Notifications -->
    <div class="intro-x dropdown relative mr-auto sm:mr-6">
        <div class="dropdown-toggle notification <?php echo (!empty($notifications)) ? "notification--bullet" : "" ;?> cursor-pointer"> <i data-feather="bell" class="notification__icon"></i> </div>
        <div class="notification-content dropdown-box mt-8 absolute top-0 right-0 sm:left-auto sm:right-0 z-20 -ml-10 sm:ml-0">
            <div class="notification-content__box dropdown-box__content box">
                <div class="notification-content__title">Bildirimler</div>
                <?php 
                    if($notifications){
                    foreach($notifications as $rows){ ?>
                    <div class="cursor-pointer relative flex items-center ">
                        <div class="w-12 h-12 flex-none image-fit mr-1">
                            <img alt="<?=$rows->ad_soyad?>" class="rounded-full" src="<?php echo base_url("assets/admin/images/default-user".rand(1,6).".png");?>">
                            <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                        </div>
                        <div class="ml-2 overflow-hidden">
                            <div class="flex items-center">
                                <a href="javascript:;" class="font-medium truncate mr-5"><?=$rows->ad_soyad?></a> 
                                <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap"><?=date('m.d H:i', strtotime($rows->creat_date))?></div>
                            </div>
                            <div class="w-full truncate text-gray-600"><?=$rows->konu?></div>
                        </div>
                    </div>

                <?php 
                    } 
                }else{ echo '<div class="w-full truncate text-gray-600">Bildirim yok.</div>'; }
                ?>
                
            </div>
        </div>
    </div>
    <!-- Notifications -->
    <!-- Account Menu -->
    <div class="intro-x dropdown w-8 h-8 relative">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img src="<?=base_url("assets/admin/images/$userData->img_url")?>" alt="<?=$userData->full_name?>">
        </div>
        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
            <div class="dropdown-box__content box bg-theme-38 text-white">
                <div class="p-4 border-b border-theme-40">
                    <div class="font-medium"><?=$userData->full_name?></div>
                    <div class="text-xs text-theme-41">
                    <?php 
                        if($userData->authority == 0){
                            echo "Admin";
                        }elseif($userData->authority == 1){
                            echo "İçerik Yazarı";                                
                        }elseif($userData->authority == 2){
                            echo "Ürün Yöneticisi";                                
                        }
                    ?>
                    </div>
                </div>
                <div class="p-2">
                    <a href="<?=base_url("admin/users/edit/$userData->id")?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profil </a>
                    <a href="<?=base_url("admin/users/add/")?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Kullanıcı Ekle </a>
                    <a href="<?=base_url("admin/users/edit/$userData->id")?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Şifre Değiştir </a>
                </div>
                <div class="p-2 border-t border-theme-40">
                    <a href="<?=base_url("admin/logout/")?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="log-out" class="w-4 h-4 mr-2"></i> Çıkış Yap </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Account Menu -->