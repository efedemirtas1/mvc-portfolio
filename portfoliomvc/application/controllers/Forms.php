<?php

	class Forms extends CI_Controller {

		public $viewFolder = "";

		/******* MODULE AİT SABİT VERİLER *******/
		public function __construct(){ 
			parent::__construct();
			$this->load->model("inbox_model");			
			
		}

        public function index($url)
        {
            $this->load->library("form_validation");

            $this->form_validation->set_rules("adsoyad", "Ad", "trim|required");
            $this->form_validation->set_rules("eposta", "E-posta", "trim|required|valid_email");
            $this->form_validation->set_rules("tel", "Tel", "trim|required");
            $this->form_validation->set_rules("konu", "Konu", "trim|required");
            $this->form_validation->set_rules("mesaj", "Mesaj", "trim|required");


            if($this->form_validation->run() === FALSE){

                $alert = array(
                    "icon" 	=> "error",
                    "title" => 'Lütfen tüm alanları doldurunuz.'
                );

                //SONUÇLARI SESSION'A GÖNDERME
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("{$url}"));

            } else {

                //TANIMLAMALAR
                $ad     = $this->input->post("adsoyad", "Ad", "trim|required");
                $eposta = $this->input->post("eposta", "E-posta", "trim|required|valid_email");
                $tel    = $this->input->post("tel", "Tel", "trim|required");
                $konu   = $this->input->post("konu", "Konu", "trim|required");
                $mesaj  = $this->input->post("mesaj", "Mesaj", "trim|required");
                //TANIMLAMALAR

                //KAYIT İŞLEMLERİ
                if($url == "iletisim"){

                    $insert = $this->inbox_model->insertData(
                        array(
                            "ad_soyad" 	    => $ad,
                            "eposta" 	    => $eposta,
                            "telefon" 	    => $tel,
                            "konu"		    => $konu,
                            "mesaj"	        => $mesaj,
                            "durum" 	    => 0,
                            "ip" 	        => ip(),
                            "json_data"     => "",
                            "creat_date"    => date("Y-m-d H:i:s")
                        ), "contact_form"            
                    );
                    
                    if($insert){

                        $alert = array(
                            "icon" 	=> "success",
                            "title" => 'Mesajınız başarılı bir şekilde iletildi.'
                        );

                    }else{	

                        $alert = array(
                            "icon" 	=> "error",
                            "title" => 'Mesajınız iletilirken bir sorun oluştu! Lütfen tekrar deneyiniz.'
                        );

                    }
                }
                //KAYIT İŞLEMLERİ

                //MAİL GÖNDERME İŞLEMLERİ
                $email_message = "
                    Merhaba; <br>
                    {$ad} adlı ziyaretçisi, <b>{$konu}</b> konulu bir mesaj gönderdi. <br>  
                    <b>Mesaj:</b> <br> 
                    {$mesaj}<br><br>
                    Detaylar için paneli ziyaret edebilirsiniz.
                ";

                mail_gonder("İletişim Sayfası Mesajı | {$konu}",  $email_message);
                //MAİL GÖNDERME İŞLEMLERİ

                //SONUÇLARI SESSION'A GÖNDERME
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("{$url}"));

            }

        }
    }

?>