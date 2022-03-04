
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
            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?=$alertFormClass?>" placeholder="İçerik Adı" name="title" value="<?=$item->title?>" id="title">
            <?=$alertFormMessage?>
            
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                    <a title="İçerik genel bilgileri" data-toggle="tab" data-target="#bilgi" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> İçerik Bilgileri </a>
                    <a title="İçerik detayı" data-toggle="tab" data-target="#icerik" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> İçerik </a>
                    <a title="Seo bilgileri" data-toggle="tab" data-target="#seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SEO </a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="bilgi">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="grid grid-cols-12">

                                <div class="intro-x col-span-12">
                                    <div class="mb-5">
                                        <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="copy" class="w-4 h-4 mr-2"></i>Kategoriler</div>
                                        <select  class="input input--lg w-full border" name="category"> 
                                            <option value="0">Seçiniz</option>
                                            <?php echo $htmlSelectCategory; ?>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>  
                        </div>                    
                    </div>
                    <div class="tab-content__pane p-5" id="icerik">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="more-horizontal" class="w-4 h-4 mr-2"></i> Kısa Açıklaması </div>
                                <textarea id="editor1" rows="5" name="shortDescription"><?=$item->short_description?></textarea>
                            </div>                            
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Açıklama</div>
                                <textarea id="editor2" rows="20" name="description"><?=$item->description?></textarea>
                            </div>

                        </div>                         
                    </div>
                    <div class="tab-content__pane p-5" id="seo">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Seo Link ( URL )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="" name="seoUrl" value="<?=$item->seo_url?>" id="seoUrl">
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Seo Açıklama ( Description )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="" name="seoDescription" value="<?=$item->seo_description?>">
                            </div>                       
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="hash" class="w-4 h-4 mr-2"></i> Seo Etiketler</div> 
                                <textarea col="3" class="input input--lg w-full border mb-2" name="seoKeyword"><?=$item->seo_keyword?></textarea>
                                <div class="text-xs text-gray-600">Anahtar kelimelerinizi "," virgül ile ayırarak ekleyebilirsiniz.</div>
                            </div>
                        </div>                    
                    </div>
                </div>                
            </div>
        </form>
           
        <div class="post w-full intro-y overflow-hidden box mt-5">        
            <div class="post__content">
                <div class="border border-gray-200 rounded-md p-5">
                    <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Resimler </div>
                    <div class="mt-5">
                        <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                            <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6">
                                <?php foreach($imageItem as $rows){ ?>
                                    <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                                        <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                            <div class="absolute left-0 top-0 mt-3 ml-3">
                                                <input data-url="<?=base_url("admin/dataImgActive/$rows->id/{$modelName}/is_active")?>" class="input border border-gray-500 dataActive" type="checkbox" <?=$rows->is_active ? "checked" : "";?> >
                                            </div>
                                            <a href="<?=base_url("upload/{$viewFolder}/{$rows->img_url}")?>" class="w-3/5 file__icon file__icon--image mx-auto">
                                                <div class="file__icon--image__preview image-fit">
                                                    <img alt="<?=$rows->img_url?>" src="<?=base_url("upload/{$viewFolder}/{$rows->img_url}")?>">
                                                </div>
                                            </a>
                                            <a href="" class="block font-medium mt-4 text-center truncate"><?=$rows->img_url?></a> 
                                            <div class="text-gray-600 text-xs text-center">1.2 MB</div>
                                            <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                                                <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                                                    <div class="dropdown-box__content box p-2">
                                                        <button class="imageDelete flex items-center block w-full p-2 justify-betwee transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md" data-url="<?=base_url("admin/imageDelete/$rows->id/{$viewFolder}/{$modelName}")?>"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Sil</button>
                                                        <div class="flex items-center block w-full p-2 transition justify-betwee duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <input data-url="<?=base_url("admin/dataImgActive/$rows->id/{$modelName}/cover_active")?>" class="input border border-gray-500 dataActive mr-2" type="checkbox" <?=$rows->cover_active ? "checked" : "";?> ><label> Kapak</label></div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>                              
                            <form action="<?=base_url("admin/imageUpload/$item->id/{$viewFolder}/{$modelName}");?>" data-plugin="dropzone" data-opions="{url<?=base_url("admin/imageUpload/$item->id/{$viewFolder}/{$modelName}");?>}" id="dropzone" data-file-types="image/jpeg|image/png|image/jpg"  class="dropzone border-gray-200 border-dashed">
                                <div class="fallback"> <input name="file" type="file" multiple /> </div>
                                <div class="dz-message" data-dz-message>
                                    <div class="text-lg font-medium">Yüklemek için Sürükleyin veya tıklayın.</div>
                                    <div class="text-gray-600"> Burası önizleme alanıdır. Listelenen fotoğraflar tam olarak yüklememiş olabilir. <span class="font-bold">Lütfen çıkmadan önce "KAYDET" butonuna basınız!</span></div>
                                </div>
                            </form>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
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