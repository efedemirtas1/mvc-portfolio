<?php $jsonData = json_decode($item->json_data,true); ?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        <?php
            if($nameForm == "contact_form"){
                echo 'İletişim';
            }elseif($nameForm == "request_form"){
                echo 'Talep';
            }elseif($nameForm == "ik_form"){
                echo 'İnsan Kaynakları';
            }
        ?>
        Mesajları
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button class="button text-white bg-theme-1 shadow-md mr-2 rounded btn-delete" data-url="<?=base_url("admin/{$viewFolder}/delete/{$item->id}/{$nameForm}")?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> </button>
        <a class="button px-2 mr-1 bg-theme-6 text-white rounded" href="<?=base_url("admin/{$viewFolder}/{$nameForm}")?>"> <i data-feather="x" class="w-4 h-4 mr-1"></i> </a>
    </div>
</div>
<!-- BEGIN: Invoice -->
<div class="intro-y box overflow-hidden mt-5">
    <div class="border-b border-gray-200 text-center sm:text-left">
        <div class="grid grid-cols-12 gap-6 px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
            
            <ul class="col-span-12 sm:col-span-6 intro-y">
                <ul class="text-theme-1 font-semibold text-3xl"><?=$item->ad_soyad?></ul>
                <ul class="text-theme-1 font-semibold text-3xl"><?=$useragent = $_SERVER['HTTP_USER_AGENT'];?></ul>
                <ul class="mt-2"> IP : <span class="font-medium"><?=$item->ip?></span> </ul>
                <ul class="mt-2"> Konum :  <span class="font-medium"><?=$jsonData['city'].' / '.$jsonData['country']?></span></ul>
                <ul class="mt-1"> Tarih : <span class="font-medium"><?=date('d.m.y H:i', strtotime($item->creat_date))?></span></ul>
            </ul>

            <ul class="col-span-12 sm:col-span-6 intro-y text-right">
                <li class="font-extrabold">Mesaj Konusu</li>
                <li class="text-lg font-medium text-theme-1 mt-2"><?=$item->konu?></li>
                <li class="font-extrabold">Telefon</li>
                <li class="mt-1"><?=$item->telefon?></li>
                <li class="font-extrabold">E-posta</li>
                <li class="mt-1"><?=$item->eposta?></li>
            </ul>

        </div>
    </div>
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class="overflow-x-auto">
            <div class="font-extrabold">Gönderilen Mesajı</div>
            <div class="mt-1"><?=$item->mesaj?></div>
        </div>
    </div>
</div>
<!-- END: Invoice -->