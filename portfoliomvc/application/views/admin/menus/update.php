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
            <input type="text" class="input input--lg w-full border mt-2 mb-3 <?=$alertFormClass?>" placeholder="İçerik Adı" name="title" value="<?=$item->title?>" id="title">
            <?=$alertFormMessage?>            
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                    <a title="İçerik genel bilgileri" data-toggle="tab" data-target="#bilgi" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> İçerik Bilgileri </a>
                    <a title="Özellikler" data-toggle="tab" data-target="#ozellikler" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Özellikler </a>
                    <a title="Seo bilgileri" data-toggle="tab" data-target="#seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SEO </a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="bilgi">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="grid grid-cols-12">
                                <div class="intro-x col-span-12 mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="git-merge" class="w-4 h-4 mr-2"></i>Üst Menü</div>
                                    <select  class="select2 w-full" name="ustId">
                                        <option value="index">index</option>
                                        <?php echo $htmlSelectCategory; ?>
                                    </select>
                                </div>
                                <div class="intro-x col-span-12 mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="layout" class="w-4 h-4 mr-2"></i>Modül Seç</div>
                                    <select  class="select2 w-full" name="modulUrl">
                                        <option value="0">Seçiniz</option>
                                        <option value="index">Anasayfa</option>
                                        <?php                                        
                                            foreach($moduls as $rows){
                                                $item->modul_url == $rows->seo_url ? $selected = "selected" : $selected = "";
                                                echo '<option '.$selected.' value="'.$rows->seo_url.'">'.$rows->title.'</option>';
                                            }
                                        ?>
                                        <option value="static">Dış Link</option>                           
                                    </select> 
                                </div>  
                            </div>  
                        </div>                    
                    </div>
                    <div class="tab-content__pane p-5" id="ozellikler">
                        <div class="border border-gray-200 rounded-md p-5">
                            <table class="table table-border">
                                <tr>
                                    <td class="border-b">Üst Menü</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/header_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->header_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b">Alt Menü</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/footer_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->footer_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b">Sol Menü</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/left_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->left_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b">Özel Menü</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/special_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->special_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b">Yeni Sekmede aç</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/target_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->target_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b">Durumu</td>
                                    <td class="border-b">
                                        <div class="flex justify-end"> 
                                            <input data-url="<?=base_url("admin/dataActive/$item->id/{$modelName}/is_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$item->is_active ? "checked" : "";?> > 
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>                    
                    </div>
                    <div class="tab-content__pane p-5" id="seo">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Seo Link ( URL )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="" name="seoUrl" value="<?=$item->seo_url?>" id="seoUrl">
                            </div>        
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i>Harici Link ( Opsiyonel )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="https://www.google.com" name="externalUrl" value="<?=$item->external_url?>">
                            </div>            
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