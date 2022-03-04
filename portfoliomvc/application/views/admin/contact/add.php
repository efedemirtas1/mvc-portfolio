<form action="<?php echo base_url("admin/{$viewFolder}/save");?>" method="post">
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
        <!-- Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="intro-y flex flex-col sm:flex-row items-center">
                <h2 class="text-lg font-medium mr-auto">
                    Yeni İçerik Ekleme
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button class="button text-white w-24 bg-theme-1 px-2 mr-1 shadow-md"> Kaydet </button>    
                    <a href="<?php echo base_url("admin/{$viewFolder}");?>" class="button px-2 mr-1 bg-theme-6 text-white"> <i data-feather="x"></i> </a>
                </div>
            </div>
            <?php
                if(isset($form_error)){
                    $alertFormClass = 'border-theme-6';
                    $alertFormMessage = '<div class="text-theme-6 mb-2">'.form_error("title").'</div>';
                }else{
                    $alertFormClass = '';
                    $alertFormMessage = '';  
                }
            ?>
            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?=$alertFormClass?>" placeholder="İçerik Adı" name="title">
            <?=$alertFormMessage?>

            <div class="post intro-y overflow-hidden box mt-5">
                <div class="border border-gray-200 rounded-md p-5">
    
                    <div class="grid grid-cols-12">
                        <div class="intro-x col-span-12 mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-2 mb-2"> <i data-feather="copy" class="w-4 h-4 mr-2"></i>İletişim Türü</div>
                            <select  class="input input--lg w-full border" name="category">
                                <?php 
                                    $sabitler = array("Sosyal Medya", "Bilgi", "Telefon", "Harita", "Tab1", "Tab2");
                                    for($say=0; $say < count($sabitler); $say++){
                                        echo '<option value="'.url_convert($sabitler[$say]).'">'.$sabitler[$say].'</option>';
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="intro-x col-span-12 mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-2 mb-2"> <i data-feather="slack" class="w-4 h-4 mr-2"></i>İkon Seç</div>
                            <select class="select2 w-full border" name="icon">
                                <option value="">Seçiniz</option>
                                <?php
                                    foreach($dataIcon as $rows){
                                        echo '<option value="'.$rows->icon.'">'.$rows->title.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="intro-x col-span-12 mb-5">
                            <div class="accordion">
                                <div class="accordion__pane border-b border-gray-200 pb-4"> 
                                    <a href="javascript:;" class="accordion__pane__toggle font-medium block button border bg-theme-14 text-theme-10 flex items-center justify-center "><i data-feather="archive" class="w-4 h-4 mr-2"></i> İkon Kütüphanesi</a>
                                    <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">
                                        <div class="intro-y grid grid-cols-12 sm:gap-6 row-gap-6 box px-5 py-8 mt-5">
                                            <?php  foreach($dataIcon as $rows){ ?>
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 text-center">
                                                <i class="fa fa-2x fa-<?=$rows->icon?>"></i>
                                                <div class="text-xs mt-2"><?=$rows->title?></div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="intro-x col-span-12 mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-2 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Link ( Bağlantı )</div>
                            <input type="text" class="input input--lg w-full border" placeholder="" name="link" value="">
                        </div>
                        <div class="intro-x col-span-12 mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-2 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Açıklama</div>
                            <textarea id="editor2" rows="10" name="description"></textarea>
                        </div>
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
</form>