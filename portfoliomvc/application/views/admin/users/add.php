<?php $userData = get_login_user(); ?>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
    <!-- Post Content -->
    <div class="intro-y col-span-12 lg:col-span-8">
        <form action="<?php echo base_url("admin/{$viewFolder}/save");?>" method="post">
            <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                <!-- Display Information -->
                <div class="intro-y box">
                    <div class="flex items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Genel Bilgiler
                        </h2>

                        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                            <a href="<?php echo base_url("admin/{$viewFolder}");?>" class="button px-2 mr-1 bg-theme-6 text-white"> <i data-feather="x"></i> </a>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 xl:col-span-3">
                                <div class="border border-gray-200 rounded-md p-5">
                                    <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        <img class="rounded-md" alt="Kullanıcuı standart" src="<?php echo base_url("assets/admin/images/default-user".rand(1,6).".png");?>">
                                        <input type="hidden" value="<?php echo "default-user".rand(1,6).".png" ?> " name="img_url">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-9">
                                
                                <?php
                                    if(isset($form_error)){
                                        $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("full_name").'</div>';
                                        $alertSetValue = set_value("full_name");
                                    }else{
                                        $alertFormMessage = '';
                                        $alertSetValue = '';  
                                    }
                                ?>
                                <div class="mb-5">
                                    <label>Ad Soyad</label>
                                    <input type="text" class="input w-full border mt-2" placeholder="Ahmet Bakan" name="full_name" value="<?=$alertSetValue?>">
                                    <?=$alertFormMessage?>
                                </div>
                                
                                <?php
                                    if(isset($form_error)){
                                        $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("user_name").'</div>';
                                        $alertSetValue = set_value("user_name");
                                    }else{
                                        $alertFormMessage = ''; 
                                        $alertSetValue = '';   
                                    }
                                ?>
                                <div class="mb-5">
                                    <label>Kulanıcı Adınız</label>
                                    <input type="text" class="input w-full border mt-2" placeholder="ahmetbakan1" name="user_name" value="<?=$alertSetValue?>">
                                    <?=$alertFormMessage?>
                                </div>
                                
                                <?php
                                    if(isset($form_error)){
                                        $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("email").'</div>';
                                        $alertSetValue = set_value("email");
                                    }else{
                                        $alertFormMessage = ''; 
                                        $alertSetValue = '';   
                                    }
                                ?>
                                <div class="mb-5">
                                    <label>Eposta</label>
                                    <input type="email" class="input w-full border mt-2" placeholder="ahmet@domain.com" name="email" value="<?=$alertSetValue?>">
                                    <?=$alertFormMessage?>
                                </div>
                                <div class="mb-5">
                                    <label>Görevi</label>
                                    <div class="mt-2">
                                        <select class="input border w-full" name="authority">
                                            <option value="1">İçerik Editörü</option>
                                            <?php if($userData->authority == 0){ echo '<option value="0">Admin</option>'; }?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    if(isset($form_error)){
                                        $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("password").'</div>';
                                    }else{
                                        $alertFormMessage = '';  
                                    }
                                ?>
                                <div class="mb-5">
                                    <label>Şifre</label>
                                    <input type="password" class="input w-full border mt-2" placeholder="*******" name="password">
                                    <?=$alertFormMessage?>
                                </div>
                                
                                <div class="mb-5">
                                    <label>Şifreden emin ol!</label>
                                    <input type="password" class="input w-full border mt-2 " placeholder="*******" name="password_control">
                                    <?=$alertFormMessage?>
                                </div>                     
                                <button  class="button w-20 bg-theme-1 text-white mt-3">Kaydet</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </form>
        <div class="post w-full intro-y overflow-hidden box mt-5">        
            <div class="post__content">
                <div class="border border-gray-200 rounded-md p-5">
                    <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Profil Fotoğrafı </div>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Kayıt oluşturulduktan sonra resimler eklenebilir. </div>            
                </div>
            </div>
        </div>
    </div>
    <!-- Post Content -->
    <!-- Post Info -->
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y box p-5 mb-5">
            <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="cpu" class="w-4 h-4 mr-2"></i> İşlemler </div>       
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Kayıt ile ilgili yapılacak işlemler burada listelenecektir. </div>             
        </div>
    </div>
    <!-- Post Info -->
</div>