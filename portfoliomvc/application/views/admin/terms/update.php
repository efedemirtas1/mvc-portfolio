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
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__content">
                    <div class="tab-content__pane p-5">
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="type" class="w-4 h-4 mr-2"></i> Terim</div> 
                            <textarea class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" name="title" id="title"><?php echo (!empty($form_error)) ? set_value("title") : $item->text; ?></textarea>
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("title").'</div>' : ''; ?>
                        </div>
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Metod</div> 
                            <div class="flex flex-col sm:flex-row items-center">
                                <a onclick="kopyala('#kod')" class="button button--lg border flex items-center text-gray-700 bg-theme-18 mr-3" > <i data-feather="copy" class="w-4 h-4 mr-2"></i> Kopyala </a>
                                <input type="text" class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" placeholder="Örn. link-anasayfa" value="<?php echo (!empty($form_error)) ? set_value("metod") : $item->metod; ?>" name="metod" id="metod">
                                <div class="hidden" id="kod" ><?php print_r("terms('{$item->metod}')"); ?></div>
                            </div>
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("metod").'</div>' : ''; ?>
                        </div>
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="layout" class="w-4 h-4 mr-2"></i> Arayüz</div>
                            <select class="input input--lg w-full border" name="theme">
                                <?php
                                    if($item->theme == 1){
                                        echo '<option value="1" selected>Site</option>';
                                        echo '<option value="0">Admin Paneli</option>';
                                    }elseif($item->theme == 0) {
                                        echo '<option value="1">Site</option>';
                                        echo '<option value="0" selected>Admin Paneli</option>';
                                    }
                                ?>
                            </select>
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