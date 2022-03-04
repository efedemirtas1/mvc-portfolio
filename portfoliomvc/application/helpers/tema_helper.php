<?php

/***************** TEMA FONKSIYONLARI *******************/

    /*** HEADER MENÜ YAZDIRMA ***/
    function htmlHeaderMenuDraw($data, $url, $child = 0) {
        $html  = "";
            foreach($data as $rows){

                /*** MENÜ OZELLIKLERI (yeni sekme, dış link vb.) ***/
                $active     = $url == $rows->seo_url ? 'active' : '';
                $target     = $rows->target_active == 1 ? 'target="_blank"' : '';

                /*** ACILIR MENÜLER ***/
                if(sizeof($rows->child) > 0){
                    
                    
                    /*** MENÜ OZEL ISE ***/
                    if($rows->special_active == 1){
                        
                        $html .= '<li class="nav-item dropdown dropdown-mega">
                                    <a class="nav-link dropdown-toggle '.$url.'" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="'.$rows->title.'">               
                                        '.$rows->title.'
                                    </a>';
                            $html   .= '<ul class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">';
                                $html .= htmlHeaderMenuDraw($rows->child, $rows->seo_url, $child = 1);
                            $html .= '</ul>';
                        $html .= '</li>';

                    /*** MENÜ OZEL DEGIL ISE ***/
                    }else{
                        $link       = $rows->external_url == "#" ||  $rows->external_url == null ? base_url($rows->seo_url) : $rows->external_url ;

                        $html .= '<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle '.$active.'" href="'.$link.'" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="'.$rows->title.'">               
                                        '.$rows->title.'
                                    </a>';
                            $html   .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                $html .= htmlHeaderMenuDraw($rows->child, $rows->seo_url, $child = 1);
                            $html .= '</ul>';
                        $html .= '</li>';
                    }

                    $child = 0;
                
                /*** ACILIR MENÜLERIN ALT MENÜLERI ***/
                }elseif($child == 1){
                    
                    $link       = $rows->external_url == "#" ||  $rows->external_url == null ? base_url($url."/".$rows->seo_url) : $rows->external_url ;

                    /*** MENÜ OZEL ISE ***/
                    if($rows->special_active == 1){
                        $html .= '<li class="col-md">
                                    <a class="mega-item" '.$target.' href="'.$link.'" title="'.$rows->title.'">
                                    <img src="'.base_url("upload/general/{$rows->seo_url}.svg").'" alt="'.$rows->title.'" height="110"> <span>'.$rows->title.'</span></a>
                                </li>';
                        
                    /*** MENÜ OZEL DEGIL ISE ***/
                    }else{
                        $html .= '<li><a class="dropdown-item" '.$target.' href="'.$link.'" title="'.$rows->title.'">'.$rows->title.'</a></li>';
                    }
                
                /*** ANA MENÜLER ***/
                }else {

                    $link       = $rows->external_url == "#" ||  $rows->external_url == null ? $rows->seo_url : $rows->external_url ;

                    $html .= '<li>
                                <a class="'.$active.'" '.$target.' href="'.base_url($link).'" title="'.$rows->title.'">                    
                                    '.$rows->title.'
                                </a>';
                    $html .= '</li>';

                }
            }

        return $html;
    }

    /*** SABİT LİNK ÇAĞIRMA ****/
    function getLink($modul){

        $x = &get_instance();
        $x->load->model("menus_model");

        $data = $x->menus_model->getData(
            array(
                "is_active"  => 1,
                "ust_id"    => 0,
                "modul_url" => $modul
            )                
        );

        return $data->seo_url;
    }
    
    /*** FOOTER MENÜ OLUŞTURMA ***/
    function footerSubMenu($modul){
        
        $x = &get_instance();        
        $x->load->model("menus_model");

        $anaMenu = $x->menus_model->getData(
            array(
                "is_active"      => 1,
                "ust_id"        => 0,
                "modul_url"    => $modul
            )
        );

        $altMenuler = $x->menus_model->getDataAll(
            array(
                "is_active"      => 1,
                "footer_active"  => 1,
                "ust_id "       => $anaMenu->id
            ),"rank ASC"
        );

        $data = footerMenuHtmlDraw($altMenuler, $anaMenu->seo_url);
        return $data;
    }

    function footerMenu($modul = null){
        
        $x = &get_instance();        
        $x->load->model("menus_model");

        if(isset($modul)){  

            $anaMenu = $x->menus_model->getDataAll(
                array(
                    "is_active"      => 1,
                    "footer_active"  => 1,
                    "ust_id"        => 0,
                    "modul_url"    => $modul
                ),"rank ASC"
            );

        }else{
            $anaMenu = $x->menus_model->getDataAll(
                array(
                    "is_active"      => 1,
                    "footer_active"  => 1,
                    "ust_id"        => 0
                ),"rank ASC"
            );
        }

        $data = footerMenuHtmlDraw($anaMenu);
        return $data;
    }
    
    /*** FOOTER MENÜ YAZDIRMA ***/
    function footerMenuHtmlDraw($data, $ustMenu = null){
        
        $html = "";
        foreach($data as $rows){
            $html .='<li><a href="'.base_url($ustMenu.'/'.$rows->seo_url).'">'.$rows->title.'</a></li>';
        }
        return $html;
    }
        
    /*** KATEGORİ LİNK YAPISINI ***/
    function treeLinks($category_id){        
        $x = &get_instance();
        $x->load->model("category_model");
        $html = "";

        $data = $x->category_model->getData(
            array(
                "id" => $category_id
            ), "rank ASC"
        );
        
        if($data){
            $data2 = $x->category_model->getData(
                array(
                    "id" => $data->ust_id
                ), "rank ASC"
            );
        }else{
            $data2 = "";
        }


        if($data2){
            $html = $data2->seo_url."/".$data->seo_url."/";
        }elseif($data){
            $html = $data->seo_url."/";
        }
        
        return $html;

    }


?>