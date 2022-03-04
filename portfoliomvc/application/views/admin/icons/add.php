<form action="<?php echo base_url("admin/{$viewFolder}/save");?>" method="post">
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-8">
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
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="hash" class="w-4 h-4 mr-2"></i> İkon</div> 
                            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" placeholder="Örn. Facebook" value="<?php echo (!empty($form_error)) ? set_value("title") : ''; ?>" name="title">
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("title").'</div>' : ''; ?>
                        </div>
                        <div class="mb-5">
                            <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="code" class="w-4 h-4 mr-2"></i> İkon Class</div> 
                            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?php echo (!empty($form_error)) ? 'border-theme-6' : ''; ?>" placeholder="Örn. facebook-alt" value="<?php echo (!empty($form_error)) ? set_value("icon") : ''; ?>" name="icon">
                            <?php echo (!empty($form_error)) ? '<div class="text-theme-6 mb-2">'.form_error("icon").'</div>' : ''; ?>
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
    </div>
</form>