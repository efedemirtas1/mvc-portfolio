<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        <?=$nameModel?>
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="<?php echo base_url("admin/{$viewFolder}/add");?>" class="button text-white bg-theme-1 shadow-md mr-2">Yeni Slayt Ekle</a>
        <a href="<?php echo base_url("admin/{$viewFolder}/add");?>" class="button px-2 box text-gray-700">
            <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
        </a>
    </div>
</div>

<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="whitespace-no-wrap" width="100">Sırala</th>
                <th class="whitespace-no-wrap w-20">Resim</th>
                <th class="whitespace-no-wrap">İçerik Adı</th>
                <th class="text-center whitespace-no-wrap w-16">Durum</th>
                <th class="text-center whitespace-no-wrap w-16">İşlemler</th>
            </tr>
        </thead>
        <tbody class="sortable" data-url="<?=base_url("admin/orderUpdate/{$modelName}")?>">
            <?php foreach($dataContents as $rows){ ?>
            <tr class="intro-x" id="ord-<?=$rows->id?>">
                <td><i data-feather="move"></i></td>
                <td>
                    <div class="flex sm:justify-start">
                        <?php 
                            //Kayıt resimlerini listelemek için foksiyona(kayıt id, viewFolder, model adını) gönderin.
                            echo dataListImg($rows->id, $viewFolder, $modelName);
                        ?>
                    </div>
                </td>
                <td>
                    <a href="<?=base_url("admin/{$viewFolder}/edit/$rows->id")?>" class="font-medium"><?=$rows->title?></a>
                    <div class="text-gray-600 text-xs"><?=$rows->category?></div>
                </td>
                <td>
                    <div class="flex justify-center"> 
                        <input data-url="<?=base_url("admin/dataActive/$rows->id/{$modelName}/is_active")?>" class="show-code input input--switch border dataActive" type="checkbox" <?=$rows->is_active ? "checked" : "";?> > 
                    </div>
                </td>
                <td class="table-report__action">
                    <div class="flex justify-center">
                        <a class="flex items-center mr-3" href="<?=base_url("admin/{$viewFolder}/edit/$rows->id")?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Düzenle </a>
                        <button class="flex items-center text-theme-6 btn-delete" data-url="<?=base_url("admin/{$viewFolder}/delete/$rows->id")?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Sil </button>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>