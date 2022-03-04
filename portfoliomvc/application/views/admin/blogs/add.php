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
            <input type="text" class="input input--lg w-full border mt-2 mb-2 <?=$alertFormClass?>" placeholder="İçerik Adı" name="title" id="title">
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
                                <div class="intro-x col-span-12 mb-5">
                                    <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="copy" class="w-4 h-4 mr-2"></i>Kategoriler</div>
                                    <select class="input input--lg w-full border" name="category">
                                        <option value="0">Seçiniz</option>
                                        <?php echo $htmlSelectCategory; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="icerik">
                        <div class="border border-gray-200 rounded-md p-5">                            
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="more-horizontal" class="w-4 h-4 mr-2"></i> Kısa Açıklaması </div>
                                <textarea id="editor1" rows="5" name="shortDescription"></textarea>
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Açıklama</div>
                                <textarea id="editor2" rows="10" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content__pane p-5" id="seo">
                        <div class="border border-gray-200 rounded-md p-5">
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="link" class="w-4 h-4 mr-2"></i> Seo Link ( URL )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="" name="seoUrl" id="seoUrl">
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Seo Açıklama ( Description )</div>
                                <input type="text" class="input input--lg w-full border" placeholder="" name="seoDescription">
                            </div>
                            <div class="mb-5">
                                <div class="font-medium flex items-center border-b border-gray-200 pb-5 mb-2"> <i data-feather="hash" class="w-4 h-4 mr-2"></i> Seo Etiketler</div>
                                <textarea col="3" class="input input--lg w-full border mb-2" name="seoKeyword"></textarea>
                                <div class="text-xs text-gray-600">Anahtar kelimelerinizi "," virgül ile ayırarak ekleyebilirsiniz.</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="post w-full intro-y overflow-hidden box mt-5">
                <div class="post__content">
                    <div class="border border-gray-200 rounded-md p-5">
                        <div class="font-medium flex items-center border-b border-gray-200 pb-5"> <i data-feather="image" class="w-4 h-4 mr-2"></i> Resimler </div>
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