<?php

/***************** ORTAK FONKSIYONLAR *******************/

    /*** URL CEVIRME ***/
    function url_convert($url){
        
        $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
        $turkceto = array("G","U","S","I","O","C","g","u","s","i","o","c");
        $url = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$url);
        // Türkçe harfleri ingilizceye çevir
        $url = preg_replace($turkcefrom,$turkceto,$url);
        // Birden fazla olan boşlukları tek boşluk yap
        $url = preg_replace("/ +/"," ",$url);
        // Boşukları - işaretine çevir
        $url = preg_replace("/ /","-",$url);
        // Tüm beyaz karekterleri sil
        $url = preg_replace("/\s/","",$url);
        // Karekterleri küçült
        $url = strtolower($url);
        // Başta ve sonda - işareti kaldıysa yoket
        $url = preg_replace("/^-/","",$url);
        $url = preg_replace("/-$/","",$url);

        return $url;
    }

    /*** TERİM ÇAĞIRMA ****/
    function terms($metod){  
        $x = &get_instance();
        $x->load->model("terms_model");      
        //TERİMLER
        $dataTerms = $x->terms_model->getData(
            array( 
                "is_active" => 1,
                "metod" => $metod
            )
        );

        return $dataTerms->text;
    }

    /*** IC ICE KATEGORISI YAPISI YAZDIRMA ***/
    function treeDraw($data, $id = 0){

        $branch = array();
        foreach($data as $rows){

            if($rows->ust_id == $id){

                $child = treeDraw($data, $rows->id);
                if($child){
                    $rows->child = $child;
                }else{
                    $rows->child = array();
                }

                $branch[] = $rows;
            }       
        }    
        return $branch;
    }

    function dataCoverImg($id, $viewFolder, $model){

        $x = &get_instance();
        $x->load->model($model);
        
        $viewFolder == "slides" ? $cover = 0 : $cover = 1;

        $data = $x->$model->getImageAll(
            array(
                "item_id" => $id,
                "cover_active" => $cover,
                "is_active" => 1,
            ),
            "rank ASC",
            1
        );
        
        return dataImgName($data, $viewFolder);           

    }
    
    function dataBlokImg($id, $viewFolder, $model){

        $x = &get_instance();
        $x->load->model($model);
        
        $data = $x->$model->getImageAll(
            array(
                "item_id" => $id,
                "cover_active" => 0,
                "is_active" => 1,
            ),
            "rank ASC",
            1
        );
        
        return dataImgName($data, $viewFolder);           

    }

    /*** RESİM ADI GÖNDERME ***/
    function dataImgName($data, $viewFolder){

        $html = "";
        if($data){
            foreach($data as $rows){
                $html .= base_url("upload/$viewFolder/").$rows->img_url;
            }
        }else{
            $html .= base_url("upload/general/default-img.jpg");
        }

        return $html;            

    }

    /*** MAİL GÖNDERME ***/
    function mail_gonder($subject = "", $message = ""){
    
        $x = &get_instance();    
        $x->load->model("settings_general_model");

        $email_settings = $x->settings_general_model->getData(array());        
        
        $config = array(    
            "protocol"   => $email_settings->smtp_protocol,
            "smtp_host"  => $email_settings->smtp_sunucu,
            "smtp_port"  => $email_settings->smtp_port,
            "smtp_user"  => $email_settings->smtp_eposta,
            "smtp_pass"  => $email_settings->smtp_sifre,
            "starttls"   => true,
            "charset"    => "utf-8",
            "mailtype"   => "html",
            "wordwrap"   => true,
            "newline"    => "\r\n"
        );

        $x->load->library("email", $config);
    
        $x->email->from($email_settings->smtp_eposta, "Web sitesi");
        $x->email->to($email_settings->smtp_eposta);
        $x->email->subject($subject);
        $x->email->message($message);
    
        return $x->email->send();
    
    }
        
    /*** İP ADRESİ ALMA */
    function ip() {
		$mainIp = '';
		if (getenv('HTTP_CLIENT_IP'))
			$mainIp = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$mainIp = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$mainIp = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$mainIp = getenv('REMOTE_ADDR');
		else
			$mainIp = 'UNKNOWN';
		return $mainIp;
	}

    
    /**** TÜRKÇE TARİH ÇEVİRİ ****/
    function turkcetarih_cevir($format, $datetime = 'now'){
        $z = date("$format", strtotime($datetime));
        $gun_dizi = array(
            'Monday'    => 'Pazartesi',
            'Tuesday'   => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday'  => 'Perşembe',
            'Friday'    => 'Cuma',
            'Saturday'  => 'Cumartesi',
            'Sunday'    => 'Pazar',
            'January'   => 'Ocak',
            'February'  => 'Şubat',
            'March'     => 'Mart',
            'April'     => 'Nisan',
            'May'       => 'Mayıs',
            'June'      => 'Haziran',
            'July'      => 'Temmuz',
            'August'    => 'Ağustos',
            'September' => 'Eylül',
            'October'   => 'Ekim',
            'November'  => 'Kasım',
            'December'  => 'Aralık',
            'Mon'       => 'Pts',
            'Tue'       => 'Sal',
            'Wed'       => 'Çar',
            'Thu'       => 'Per',
            'Fri'       => 'Cum',
            'Sat'       => 'Cts',
            'Sun'       => 'Paz',
            'Jan'       => 'Oca',
            'Feb'       => 'Şub',
            'Mar'       => 'Mar',
            'Apr'       => 'Nis',
            'Jun'       => 'Haz',
            'Jul'       => 'Tem',
            'Aug'       => 'Ağu',
            'Sep'       => 'Eyl',
            'Oct'       => 'Eki',
            'Nov'       => 'Kas',
            'Dec'       => 'Ara',
        );
        foreach($gun_dizi as $en => $tr){
            $z = str_replace($en, $tr, $z);
        }
        if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
        return $z;
    }
    
?>