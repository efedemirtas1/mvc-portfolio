<?php

    class Index extends CI_Controller {

        public $viewModel = "";

        /******* MODULE AİT SABİT VERİLER *******/
        public function __construct(){ 
            parent::__construct();

            /******* TANIMLAMALAR *********/
                $this->segment1 = $this->uri->segment(1);
                $this->segment2 = $this->uri->segment(2);
                $this->load->helper("text_helper");

                $this->load->model("menus_model");
                $this->load->model("slides_model");
                $this->load->model("pages_model");
                $this->load->model("blogs_model");
                $this->load->model("terms_model");
                $this->load->model("settings_general_model");
                $this->load->model("contact_model");
            /******* TANIMLAMALAR *********/
                
            /******** İŞLEMLER *********/                
                
                //HEADER MENU
                $dataMenu 		= $this->menus_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "header_active"  => 1
                    ),
                    "rank ASC"
                );
                $treeMenu 		        = treeDraw($dataMenu); //Kategori ağaçını oluşturma
                $this->htmlHeaderMenu   = htmlHeaderMenuDraw($treeMenu, $this->segment1); //Ağaç verilerini html giydirme.

                //SOSYAL MEDYALAR
                $this->sosyalMedyalar   = $this->contact_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "home_active"    => 1,
                        "category"      => "sosyal-medya"
                    ),
                    "rank ASC"
                );                
                
                //POPUP
                $this->popup         = $this->slides_model->getData(
                    array(
                        "is_active" => 1,
                        "category" => "popup",
                    ),
                    "rank ASC",
                    1
                );

                //SİTE AYARLARI
                $this->ayarlar 		= $this->settings_general_model->getData(array());

                //İLETİŞİM BİLGİLERİ
                $this->iletisim         = $this->contact_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "category"      => "bilgi"
                    ),"rank ASC",5
                );              
            /******** İŞLEMLER *********/

        }

        /******* ANASAYFA *******/
        public function index(){
            
            /******* TANIMLAMALAR *********/
                $this->viewModel = "anasayfa";
                $viewData 		= new stdClass();
            /******* TANIMLAMALAR *********/
                
            /******** İŞLEMLER *********/

                //SLİDER
                $slider         = $this->slides_model->getDataAll(
                    array(
                        "is_active" => 1,
                        "category" => "resim"
                    ),"rank ASC",5
                );

                //HAKKIMIZDA
                $hakkimizda        = $this->pages_model->getData(
                    array(
                        "is_active"      => 1,
                        "home_active"    => 1,
                        "metod"         => "about"
                    ),"rank ASC"
                );

            /******** İŞLEMLER *********/

            /******** GÖNDERİLENLER *********/
                $viewData->iletisim       				= $this->iletisim;
                $viewData->ayarlar       				= $this->ayarlar;
                $viewData->sosyalMedyalar 				= $this->sosyalMedyalar;
                $viewData->htmlHeaderMenu 				= $this->htmlHeaderMenu;
                $viewData->popupData      				= $this->popup;
                $viewData->sliderData      				= $slider;
                $viewData->hakkimizda 				    = $hakkimizda;
                $viewData->viewModel					= $this->viewModel;
            /******** GÖNDERİLENLER *********/
            
		    $this->load->view("tema/index", $viewData);
        
        }

        /******* BLOG *******/
        public function blogs() {
                
            /******* TANIMLAMALAR *********/
                $this->viewModel = "blogs";
                $viewData 		= new stdClass();
            /******* TANIMLAMALAR *********/
                
            /******** İŞLEMLER *********/

            //MENU
            $viewData->menu = $menu     = $this->menus_model->getData(
                array(
                    "is_active"         => 1,
                    "seo_url"           => $this->segment1
                ),"rank ASC"
            );

            if(empty($this->segment2)){

                //İÇERİKLER
                $viewData->icerikler        = $this->blogs_model->getDataAll(
                    array(
                        "is_active"      => 1
                    ),"rank ASC"
                );

            }else{

                //İÇERİK DETAY
                $viewData->icerik     = $this->blogs_model->getData(
                    array(
                        "is_active"      => 1,
                        "seo_url"       => $this->segment2
                    ),"rank ASC"
                );

                //DİĞER İÇERİKLER
                $viewData->digericerikler    = $this->blogs_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "seo_url !="       => $this->segment2
                    ),"rank ASC"
                );

            }
            /******** İŞLEMLER *********/

            /******** GÖNDERİLENLER *********/
                $viewData->iletisim       		= $this->iletisim;
                $viewData->ayarlar       		= $this->ayarlar;
                $viewData->sosyalMedyalar 		= $this->sosyalMedyalar;
                $viewData->htmlHeaderMenu 		= $this->htmlHeaderMenu;
                $viewData->viewModel			= $this->viewModel;
            /******** GÖNDERİLENLER *********/

            $this->load->view("tema/index", $viewData);
        }


        /******* SAYFALAR *******/
        public function pages(){

            /******* TANIMLAMALAR *********/
                $viewData 		= new stdClass();
                (empty($this->uri->segment(1))) ? $detay = $this->uri->segment(2) :  $detay = $this->uri->segment(1);
            /******* TANIMLAMALAR *********/

            /******** İŞLEMLER *********/
            
            //MENU
            $viewData->menu = $menu     = $this->menus_model->getData(
                array(
                    "is_active"         => 1,
                    "seo_url"           => $detay
                ),"rank ASC"
            );

            if(empty($this->segment2)){
                
                //İÇERİKLER
                $viewData->icerik = $icerik = $this->pages_model->getData(
                    array(
                        "is_active"         => 1,
                        "seo_url"           => $this->uri->segment(1)
                    ),"rank ASC"
                );

            }else{

                //İÇERİKLER
                $viewData->icerik = $icerik = $this->pages_model->getData(
                    array(
                        "is_active"         => 1,
                        "seo_url"           => $this->uri->segment(2)
                    ),"rank ASC"
                );

            }
            
            /******** İŞLEMLER *********/

            /******** GÖNDERİLENLER *********/
                $viewData->iletisim				= $this->iletisim;
                $viewData->ayarlar       		= $this->ayarlar;
                $viewData->sosyalMedyalar 		= $this->sosyalMedyalar;
                $viewData->htmlHeaderMenu 		= $this->htmlHeaderMenu;
                $viewData->viewModel            = "sayfa{$icerik->template}";
            /******** GÖNDERİLENLER *********/
        
            $this->load->view("tema/index", $viewData);
        }

        
        /******* İLETİŞİM *******/
        public function contact(){
            /******* TANIMLAMALAR *********/
                $this->viewModel = "iletisim";
                $viewData 		= new stdClass();
            /******* TANIMLAMALAR *********/
                
            /******** İŞLEMLER *********/

                //MENU
                $viewData->menu = $menu     = $this->menus_model->getData(
                    array(
                        "is_active"         => 1,
                        "seo_url"           => $this->segment1
                    ),"rank ASC"
                );

                //İLETİŞİM BİLGİLERİ
                $viewData->iletisim      = $this->contact_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "category"      => "Bilgi"
                    ),"rank ASC",5
                );

                //ULAŞIM BİLGİLERİ
                $ulasim           = $this->contact_model->getDataAll(
                    array(
                        "is_active"      => 1,
                        "category"      => "Tab"
                    ),"rank ASC",10
                );

            /******** İŞLEMLER *********/

            /******** GÖNDERİLENLER *********/
                $viewData->ayarlar       		= $this->ayarlar;
                $viewData->sosyalMedyalar 		= $this->sosyalMedyalar;
                $viewData->htmlHeaderMenu 		= $this->htmlHeaderMenu;
                $viewData->viewModel			= $this->viewModel;
            /******** GÖNDERİLENLER *********/
            
		    $this->load->view("tema/index", $viewData);
        
        }

    }
?>