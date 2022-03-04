<?php  if($item) { ?>

<div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
    <!-- Post Content -->
    <div class="intro-y col-span-12 lg:col-span-8">
        <form action="<?php echo base_url("admin/{$viewFolder}/update/$item->id");?>" method="post">
            <div class="intro-y flex flex-col sm:flex-row items-center">
                <h2 class="text-lg font-medium mr-auto">
                    İçerik Düzenleme
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button class="button text-white w-24 bg-theme-1 px-2 mr-1 shadow-md"> Kaydet </button>
                </div>
            </div>
            <input type="text" class="input input--lg w-full border mt-2" placeholder="Site Adı" name="title" value="<?=$item->title?>">
            
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                    <a title="Genel bilgiler" data-toggle="tab" data-target="#bilgi" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Genel Bilgiler </a>
                    <a title="Seo bilgileri" data-toggle="tab" data-target="#seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SEO </a>
                    <a title="SMTP Mail bilgileri" data-toggle="tab" data-target="#smtp" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> SMTP Mail Bilgileri </a>
                    <a title="SMTP Mail bilgileri" data-toggle="tab" data-target="#script" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Script Kodları</a>
                </div>
                <div class="post__content tab-content">
                    <div class="tab-content__pane p-5 active" id="bilgi">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="intro-x mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="aperture" class="w-4 h-4 mr-2"></i> Tema</div>
                                <select class="input input--lg w-full border" name="tema" id="tema">
                                    <?php 
                                        if($item->tema == "light") {
                                            echo '<option value="light" selected>Açık</option>';
                                            echo '<option value="dark">Koyu</option>';
                                        }else{
                                            echo '<option value="light">Açık</option>';
                                            echo '<option value="dark" selected>Koyu</option>';
                                        }
                                    ?>                                    
                                </select>
                            </div>
                            <div class="intro-x mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="link-2" class="w-4 h-4 mr-2"></i> Site Adresi</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->link?>" name="link">
                            </div>
                            <div class="intro-x mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="type" class="w-4 h-4 mr-2"></i> Site Slogan</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->slogan?>" name="slogan">
                            </div>
                            <div class="intro-x mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="globe" class="w-4 h-4 mr-2"></i> Copyright Bilgi</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->copyright?>" name="copyright">
                            </div>
                        </div>                    
                    </div>
                    <div class="tab-content__pane p-5" id="seo">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="more-horizontal" class="w-4 h-4 mr-2"></i> Seo Açıklama ( Description ) </div>
                                <textarea class="input input--lg w-full border" name="seoDescription"><?=$item->seo_description?></textarea>
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Seo Etiketler</div>
                                <textarea class="input input--lg w-full border mb-2" rows="5" name="seoKeyword"><?=$item->seo_keyword?></textarea>
                                <div class="text-xs text-gray-600">Anahtar kelimelerinizi "," virgül ile ayırarak ekleyebilirsiniz.</div>
                            </div>
                        </div>                         
                    </div>
                    <div class="tab-content__pane p-5" id="smtp">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> SMTP Protokol</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->smtp_protocol?>" name="smtp_protocol" placeholder="smtp">
                            </div>                            
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> SMTP Sunucusu</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->smtp_sunucu?>" name="smtp_sunucu" placeholder="smtp">
                            </div>                            
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SMTP Port</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->smtp_port?>" name="smtp_port" placeholder="smtp">
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="at-sign" class="w-4 h-4 mr-2"></i> SMTP Eposta Adresi</div>
                                <input type="text" class="input input--lg w-full border" value="<?=$item->smtp_eposta?>" name="smtp_eposta" placeholder="smtp">
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="key" class="w-4 h-4 mr-2"></i> SMTP Şifre</div>
                                <input type="password" class="input input--lg w-full border" value="<?=$item->smtp_sifre?>" name="smtp_sifre" placeholder="smtp">
                            </div>
                        </div>                    
                    </div>
                    <div class="tab-content__pane p-5" id="script">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Head Scriptleri </div>
                                <textarea class="input input--lg w-full border" rows="15" name="headScript"><?=$item->head_script?></textarea>
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Footer Script</div>
                                <textarea class="input input--lg w-full border" rows="15" name="footerScript"><?=$item->footer_script?></textarea>
                            </div>
                        </div>                    
                    </div>
                </div>                
            </div>
        </form>           
        <div class="post w-full intro-y overflow-hidden box mt-5">        
            <div class="post__content">
                <div class="grid grid-cols-12">
                    <div class="intro-x col-span-12 lg:col-span-6">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Logo Ekle </div>
                            <div class="mt-5">
                                <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                                    <div class="flex flex-wrap px-4 ">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <button title="Silmek için tıklayınız." class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 imageDelete" data-url="<?=base_url("admin/{$viewFolder}/logoDelete/$item->id/logo")?>"> <i data-feather="x" class="w-4 h-4"></i> </button>
                                            <img class="rounded-md" src="<?=base_url()?>upload/settings/<?=$item->logo?>">
                                        </div>
                                    </div>                                    
                                    <form action="<?=base_url("admin/{$viewFolder}/logoUpload/$item->id/logo");?>" data-plugin="dropzone" data-opions="{url<?=base_url("admin/{$viewFolder}/logoUpload/$item->id/logo");?>}" id="dropzone" class="dropzone border-gray-200 border-dashed">
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
                    <div class="intro-x col-span-12 lg:col-span-6">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Footer Logo Ekle </div>
                            <div class="mt-5">
                                <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                                    <div class="flex flex-wrap px-4 ">
                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <button title="Silmek için tıklayınız." class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 imageDelete" data-url="<?=base_url("admin/{$viewFolder}/logoDelete/$item->id/logo2")?>"> <i data-feather="x" class="w-4 h-4"></i> </button>
                                            <img class="rounded-md" src="<?=base_url()?>upload/settings/<?=$item->logo2?>">
                                        </div>
                                    </div>                                    
                                    <form action="<?=base_url("admin/{$viewFolder}/logoUpload/$item->id/logo2");?>" data-plugin="dropzone" data-opions="{url<?=base_url("admin/{$viewFolder}/logoUpload/$item->id/logo2");?>}" id="dropzone" class="dropzone border-gray-200 border-dashed">
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
        </div>
    </div>
    <!-- Post Info -->
 
</div>
<?php }else { ?>
    <form action="<?php echo base_url("admin/{$viewFolder}/save");?>" method="post">
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- Post Content -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Site Genel Bilgileri Ekleme
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button class="button text-white w-24 bg-theme-1 px-2 mr-1 shadow-md"> Kaydet </button>
                    </div>
                </div>
                <input type="text" class="input input--lg w-full border mt-2" placeholder="Site Adı" name="title">
                <div class="post intro-y overflow-hidden box mt-5">
                    <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                        <a title="Genel bilgiler" data-toggle="tab" data-target="#bilgi" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Genel Bilgiler </a>
                        <a title="Seo bilgileri" data-toggle="tab" data-target="#seo" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SEO </a>
                        <a title="SMTP Mail bilgileri" data-toggle="tab" data-target="#smtp" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="mail" class="w-4 h-4 mr-2"></i> SMTP Mail Bilgileri </a>
                        <a title="SMTP Mail bilgileri" data-toggle="tab" data-target="#script" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Script Kodları</a>
                    </div>
                    <div class="post__content tab-content">
                        <div class="tab-content__pane p-5 active" id="bilgi">
                            <div class="border border-gray-200 rounded-md p-5">                                
                                <div class="intro-x mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="aperture" class="w-4 h-4 mr-2"></i> Tema</div>
                                    <select class="input input--lg w-full border" name="tema" id="tema">
                                        <option value="light" selected>Açık</option>
                                        <option value="dark">Koyu</option>                                  
                                    </select>
                                </div>
                                <div class="intro-x mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="link-2" class="w-4 h-4 mr-2"></i> Site Adresi</div>
                                    <input type="text" class="input input--lg w-full border" value="" name="link">
                                </div>
                                <div class="intro-x mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="type" class="w-4 h-4 mr-2"></i> Site Slogan</div>
                                    <input type="text" class="input input--lg w-full border" value="" name="slogan">
                                </div>
                                <div class="intro-x mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2">  <i data-feather="globe" class="w-4 h-4 mr-2"></i> Copyright Bilgi</div>
                                    <input type="text" class="input input--lg w-full border" value="" name="copyright">
                                </div>                  
                            </div>                    
                        </div>
                        <div class="tab-content__pane p-5" id="seo">
                            <div class="border border-gray-200 rounded-md p-5">
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="more-horizontal" class="w-4 h-4 mr-2"></i> Seo Açıklama ( Description ) </div>
                                    <textarea class="input input--lg w-full border" name="seoDescription"></textarea>
                                </div>
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Seo Etiketler</div>
                                    <textarea class="input input--lg w-full border mb-2" rows="5" name="seoKeyword"></textarea>
                                    <div class="text-xs text-gray-600">Anahtar kelimelerinizi "," virgül ile ayırarak ekleyebilirsiniz.</div>
                                </div>
                            </div>                    
                        </div>
                        <div class="tab-content__pane p-5" id="smtp">
                            <div class="border border-gray-200 rounded-md p-5">
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> SMTP Protokol</div>
                                    <input type="text" class="input input--lg w-full border" name="smtp_protocol" placeholder="smtp">
                                </div>                            
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> SMTP Sunucusu</div>
                                    <input type="text" class="input input--lg w-full border" value="<?=$item->smtp_sunucu?>"name="smtp_sunucu" placeholder="smtp">
                                </div>                            
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> SMTP Port</div>
                                    <input type="text" class="input input--lg w-full border" name="smtp_port" placeholder="smtp">
                                </div>
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="at-sign" class="w-4 h-4 mr-2"></i> SMTP Eposta Adresi</div>
                                    <input type="text" class="input input--lg w-full border" name="smtp_eposta" placeholder="smtp">
                                </div>
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="key" class="w-4 h-4 mr-2"></i> SMTP Şifre</div>
                                    <input type="password" class="input input--lg w-full border" name="smtp_sifre" placeholder="smtp">
                                </div>
                            </div>                    
                        </div>
                        <div class="tab-content__pane p-5" id="script">
                            <div class="border border-gray-200 rounded-md p-5">
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Head Scriptleri </div>
                                    <textarea class="input input--lg w-full border" rows="15" name="headScript"><?=$item->head_script?></textarea>
                                </div>
                                <div class="mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Footer Script</div>
                                    <textarea class="input input--lg w-full border" rows="15" name="footerScript"><?=$item->footer_script?></textarea>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <div class="post w-full intro-y overflow-hidden box mt-5">        
                    <div class="post__content">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Logo ve Favicon </div>
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
    </form>
<?php } ?>
    