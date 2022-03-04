<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    $route['default_controller'] = 'index';
    $route['404_override'] = 'errors/404';
    $route['translate_uri_dashes'] = FALSE;

    $route['admin'] = "admin/index";
    $route['admin/(.+)'] = "admin/$1";

    $route['logout'] = "admin/logout";
    $route['forms/(:any)'] = "forms/index/$1";


    require_once( BASEPATH.'database/DB.php');
    $db=& DB();
    $data = $db->get('menus')->result();
    foreach($data as $rows){
        $route[$rows->seo_url] = "index/".$rows->modul_url;
        $route[$rows->seo_url.'/(.+)'] = "index/".$rows->modul_url.'/$1';
    }

?>