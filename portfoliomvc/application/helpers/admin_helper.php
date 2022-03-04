<?php
/***************** PANEL FONKSIYONLARI *******************/

    /*** LOGIN KONTROL ***/
    function get_login_user(){
        $x = &get_instance();
        $user = $x->session->userdata("user");

        if($user){
            return $user;
        }else{
            return false;
        }
    }

    /*** YETKİ KONTROL ******/
    function powerControl($url){

        $x = &get_instance();
        $x->load->model("moduls_model");
        
        if($url == "index" || 
            $url == "login" || 
            $url == "logout" || 
            $url == "dataActive" || 
            $url == "dataImgActive" || 
            $url == "orderUpdate" || 
            $url == "imageUpload" || 
            $url == "imageDelete"){
            
                return true; 

        }else{
            $yetkiler = get_model_power();
            $menu = $x->moduls_model->getData(array("is_active" => 1,"seo_url" => $url),"rank ASC");
        
            $titleConvert   = url_convert($menu->title);
            if(isset($yetkiler->$titleConvert)){
                return true;
            }else{
                return false;
            }           
        }
    }

    /*** YETKİN MODEL ****/
    function get_model_power(){
        
        $x = &get_instance();
        $x->load->model("users_model");
        
        $userData 	= get_login_user();
        $userData 	= $x->users_model->getData(array("is_active" => 1, "id" => $userData->id));
        $yetkiler   = json_decode($userData->power);
        
        return $yetkiler;
    }

    /*** ADMIN MENÜ YAPISI YAZDIRMA ***/
    function treeHtmlDraw($data, $url, $ustModel = null){

        $line = "grup1";
        $yetkiler = get_model_power();
        $html = '<ul>';
            foreach($data as $rows){

                $titleConvert = url_convert($rows->title);
                if(isset($yetkiler->$titleConvert)){

                    //Grup çizgisi
                    if($rows->category != $line){
                        $html .= '<li class="side-nav__devider my-6"></li>';
                        $line = $rows->category;
                    }

                    // Kategori Linklerini doldurma
                    $link   = $rows->seo_url == "category" ? base_url("admin/".$rows->seo_url."/".$ustModel) : base_url("admin/".$rows->seo_url) ;

                    // Menülerde ACTİVE clası ekleme
                    if($url == $rows->seo_url){
                        $active = 'side-menu--active';
                    }elseif($url == "category"){                        
                        $x = &get_instance();
                        if($rows->seo_url == $x->uri->segment(3)){
                            $active = 'side-menu--active';
                        }else{
                            $active = '';
                        }
                    }else{
                        $active = '';
                    }

                    // Ana menü Alt menü link ve ikon verme
                    $links  = sizeof($rows->child) > 0 ? 'javascript:;' : $link;
                    $icon   = sizeof($rows->child) > 0 ? '<i data-feather="chevron-down" class="side-menu__sub-icon"></i>' : '';

                    $html .= '<li>
                                <a href="'.$links.'" class="side-menu '.$active.'">
                                    <div class="side-menu__icon"> <i data-feather="'.$rows->icon.'"></i> </div>
                                    <div class="side-menu__title"> '.$rows->title.' '.$icon.'</div>
                                </a>';
                        if(sizeof($rows->child) > 0){
                            $html .= treeHtmlDraw($rows->child, $url, $ustModel = $rows->seo_url);
                        }
                    $html .= '</li>';

                }
                
            }
        $html .=  '</ul>';

        return $html;
    }

    /*** ADMIN MOBIL MENÜ YAPISI YAZDIRMA ***/
    function treeMobilHtmlDraw($data, $url, $ustModel = null){

        $line = "grup1";
        $yetkiler = get_model_power();
        $html = '';
            foreach($data as $rows){

                $titleConvert = url_convert($rows->title);
                if(isset($yetkiler->$titleConvert)){

                    //Grup çizgisi
                    if($rows->category != $line){
                        $html .= '<li class="menu__devider my-6"></li>';
                        $line = $rows->category;
                    }

                    // Kategori Linklerini doldurma
                    $link   = $rows->seo_url == "category" ? base_url("admin/".$rows->seo_url."/".$ustModel) : base_url("admin/".$rows->seo_url) ;

                    // Menülerde ACTİVE clası ekleme
                    if($url == $rows->seo_url){
                        $active = 'side-menu--active';
                    }elseif($url == "category"){                        
                        $x = &get_instance();
                        if($rows->seo_url == $x->uri->segment(3)){
                            $active = 'side-menu--active';
                        }else{
                            $active = '';
                        }
                    }else{
                        $active = '';
                    }

                    // Ana menü Alt menü link ve ikon verme
                    $links  = sizeof($rows->child) > 0 ? 'javascript:;' : $link;
                    $icon   = sizeof($rows->child) > 0 ? '<i data-feather="chevron-down" class="side-menu__sub-icon"></i>' : '';

                    $html .= '<li>  
                                <a href="'.$links.'" class="menu '.$active.'">
                                    <div class="menu__icon"> <i data-feather="'.$rows->icon.'"></i> </div>
                                    <div class="menu__title"> '.$rows->title.' '.$icon.'</div>
                                </a>';
                        if(sizeof($rows->child) > 0){
                            $html .= treeMobilHtmlDraw($rows->child, $url, $ustModel = $rows->seo_url);
                        }
                    $html .= '</li>';
                }

            }

        return $html;
    }

    /*** INPUT SELECT KATEGORI YAPISI YAZDIRMA ***/
    function treeSelectHtmlDraw($data, $id, $ust_id, $line = ""){
        $html = $line = "";
        foreach($data as $rows){

            if($rows->id != $id){
                $line       = $rows->ust_id > 0 ? '--' : '';
                $selected   = $rows->id == $ust_id ? 'selected' : '';

                $html .= '<option  value="'.$rows->id.'" '.$selected.'>'.$line.' '.$rows->title.'</option>';
                
                if(sizeof($rows->child) > 0){
                    $html .= treeSelectHtmlDraw($rows->child, $id, $ust_id);
                }
            }
        }
        return $html;
    }

    /*** KAYIT RESİMLERİNİ ÖZNİZLEME ***/
    function dataListImg($id, $viewFolder, $model){

        $x = &get_instance();
        $x->load->model($model);

        $data = $x->$model->getImageAll(
            array(
                "item_id" => $id,
                "is_active" => 1,
            ),
            "rank ASC",
            3
        );
        
        return dataListImgHtml($data, $viewFolder);           

    }
    
    
    /*** KAYIT RESİMLERİNİ HTML ***/
    function dataListImgHtml($data, $viewFolder){

        $html = "";
        $say = 1;
        if($data){

            foreach($data as $rows){

                $say > 1 ? $imgFit = '-ml-5' : $imgFit = '';

                $html .= '<div class="intro-x w-10 h-10 image-fit '.$imgFit.'">';
                    $html .= '<img class="rounded-full" src="'.base_url("upload/{$viewFolder}/").$rows->img_url.'" alt="'.$rows->img_url.'">';
                $html .= '</div>';

                $say++;
            }

        }else{
            $html .= '<div class="intro-x w-10 h-10 image-fit">';
                $html .= '<img class="rounded-full" src="'.base_url("upload/general/default-img.jpg").'" alt="default-img.jpg">';
            $html .= '</div>';
        }

        return $html;    

    }

    /*** YETKİLER MODÜL YAPISI YAZDIRMA ***/
    function treePowerDraw($data, $user){
        $html = '';
            foreach($data as $rows){

                $yetkiler       = json_decode($user);
                $titleConvert   = url_convert($rows->title);
                $readChecked    = (isset($yetkiler->$titleConvert)) && (isset($yetkiler->$titleConvert->read))      ? "checked" : "" ;
                $childClass     = $rows->ust_id == 0 ? 'class="bg-gray-200 text-gray-700"' : '';

                $html .= '<tr '.$childClass.'>';
                    $html .= '<td class="border-b">'.$rows->title.'</td>';
                    $html .= '<td class="border-b text-center"><input '.$readChecked.' name="yetkiler['.$titleConvert.'][read]" class="show-code input input--switch border checkhourread" type="checkbox"> </td>';
                $html .= '</tr>';

                if(sizeof($rows->child) > 0){
                    $html .= treePowerDraw($rows->child, $user);
                }
            };

        return $html;
    }

    
?>