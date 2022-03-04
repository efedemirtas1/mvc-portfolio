
<div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
    <!-- Post Content -->
    <div class="intro-y col-span-12 lg:col-span-8">
        <form action="<?php echo base_url("admin/{$viewFolder}/update/$item->id");?>" method="post">
            <div class="intro-y flex flex-col sm:flex-row items-center">
                <h2 class="text-lg font-medium mr-auto">
                    İçerik Düzenleme
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button class="button text-white w-24 bg-theme-1 px-2 mr-1 shadow-md"> Güncelle </button>      
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
            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?=$alertFormClass?>" placeholder="Ürün Adı" name="title" value="<?=$item->title?>">
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
                                        $item->category == url_convert($sabitler[$say]) ? $selected = "selected" : $selected = "";
                                        echo '<option '.$selected.' value="'.url_convert($sabitler[$say]).'">'.$sabitler[$say].'</option>';
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
                                        $item->icon == $rows->icon ? $selected = "selected" : $selected = "";
                                        echo '<option '.$selected.' value="'.$rows->icon.'">'.$rows->title.'</option>';
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
                            <input type="text" class="input input--lg w-full border" placeholder="" name="link" value="<?=$item->link?>">
                        </div>
                        <div class="intro-x col-span-12 mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-2 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Açıklama</div>
                            <textarea id="editor2" rows="10" name="description"><?=$item->description?></textarea>
                        </div>

                    </div>               
                </div>
            </div>
        </form>
    </div>
    <!-- Post Content -->
    <!-- Post Info -->
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
    <!-- Post Info -->
 
</div>