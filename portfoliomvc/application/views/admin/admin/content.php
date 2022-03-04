<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Genel Raporlar
                </h2>
                <a href="<?=base_url("admin")?>" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Verileri Güncelle </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">

                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="zap" class="report-box__icon text-theme-11"></i> 
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6"><?=$data2?></div>
                            <div class="text-base text-gray-600 mt-1">Portfölyo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        <!-- BEGIN: Sales Report -->
        <div class="col-span-12 lg:col-span-8 mt-8">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Ziyaretçi Grafiği
                </h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div class="flex flex-col xl:flex-row xl:items-center">
                    <div class="flex">
                        <div>
                            <div class="text-theme-20 text-lg xl:text-xl font-bold">1000</div>
                            <div class="text-gray-600">Bu Ay</div>
                        </div>
                        <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6"></div>
                        <div>
                            <div class="text-gray-600 text-lg xl:text-xl font-medium">1000</div>
                            <div class="text-gray-600">Geçen Ay</div>
                        </div>
                    </div>
                </div>
                <div class="report-chart">
                    <canvas id="report-line-chart" height="160" class="mt-6"></canvas>
                </div>
            </div>
        </div>
        <!-- END: Sales Report -->
        <!-- BEGIN: Weekly Top Seller -->
        <div class="col-span-12 sm:col-span-6 lg:col-span-4 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Ziyaretçi Cihaz Grafiği
                </h2>
            </div>
            <div class="intro-y box p-5 mt-5">
                <canvas class="mt-3" id="report-pie-chart" height="280"></canvas>
                <div class="mt-8">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                        <span class="truncate">Masaüstü & Leptop</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">62%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                        <span class="truncate">Mobil Cihaz</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">33%</span> 
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Weekly Best Sellers -->
        <!-- BEGIN: General Report -->
        <div class="col-span-12 grid grid-cols-12 gap-6">
            <div class="intro-y block sm:flex items-center col-span-12">
                <h2 class="text-lg font-medium truncate mr-5">
                    Sosyal Medya Hesapları
                </h2>
            </div>
            <?php foreach($dataSosyal as $rows) {?>
            <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y">
                <div class="mini-report-chart box p-5 zoom-in">
                    <div class="flex items-center">
                        <div class="w-2/4 flex-none">
                            <div class="text-lg font-medium truncate"><?=$rows->title?></div>
                            <div class="text-gray-600 mt-1"><?=$rows->title?></div>
                        </div>
                        <div class="flex-none ml-auto relative">
                        <i data-feather="<?php 
                                switch($rows->icon){
                                    case "youtube-play" : echo "youtube" ; break;
                                    case "tramvay"       : echo "alert-triangle" ; break;
                                    case "otobus"       : echo "alert-triangle" ; break;
                                    case "dolmus"       : echo "alert-triangle" ; break;
                                    case "marker"       : echo "alert-triangle" ; break;
                                    default : echo $rows->icon;            
                                }
                            ?>" class="report-box__icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">


            <!-- BEGIN: Schedules -->
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 xl:col-start-1 xl:row-start-2 xxl:col-start-auto xxl:row-start-auto mt-3">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Takvim
                    </h2>
                </div>
                <div class="mt-5">
                    <div class="intro-x box">
                        <div class="p-5">
                            <div class="flex">
                                <i data-feather="chevron-left" class="w-5 h-5 text-gray-600"></i> 
                                <div class="font-medium mx-auto">Eylül</div>
                                <i data-feather="chevron-right" class="w-5 h-5 text-gray-600"></i> 
                            </div>
                            <div class="grid grid-cols-7 gap-4 mt-5 text-center">
                                <div class="font-medium">Pzt</div>
                                <div class="font-medium">Sal</div>
                                <div class="font-medium">Çar</div>
                                <div class="font-medium">Prş</div>
                                <div class="font-medium">Cum</div>
                                <div class="font-medium">Cmrt</div>
                                <div class="font-medium">Pzr</div>
                                <div class="py-1 rounded relative text-gray-600">29</div>
                                <div class="py-1 rounded relative text-gray-600">30</div>
                                <div class="py-1 rounded relative text-gray-600">31</div>
                                <div class="py-1 rounded relative">1</div>
                                <div class="py-1 rounded relative">2</div>
                                <div class="py-1 rounded relative">3</div>
                                <div class="py-1 rounded relative">4</div>
                                <div class="py-1 rounded relative">5</div>
                                <div class="py-1 bg-theme-18 rounded relative">6</div>
                                <div class="py-1 rounded relative">7</div>
                                <div class="py-1 bg-theme-1 text-white rounded relative">8</div>
                                <div class="py-1 rounded relative">9</div>
                                <div class="py-1 rounded relative">10</div>
                                <div class="py-1 rounded relative">11</div>
                                <div class="py-1 rounded relative">12</div>
                                <div class="py-1 rounded relative">13</div>
                                <div class="py-1 rounded relative">14</div>
                                <div class="py-1 rounded relative">15</div>
                                <div class="py-1 rounded relative">16</div>
                                <div class="py-1 rounded relative">17</div>
                                <div class="py-1 rounded relative">18</div>
                                <div class="py-1 rounded relative">19</div>
                                <div class="py-1 rounded relative">20</div>
                                <div class="py-1 rounded relative">21</div>
                                <div class="py-1 rounded relative">22</div>
                                <div class="py-1 bg-theme-17 rounded relative">23</div>
                                <div class="py-1 rounded relative">24</div>
                                <div class="py-1 rounded relative">25</div>
                                <div class="py-1 rounded relative">26</div>
                                <div class="py-1 bg-theme-14 rounded relative">27</div>
                                <div class="py-1 rounded relative">28</div>
                                <div class="py-1 rounded relative">29</div>
                                <div class="py-1 rounded relative">30</div>
                                <div class="py-1 rounded relative text-gray-600">1</div>
                                <div class="py-1 rounded relative text-gray-600">2</div>
                                <div class="py-1 rounded relative text-gray-600">3</div>
                                <div class="py-1 rounded relative text-gray-600">4</div>
                                <div class="py-1 rounded relative text-gray-600">5</div>
                                <div class="py-1 rounded relative text-gray-600">6</div>
                                <div class="py-1 rounded relative text-gray-600">7</div>
                                <div class="py-1 rounded relative text-gray-600">8</div>
                                <div class="py-1 rounded relative text-gray-600">9</div>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 p-5">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-theme-7 rounded-full mr-3"></div>
                                <span class="truncate">Resmi Özel Günler</span> 
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-theme-5 rounded-full mr-3"></div>
                                <span class="truncate">Dini Özel Günler</span> 
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                <span class="truncate">Uluslararası Özel Günler</span> 
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Schedules -->



        </div>
    </div>
</div>