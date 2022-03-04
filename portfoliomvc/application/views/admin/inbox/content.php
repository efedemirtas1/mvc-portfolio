<div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
        <h2 class="intro-y text-lg font-medium mr-auto">
            <?=$nameModel?>
        </h2>
        <div class="intro-y box bg-theme-1 p-5 mt-6">
            <div class="p-3 text-white">
                <a href="<?=base_url("admin/{$viewFolder}/contact_form");?>" class="flex items-center px-3 py-2 mb-2 rounded-md <?php echo $nameForm == "contact_form" ? "bg-theme-22 font-medium" : "" ?>"> <i class="w-4 h-4 mr-2" data-feather="inbox"></i> İletişim Formu </a>
                <a href="<?=base_url("admin/{$viewFolder}/request_form");?>" class="flex items-center px-3 py-2 mb-2 rounded-md <?php echo $nameForm == "request_form" ? "bg-theme-22 font-medium" : "" ?>"> <i class="w-4 h-4 mr-2" data-feather="inbox"></i> Talep Formu </a>
                <a href="<?=base_url("admin/{$viewFolder}/ik_form");?>" class="flex items-center px-3 py-2 rounded-md <?php echo $nameForm == "ik_form" ? "bg-theme-22 font-medium" : "" ?>"> <i class="w-4 h-4 mr-2" data-feather="inbox"></i> İK Formu </a>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10 mt-6">
        <div class="intro-y datatable-wrapper box p-5 mt-8">
            <table class="table table-report table-report--bordered display datatable w-full">
                <thead>
                    <tr>
                        <th class="w-32">Gönderen Kişi</th>
                        <th class="text-left w-32">Konu</th>
                        <th class="text-left">Mesajı</th>
                        <th class="text-center whitespace-no-wrap w-16">Durum</th>
                        <th class="text-center whitespace-no-wrap w-16">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($dataContents as $rows){
                    ?>
                        <tr class="intro-x">
                            <td><a href="<?=base_url("admin/{$viewFolder}/view/{$rows->id}/{$nameForm}");?>" class="font-medium"><?=$rows->ad_soyad?></a></td>
                            <td>
                                <div class="font-medium"><?=$rows->konu?></div>
                            </td>
                            <td>
                                <div class="text-gray-600 text-xs"><?=date('Y-m-d H:i', strtotime($rows->creat_date))?></div>
                                <?=$rows->mesaj?>
                            </td>
                            <td>
                                <?php if($rows->durum == 1){?>
                                    <span class="flex justify-center text-theme-9 font-medium"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Okundu </a>
                                <?php }else{ ?>
                                    <span class="flex justify-center text-theme-6 font-medium"> <i data-feather="x-square" class="w-4 h-4 mr-1"></i> Okunmadı </a>
                                <?php } ?>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-end">
                                    <a class="flex items-center mr-3" href="<?=base_url("admin/{$viewFolder}/view/{$rows->id}/{$nameForm}")?>"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> Görüntüle </a>
                                    <button class="flex items-center text-theme-6 ml-4 btn-delete" data-url="<?=base_url("admin/{$viewFolder}/delete/{$rows->id}/{$nameForm}")?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> </button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>