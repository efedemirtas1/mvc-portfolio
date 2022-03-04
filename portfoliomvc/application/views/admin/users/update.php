<?php $userData = get_login_user(); ?>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
    <div class="intro-y col-span-12 lg:col-span-8">
        <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <div class="intro-y box">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Genel Bilgiler
                    </h2>

                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="<?php echo base_url("admin/{$viewFolder}");?>" class="button px-2 mr-1 bg-theme-6 text-white"> <i data-feather="x"></i> </a>
                    </div>
                </div>
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url("assets/admin/images/$item->img_url");?>">
                            </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg"><?=$item->full_name?></div>
                                <div class="text-gray-600">
                                <?php 
                                    if($item->authority == "0"){
                                        echo "Admin";
                                    }elseif($item->authority == "1"){
                                        echo "İçerik Yazarı";                                
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 px-5 border-l border-r border-gray-200 border-t lg:border-t-0 pt-5 lg:pt-0">
                            <div class="truncate sm:whitespace-normal flex items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> <?=$item->email?> </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="instagram" class="w-4 h-4 mr-2"></i> - </div>
                            <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-feather="twitter" class="w-4 h-4 mr-2"></i> -</div>
                        </div>
                    </div>
                    <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
                        <a data-toggle="tab" data-target="#profil" href="javascript:;" class="py-4 sm:mr-8 flex items-center active"> <i class="w-4 h-4 mr-2" data-feather="user"></i> Profile Güncelle </a>
                        <a data-toggle="tab" data-target="#sifre" href="javascript:;" class="py-4 sm:mr-8 flex items-center"> <i class="w-4 h-4 mr-2" data-feather="lock"></i> Şifre Güncelle </a>
                        <?php if($userData->authority == 0){ ?>
                        <a data-toggle="tab" data-target="#yetkiler" href="javascript:;" class="py-4 sm:mr-8 flex items-center"> <i class="w-4 h-4 mr-2" data-feather="shield"></i> Yetkiler </a>
                        <?php } ?>
                    </div>

                    <div class="post__content tab-content">
                        <div class="tab-content__pane p-5 active" id="profil">   
                            <form action="<?php echo base_url("admin/{$viewFolder}/profilUpdate/$item->id");?>" method="post">
                                <div class="col-span-12">
                                    
                                    <?php
                                        if(isset($form_error)){
                                            $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("full_name").'</div>';
                                            $alertSetValue = set_value("full_name");
                                        }else{
                                            $alertFormMessage = '';
                                            $alertSetValue = $item->full_name;  
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
                                            $alertSetValue = $item->user_name;   
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
                                            $alertSetValue = $item->email;   
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
                                    <button  class="button w-20 bg-theme-1 text-white mt-3">Kaydet</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-content__pane p-5" id="sifre">
                            <form action="<?php echo base_url("admin/{$viewFolder}/passUpdate/$item->id");?>" method="post">
                                <div class="col-span-12">
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
                            </form>
                        </div>
                        <?php if($userData->authority == 0){ ?>
                        <div class="tab-content__pane p-5" id="yetkiler">
                            <form action="<?php echo base_url("admin/{$viewFolder}/yetkiUpdate/$item->id");?>" method="post">   
                                <div class="border border-gray-200 rounded-md p-5 overflow-x-auto">
                                    <div class="intro-y flex flex-col sm:flex-row items-center mb-3">
                                        <h2 class="text-lg font-medium mr-auto">
                                            Yetki Ayarları
                                        </h2>
                                        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                                            <button  class="button w-20 bg-theme-1 text-white">Kaydet</button>
                                        </div>
                                    </div>
                                    <table class="table table-border">
                                        <thead>
                                            <tr class="bg-gray-700 text-white">
                                                <td class="whitespace-no-wrap">Modül Adı</td>
                                                <td class="whitespace-no-wrap w-20">Görüntüleme</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-gray-700 text-white">
                                                <td class="whitespace-no-wrap text-right" colspan="2">
                                                    <div> 
                                                        <input type="checkbox" class="input border mr-2" id="checkallread"> 
                                                        <label class="cursor-pointer select-none" for="vertical-checkbox-chris-evans">Tümünü Seç</label> 
                                                    </div>
                                                </td>
                                            </tr>                                        
                                            <?php echo $htmlPowerMenu;?>
                                        </tbody>
                                    </table>                                
                                    <div class="intro-y flex flex-col sm:flex-row items-center mt-3">
                                        <h2 class="text-lg font-medium mr-auto">
                                            Yetki Ayarları
                                        </h2>
                                        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                                            <button  class="button w-20 bg-theme-1 text-white">Kaydet</button>
                                        </div>
                                    </div>
                                </div>  
                            </form>                            
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="post w-full intro-y overflow-hidden box mt-5">        
            <div class="post__content">
                <div class="border border-gray-200 rounded-md p-5">
                    <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Profil Fotoğrafı </div>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Profil fotoğrafı yükleme çok yakında hizmete sunulacak. </div>            
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-4">
        <div class="intro-y box mb-5 p-5">
            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-3"> <i data-feather="cpu" class="w-4 h-4 mr-2"></i> İşlemler </div>
            <div class="mb-3">
                <label>Eklenme Tarihi</label>
                <input data-timepicker="true" class="datepicker input w-full border mt-2" value="<?=date('m.d H:i', strtotime($item->creat_date))?>">
            </div>
            <div class="mb-3">
                <label>Son Güncelleme Tarihi</label>
                <input data-timepicker="true" class="datepicker input w-full border mt-2" value="<?=date('m.d H:i', strtotime($item->update_date))?>">
            </div>
            <a href="<?=base_url("admin")?>" class="w-full block text-center rounded-md py-3 border border-dotted border-theme-15 text-theme-16" title="Tüm işlemleri gör">Tüm İşlemleri Gör</a>
        </div>
    </div>
</div>