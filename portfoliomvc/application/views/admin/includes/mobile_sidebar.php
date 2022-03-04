<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="<?=base_url("admin");?>" class="flex mr-auto">
            <i class="text-white" data-feather="slack"></i>
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <?php echo $htmlMobileSideMenu; ?>
    </ul>
</div>