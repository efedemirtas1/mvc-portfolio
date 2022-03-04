<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <i class="text-white" data-feather="slack"></i>
                    <span class="text-white text-lg ml-3"> Yönetim<span class="font-medium"> Paneli</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="panel-bg" class="-intro-x w-1/2 -mt-16" src="<?=base_url("assets/admin/images/illustration.svg")?>">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        İçerik yönetimlerinizi  
                        <br>
                        kullanıcı dostu panelimiz üzerinden
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white">kullanıcı adı ve şireniz ile giriş yaparak gerçekleştirebilirsiniz.</div>
                </div>
            </div>
            <!-- Login Info -->
            <!-- Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form action="<?php echo base_url("admin/login/control")?>" method="post">
                    <input type="hidden" name="metod" value="control">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Yönetici Giriş Formu
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">İçerik yönetimilerinizi kullanıcı dostu panelimiz üzerinden kullanıcı adı ve şireniz ile giriş yaparak gerçekleştirebilirsiniz.</div>
                        <div class="intro-x mt-8">
                            <?php
                                if(isset($form_error)){
                                    $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("user_name").'</div>';
                                }else{
                                    $alertFormMessage = '';
                                }
                            ?>
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Kullanıcı adı" name="user_name">
                            <?=$alertFormMessage?>
                            <?php
                                if(isset($form_error)){
                                    $alertFormMessage = '<div class="text-theme-6 mt-2">'.form_error("user_password").'</div>';
                                }else{
                                    $alertFormMessage = '';
                                }
                            ?>
                            <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Şifre" name="user_password">
                            <?=$alertFormMessage?>
                        </div>
                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Beni Hatırla</label>
                            </div>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Giriş yap</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login Form -->
        </div>
    </div>
    <?php $this->load->view("admin/includes/footer_links");  ?>
</body>