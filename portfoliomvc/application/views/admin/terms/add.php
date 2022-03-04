<form action="<?php echo base_url("admin/{$viewFolder}/save");?>" method="post">
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
        <!-- Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="intro-y flex flex-col sm:flex-row items-center">
                <h2 class="text-lg font-medium mr-auto">
                    Yeni Terim Ekleme
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button class="button text-white w-24 bg-theme-1 px-2 mr-1 shadow-md"> Kaydet </button>
                    <a href="<?php echo base_url("admin/{$viewFolder}");?>" class="button px-2 mr-1 bg-theme-6 text-white"> <i data-feather="x"></i> </a>
                </div>
            </div>
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__content">
                    <div class="tab-content__pane p-5">
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="type" class="w-4 h-4 mr-2"></i> Terim</div> 
                            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" placeholder="Örn. Anasayfa" value="<?php echo (!empty($form_error)) ? set_value("title") : ''; ?>" name="title" id="title">
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("title").'</div>' : ''; ?>
                        </div>
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Metod</div> 
                            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" placeholder="Örn. link-anasayfa" value="<?php echo (!empty($form_error)) ? set_value("metod") : ''; ?>" name="metod" id="metod">
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("metod").'</div>' : ''; ?>
                        </div>
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="layout" class="w-4 h-4 mr-2"></i> Arayüz</div>
                            <select class="input input--lg w-full border" name="theme">
                                <option value="1" selected>Site</option>
                                <option value="0">Admin Paneli</option>
                            </select>
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
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> İçerik ile ilgili yapılacak işlemler burada listelenecektir. </div>
            </div>
        </div>
        <!-- Post Info -->
    </div>
</form>