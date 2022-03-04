<?php

	class Admin extends CI_Controller {

		public $viewFolder = "";

		/******* MODULE AİT SABİT VERİLER *******/
		public function __construct(){ 
			parent::__construct();

			if(get_login_user() != false){
				
				$userData 	= get_login_user();
				$url = $this->uri->segment(2);

				if($userData->authority != 0){
					$control = powerControl($url);
					if($control == false){
						redirect(base_url("admin/index"));
					}
				}

				$this->load->helper("text_helper");				
				$this->load->library("form_validation");

				$this->load->model("moduls_model");
				$this->load->model("icons_model");
				$this->load->model("menus_model");
				$this->load->model("users_model");
				$this->load->model("settings_general_model");
				$this->load->model("category_model");
				$this->load->model("slides_model");
				$this->load->model("pages_model");
				$this->load->model("blogs_model");
				$this->load->model("contact_model");
				$this->load->model("inbox_model");
				$this->load->model("terms_model");
				
				//BİLDİRİMLER
				$this->notifications 		= $this->inbox_model->getDataAll(array("durum" => 0),"id ASC",50, "contact_form");

				//SİDEBAR 
				$dataSideMenu 				= $this->moduls_model->getDataAll(array("is_active" => 1),"rank ASC");
				$treeSideMenu 				= treeDraw($dataSideMenu); //Kategori ağaçını oluşturma
				$this->htmlSideMenu 		= treeHtmlDraw($treeSideMenu, $url); //Ağaç verilerini html giydirme.
				$this->htmlMobileSideMenu	= treeMobilHtmlDraw($treeSideMenu, $url); //Ağaç verilerini html giydirme.
				
				
			}

		}

		public function index(){
						
			if(!get_login_user()){
				redirect(base_url("admin/login"));
			}

			/******* TANIMLAMALAR *********/		
				$this->viewFolder = "admin";
				$this->nameModel = "Admin";
				$viewData 		= new stdClass();
			/******* TANIMLAMALAR *********/
				
			/******** İŞLEMLER *********/
			$viewData->data2 			= $this->blogs_model->dataCount();
			$viewData->dataSosyal 		= $this->contact_model->getDataAll(array("category" => "sosyal-medya"),3);

			/******** İŞLEMLER *********/

			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->nameModel 					= $this->nameModel;	
				$viewData->viewDocument 				= "content";
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		
		}

		/******* LOGİN İŞLEMLERİ *******/
		public function login() {

			if(get_login_user()){
				redirect(base_url("admin/index"));
			}

			/******* TANIMLAMALAR *********/
				$this->nameModel 	= "login";
				$viewData 			= new stdClass();
				$metod 				= $this->input->post("metod");
				$this->load->model("users_model");
				$this->load->library("form_validation");
			/******* TANIMLAMALAR *********/

			if($metod == "control"){

				/******** İŞLEMLER *********/
				$this->form_validation->set_rules("user_name","Kullanıcı adı","required|trim");
				$this->form_validation->set_rules("user_password","Şifre","required|trim");
				$this->form_validation->set_message(array( "required" => "{field} alanını boş geçilemez!", ));

				//FORM VALIDATION ÇALIŞTIRMA
				$validate = $this->form_validation->run();

				if($validate){
					
					$user = $this->users_model->getData(
						array(
							"user_name" => $this->input->post("user_name"),
							"password" => md5($this->input->post("user_password")),
							"is_active" => 1
						)
					);
					
					if($user){
						
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Giriş Başarılı.'
						);

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_userdata("user", $user);
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/index"));
						
					}else{
						
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Giriş bilgileriniz hatalı.'
						);

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin"));
					}

				}else{

					/******** GÖNDERİLENLER *********/
						$viewData->nameModel 		= $this->nameModel;
						$viewData->form_error 		= true;
					/******** GÖNDERİLENLER *********/
				}
			}else{

				/******** GÖNDERİLENLER *********/
					$viewData->nameModel 		= $this->nameModel;
					$viewData->form_error 		= true;
				/******** GÖNDERİLENLER *********/
			}
		
			$this->load->view("admin/index", $viewData);
		}

		/******* LOG OUT İŞLEMLERİ *******/
		public function logout(){
			$this->session->unset_userdata("user");
			redirect(base_url("admin"));
		}

		/******* MODÜLLER  **********/
		public function moduls($id = 0){
			
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$userData 			= get_login_user();
				$metod				= $this->uri->segment(3);	
				$this->viewFolder 	= "moduls";
				$this->modelName 	= "moduls_model";
				$this->nameModel 	= "Modüller";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					if($userData->authority == 0){

						//KATEGORİLER
						$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
						$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
						$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

						//İKONLAR
						$dataIcon = $this->icons_model->getDataAll(array("theme" => 0));


						/******** GÖNDERİLENLER *********/
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->dataIcon				= $dataIcon;
							$viewData->viewDocument 		= "add";			
						/******** GÖNDERİLENLER *********/

					}else{

						$alert = array(
							"icon" 	=> "error",
							"title" => 'Yetkisiz işlem yapmaya çalışıyorsunuz.'
						);

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}
					

				}elseif($metod == "save"){

					if($userData->authority == 0){
						
						$this->form_validation->set_rules("title","adı","required|trim");
						$this->form_validation->set_rules("icon","ikon","required|trim");
						$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

						//FORM VALIDATION ÇALIŞTIRMA
						$validate = $this->form_validation->run();

						//VERİ TABANI İŞLEMLERİ
						if($validate){

							//EKLENEN KAYDI EN SON SIRAYA EKLEME
								$dataRank = $this->moduls_model->getDataAll(array(),"rank DESC",1);
								if($dataRank){
									foreach($dataRank as $rows){
										$endRank = $rows->rank+1;
									}
								}else{
									$endRank = 0;
								}
							//EKLENEN KAYDI EN SON SIRAYA EKLEME

							$insert = $this->moduls_model->insertData(

								array(
									"title" 			=> $this->input->post("title"),
									"icon"	 			=> $this->input->post("icon"),
									"ust_id"			=> $this->input->post("ustId"),
									"category"			=> $this->input->post("category"),
									"seo_url" 			=> $this->input->post("seoUrl"),
									"seo_description" 	=> $this->input->post("seoDescription"),
									"seo_keyword"		=> $this->input->post("seoKeyword"),
									"rank" 				=> $endRank,
									"is_active" 		=> 1,
									"creat_date"		=> date("Y-m-d H:i:s"),
									"update_date"		=> date("Y-m-d H:i:s")
								)

							);			

							//İŞLEM SONUCU MESAJLAR
							if($insert){
								$alert = array(
									"icon" 	=> "success",
									"title" => 'Kayıt eklendi.'
								);
							}else{				
								$alert = array(
									"icon" 	=> "error",
									"title" => 'Kayıt eklenirken bir sorun oluştu.'
								);
							}

							//SONUÇLARI SESSION'A GÖNDERME
							$this->session->set_flashdata("alert", $alert);
							redirect(base_url("admin/{$this->viewFolder}"));

						}else{

							//KATEGORİLER
							$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
							$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
							$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.
							
							//İKONLAR
							$dataIcon = $this->icons_model->getDataAll(array("theme" => 0));


							/******** GÖNDERİLENLER *********/
								$viewData->htmlSelectCategory 	= $htmlSelectCategory;
								$viewData->dataIcon				= $dataIcon;
								$viewData->viewDocument 		= "add";
								$viewData->form_error 			= true;
							/******** GÖNDERİLENLER *********/

						}

					}else{

						$alert = array(
							"icon" 	=> "error",
							"title" => 'Yetkisiz işlem yapmaya çalışıyorsunuz.'
						);

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}
					
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//İKONLAR
					$dataIcon = $this->icons_model->getDataAll(array("theme" => 0));
					
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->moduls_model->getData(array("id" => $id));
					
					//KATEGORİLER
					$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $item->ust_id); //Ağaç verilerini html giydirme.

					/******** GÖNDERİLENLER *********/
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->dataIcon				= $dataIcon;
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/
					
				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_rules("icon","ikon","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						$update = $this->moduls_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"icon"	 			=> $this->input->post("icon"),
								"ust_id"			=> $this->input->post("ustId"),
								"category"			=> $this->input->post("category"),
								"seo_url" 			=> $this->input->post("seoUrl"),
								"seo_description" 	=> $this->input->post("seoDescription"),
								"seo_keyword"		=> $this->input->post("seoKeyword"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
						
							//İKONLAR
							$dataIcon = $this->icons_model->getDataAll(array("theme" => 0));

							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->moduls_model->getData(
								array(
									"id" => $id,
								)
							);
							
							//KATEGORİLER
							$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
							$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
							$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $item->ust_id); //Ağaç verilerini html giydirme.

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->dataIcon				= $dataIcon;
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					if($userData->authority == 0){

						/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
						/******* TANIMLAMALAR *********/

						/******** İŞLEMLER *********/

							$delete = $this->moduls_model->deleteData(
								array(
									"id" => $id
								)
							);

						/******** İŞLEMLER *********/

						//İŞLEM SONUCU MESAJLAR
						if($delete){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt silindi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt silinirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						$alert = array(
							"icon" 	=> "error",
							"title" => 'Yetkisiz işlem yapmaya çalışıyorsunuz.'
						);

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}

				}elseif($metod == "subList"){

					$id		= $this->uri->segment(4);

					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->moduls_model->getDataAll(array("ust_id" => $id),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents					= $dataContents;
						$viewData->viewDocument 				= "list";
					/******** GÖNDERİLENLER *********/
						
				}else{

					/******** İŞLEMLER *********/

						//CONTENT
						$dataContents = $this->moduls_model->getDataAll(array("ust_id" => 0),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/

				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* İKONLAR *******/
		public function icons(){
						
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "icons";
				$this->modelName 	= "icons_model";
				$this->nameModel 	= "İkonlar";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					/******** GÖNDERİLENLER *********/
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","başlık","required|trim");
					$this->form_validation->set_rules("icon","ikon","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez."));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						$insert = $this->icons_model->insertData(

							array(
								"title"		=> $this->input->post("title"),
								"icon" 		=> $this->input->post("icon"),
								"theme"		=> $this->input->post("theme")
							)
			
						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						/******** GÖNDERİLENLER *********/
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->icons_model->getData(array("id" => $id));
										
					/******** GÖNDERİLENLER *********/
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/
				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","başlık","required|trim");
					$this->form_validation->set_rules("icon","ikon","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){
						
						$update = $this->icons_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title"		=> $this->input->post("title"),
								"icon" 		=> $this->input->post("icon"),
								"theme"		=> $this->input->post("theme")
							)		
						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
									
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->services_model->getData(array("id" => $id));

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id	= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->icons_model->deleteData(array("id" => $id));

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{
					
					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->icons_model->getDataAll(array());

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
					
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* MENÜLER  **********/
		public function menus($id = 0){
					
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);	
				$this->viewFolder 	= "menus";
				$this->modelName 	= "menus_model";
				$this->nameModel 	= "Menüler";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					//KATEGORİLER
					$dataCategory 			= $this->menus_model->getDataAll(array(),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

					//MODÜLLER
					$moduls 				= $this->moduls_model->getDataAll(
						array(
							"is_active" 	=> 1,
							"home_active"	=> 1
						),"rank ASC");

					/******** GÖNDERİLENLER *********/
						$viewData->moduls 				= $moduls;
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//EKLENEN KAYDI EN SON SIRAYA EKLEME
							$dataRank = $this->menus_model->getDataAll(array(),"rank DESC",1);
							if($dataRank){
								foreach($dataRank as $rows){
									$endRank = $rows->rank+1;
								}
							}else{
								$endRank = 0;
							}
						//EKLENEN KAYDI EN SON SIRAYA EKLEME
						//LİNK OLUŞTURMA
							if($this->input->post("modulUrl") == "index"){
								$link = "";
							}else{
								if($this->input->post("seoUrl") == null) {
									$link = url_convert($this->input->post("title"));
								}else{
									$link = url_convert($this->input->post("seoUrl"));
								}
							}
						//LİNK OLUŞTURMA
						$insert = $this->menus_model->insertData(

							array(
								"title" 			=> $this->input->post("title"),
								"ust_id" 			=> $this->input->post("ustId"),
								"seo_url" 			=> $link,
								"external_url" 		=> $this->input->post("externalUrl"),
								"modul_url" 		=> $this->input->post("modulUrl"),
								"rank" 				=> $endRank,
								"header_active" 	=> 1,
								"is_active" 		=> 1,
								"creat_date"		=> date("Y-m-d H:i:s"),
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						//KATEGORİLER
						$dataCategory 			= $this->menus_model->getDataAll(array(),"rank ASC");
						$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
						$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

						//MODÜLLER
						$moduls 				= $this->moduls_model->getDataAll(
							array(
								"is_active" 		=> 1,
								"home_active"	=> 1
							),"rank ASC");

							
						/******** GÖNDERİLENLER *********/
							$viewData->moduls 				= $moduls;
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->menus_model->getData(
						array(
							"id" => $id
						)
					);
					
					//MODÜLLER
					$moduls 				= $this->moduls_model->getDataAll(
						array(
							"is_active" 		=> 1,
							"home_active"	=> 1
						),"rank ASC");

					//KATEGORİLER
					$dataCategory 			= $this->menus_model->getDataAll(array(),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $item->ust_id); //Ağaç verilerini html giydirme.

					/******** GÖNDERİLENLER *********/
						$viewData->moduls 				= $moduls;
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//LİNK OLUŞTURMA
							if($this->input->post("modulUrl") == "index"){
								$link = "";
							}else{
								if($this->input->post("seoUrl") == null) {
									$link = url_convert($this->input->post("title"));
								}else{
									$link = url_convert($this->input->post("seoUrl"));
								}
							}
						//LİNK OLUŞTURMA
						
						$update = $this->menus_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"ust_id" 			=> $this->input->post("ustId"),
								"seo_url" 			=> $link,
								"external_url" 		=> $this->input->post("externalUrl"),
								"modul_url" 		=> $this->input->post("modulUrl"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/

							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->menus_model->getData(
								array(
									"id" => $id,
								)
							);
							
							//MODÜLLER
							$moduls 				= $this->moduls_model->getDataAll(
								array(
									"is_active" 	=> 1,
									"home_active"	=> 1
								),"rank ASC");
								
							//KATEGORİLER
							$dataCategory 			= $this->menus_model->getDataAll(array(),"rank ASC");
							$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
							$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $item->ust_id); //Ağaç verilerini html giydirme.

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->moduls 				= $moduls;
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
						
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->menus_model->deleteData(
							array(
								"id" => $id
							)
						);

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}elseif($metod == "subList"){

					$id		= $this->uri->segment(4);

					/******** İŞLEMLER *********/
											
						//CONTENT
						$dataContents = $this->menus_model->getDataAll(array("ust_id" => $id),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents					= $dataContents;
						$viewData->viewDocument 				= "list";
					/******** GÖNDERİLENLER *********/
						
				}else{

					/******** İŞLEMLER *********/

						//CONTENT						
						$dataContents = $this->menus_model->getDataAll(array("ust_id" => 0),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* SAYFALAR  **********/
		public function pages($id = 0){
					
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "pages";
				$this->modelName 	= "pages_model";
				$this->nameModel 	= "Sayfalar";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					//KATEGORİLER
					$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

					/******** GÖNDERİLENLER *********/
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//EKLENEN KAYDI EN SON SIRAYA EKLEME
							$dataRank = $this->pages_model->getDataAll(array(),"rank DESC",1);
							if($dataRank){
								foreach($dataRank as $rows){
									$endRank = $rows->rank+1;
								}
							}else{
								$endRank = 0;
							}
						//EKLENEN KAYDI EN SON SIRAYA EKLEME
						$insert = $this->pages_model->insertData(

							array(
								"title" 			=> $this->input->post("title"),
								"template"			=> $this->input->post("template"),
								"short_description" => $this->input->post("shortDescription"),
								"description" 		=> $this->input->post("description"),
								"seo_url" 			=> url_convert($this->input->post("title")),
								"seo_description" 	=> $this->input->post("seoDescription"),
								"seo_keyword"		=> $this->input->post("seoKeyword"),
								"rank" 				=> $endRank,
								"home_active" 		=> 0,
								"is_active" 		=> 1,
								"creat_date"		=> date("Y-m-d H:i:s"),
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						//KATEGORİLER
						$dataCategory 			= $this->moduls_model->getDataAll(array(),"rank ASC");
						$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
						$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

						/******** GÖNDERİLENLER *********/
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->pages_model->getData(
						array(
							"id" => $id
						)
					);
					$imageItem = $this->pages_model->getImageAll(
						array(
							"item_id" => $id
						)
					);

					/******** GÖNDERİLENLER *********/
						$viewData->item 				= $item;
						$viewData->imageItem 			= $imageItem;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/
				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){
						
						$update = $this->pages_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"template"			=> $this->input->post("template"),
								"short_description" => $this->input->post("shortDescription"),
								"description" 		=> $this->input->post("description"),
								"seo_url" 			=> url_convert($this->input->post("title")),
								"seo_description" 	=> $this->input->post("seoDescription"),
								"seo_keyword"		=> $this->input->post("seoKeyword"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/

							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->pages_model->getData(
								array(
									"id" => $id,
								)
							);
							$imageItem = $this->pages_model->getImageAll(
								array(
									"item_id" => $id
								)
							);
						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->imageItem 			= $imageItem;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id	= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->pages_model->deleteData(array("id" => $id));

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{

					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->pages_model->getDataAll(array(),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* BLOGLAR *******/
		public function blogs($id = 0){
							
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "blogs";
				$this->modelName 	= "blogs_model";
				$this->nameModel 	= "Portfölyo";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					//KATEGORİLER
					$dataCategory 			= $this->category_model->getDataAll(array("modul_metod" => "blogs"),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

					/******** GÖNDERİLENLER *********/
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//EKLENEN KAYDI EN SON SIRAYA EKLEME
							$dataRank = $this->blogs_model->getDataAll(array(),"rank DESC",1);
							if($dataRank){
								foreach($dataRank as $rows){
									$endRank = $rows->rank+1;
								}
							}else{
								$endRank = 0;
							}
						//EKLENEN KAYDI EN SON SIRAYA EKLEME
						$insert = $this->blogs_model->insertData(

							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"short_description" => $this->input->post("shortDescription"),
								"description" 		=> $this->input->post("description"),
								"seo_url" 			=> url_convert($this->input->post("title")),
								"seo_description" 	=> $this->input->post("seoDescription"),
								"seo_keyword"		=> $this->input->post("seoKeyword"),
								"rank" 				=> $endRank,
								"home_active" 		=> 0,
								"is_active" 		=> 1,
								"creat_date"		=> date("Y-m-d H:i:s"),
								"update_date"		=> date("Y-m-d H:i:s")
							)
			
						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						//KATEGORİLER
						$dataCategory 			= $this->category_model->getDataAll(array("modul_metod" => "blogs"),"rank ASC");
						$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
						$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

						/******** GÖNDERİLENLER *********/
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->blogs_model->getData(
						array(
							"id" => $id
						)
					);
					$imageItem = $this->blogs_model->getImageAll(
						array(
							"item_id" => $id
						)
					);
					
					//KATEGORİLER
					$dataCategory 			= $this->category_model->getDataAll(array("modul_metod" => "blogs"),"rank ASC");
					$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
					$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $ust_id = null); //Ağaç verilerini html giydirme.
					
					/******** GÖNDERİLENLER *********/
						$viewData->item 				= $item;
						$viewData->imageItem 			= $imageItem;
						$viewData->htmlSelectCategory 	= $htmlSelectCategory;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/
				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){
						
						$update = $this->blogs_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"short_description" => $this->input->post("shortDescription"),
								"description" 		=> $this->input->post("description"),
								"seo_url" 			=> url_convert($this->input->post("seoUrl")),
								"seo_description" 	=> $this->input->post("seoDescription"),
								"seo_keyword"		=> $this->input->post("seoKeyword"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
									
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->blogs_model->getData(
								array(
									"id" => $id
								)
							);
							$imageItem = $this->blogs_model->getImageAll(
								array(
									"item_id" => $id
								)
							);
							
							//KATEGORİLER
							$dataCategory 			= $this->category_model->getDataAll(array("modul_metod" => "blogs"),"rank ASC");
							$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
							$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id, $ust_id = null); //Ağaç verilerini html giydirme.
						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->imageItem 			= $imageItem;
							$viewData->htmlSelectCategory 	= $htmlSelectCategory;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id	= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->blogs_model->deleteData(
							array(
								"id" => $id
							)
						);

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{
						
					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->blogs_model->getDataAll(array(),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
				
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* SLAYTLAR *******/
		public function slides($id = 0){
							
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "slides";
				$this->modelName 	= "slides_model";
				$this->nameModel 	= "Slaytlar";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					/******** GÖNDERİLENLER *********/
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//EKLENEN KAYDI EN SON SIRAYA EKLEME
							$dataRank = $this->slides_model->getDataAll(array(),"rank DESC",1);
							if($dataRank){
								foreach($dataRank as $rows){
									$endRank = $rows->rank+1;
								}
							}else{
								$endRank = 0;
							}
						//EKLENEN KAYDI EN SON SIRAYA EKLEME
						$insert = $this->slides_model->insertData(

							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"link1" 			=> $this->input->post("link1"),
								"description" 		=> $this->input->post("description"),
								"rank" 				=> $endRank,
								"is_active" 		=> 1,
								"creat_date"		=> date("Y-m-d H:i:s"),
								"update_date"		=> date("Y-m-d H:i:s")
							)
		
			
						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						/******** GÖNDERİLENLER *********/
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->slides_model->getData(
						array(
							"id" => $id
						)
					);
					$imageItem = $this->slides_model->getImageAll(
						array(
							"item_id" => $id
						)
					);
					
					/******** GÖNDERİLENLER *********/
						$viewData->item 				= $item;
						$viewData->imageItem 			= $imageItem;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){
						
						$update = $this->slides_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"link1" 			=> $this->input->post("link1"),
								"description" 		=> $this->input->post("description"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
									
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->slides_model->getData(
								array(
									"id" => $id
								)
							);
							$imageItem = $this->slides_model->getImageAll(
								array(
									"item_id" => $id
								)
							);

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->imageItem 			= $imageItem;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id	= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->slides_model->deleteData(
							array(
								"id" => $id
							)
						);

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{
					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->slides_model->getDataAll(array(),"rank ASC",10);

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents					= $dataContents;
						$viewData->viewDocument 				= "list";
					/******** GÖNDERİLENLER *********/
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* KATEGORİLER *******/
		public function category(){

			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$modul				= $this->uri->segment(4);
				$this->uri->segment(5) ? $id = $this->uri->segment(5) : $id = 0; 
				$this->viewFolder 	= "category";
				$this->modelName 	= "category_model";
				$this->nameModel 	= "Kategoriler";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

			if($metod == "add"){
				
				//KATEGORİLER
				$dataCategory 			= $this->category_model->getDataAll(array(),"rank ASC");
				$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
				$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

				/******** GÖNDERİLENLER *********/
					$viewData->modul				= $modul;	
					$viewData->htmlSelectCategory 	= $htmlSelectCategory;
					$viewData->viewDocument 		= "add";
				/******** GÖNDERİLENLER *********/
				
			}elseif($metod == "save"){
				
				/******** İŞLEMLER *********/
				$this->form_validation->set_rules("title","Başlık","required|trim");
				$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

				//FORM VALIDATION ÇALIŞTIRMA
				$validate = $this->form_validation->run();

				//VERİ TABANI İŞLEMLERİ
				if($validate){
								
					//EKLENEN KAYDI EN SON SIRAYA EKLEME
						$dataRank = $this->category_model->getDataAll(array(),"rank DESC",1);
						if($dataRank){
							foreach($dataRank as $rows){
								$endRank = $rows->rank+1;
							}
						}else{
							$endRank = 0;
						}
					//EKLENEN KAYDI EN SON SIRAYA EKLEME

					$insert = $this->category_model->insertData(

						array(
							"title" 			=> $this->input->post("title"),
							"ust_id" 			=> $this->input->post("ustId"),
							"modul_metod" 		=> $this->input->post("modul_metod"),
							"seo_url" 			=> url_convert($this->input->post("seoUrl")),
							"rank" 				=> $endRank,
							"home_active" 		=> 0,
							"is_active" 		=> 1,
							"creat_date"		=> date("Y-m-d H:i:s"),
							"update_date"		=> date("Y-m-d H:i:s")
						)

					);	
					

					//İŞLEM SONUCU MESAJLAR
					if($insert){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt eklendi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt eklenirken bir sorun oluştu.'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME 
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}/{$this->input->post("modul_metod")}"));
				}else{

					//CONTENT
					$dataContents = $this->category_model->getDataAll(
						array(
							"ust_id" 		=> $id,
							"modul_metod" 	=> $modul
						),"rank ASC"
					);

					/******** GÖNDERİLENLER *********/
						$viewData->modul			= $modul;
						$viewData->dataContents		= $dataContents;
						$viewData->viewDocument 	= "add";
						$viewData->form_error 		= true;
					/******** GÖNDERİLENLER *********/
				}
				
			}elseif($metod == "edit"){

				//CONTENT
				$item = $this->category_model->getData(
					array(
						"id" 		=> $id
					),"rank ASC"
				);
				
				//KATEGORİLER
				$dataCategory 			= $this->category_model->getDataAll(array(),"rank ASC");
				$treeSelectCategory 	= treeDraw($dataCategory); //Kategori ağaçını oluşturma
				$htmlSelectCategory		= treeSelectHtmlDraw($treeSelectCategory, $id = null, $ust_id = null); //Ağaç verilerini html giydirme.

				/******** GÖNDERİLENLER *********/
					$viewData->modul			= $modul;
					$viewData->item				= $item;
					$viewData->htmlSelectCategory 	= $htmlSelectCategory;	
					$viewData->viewDocument 	= "update";
				/******** GÖNDERİLENLER *********/
			}elseif($metod == "update"){

				/******** İŞLEMLER *********/
				$this->form_validation->set_rules("title","Başlık","required|trim");
				$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

				//FORM VALIDATION ÇALIŞTIRMA
				$validate = $this->form_validation->run();

				//VERİ TABANI İŞLEMLERİ
				if($validate){
								
					$update = $this->category_model->updateData(
						array(
							"id" => $id
						),
						array(
							"title" 			=> $this->input->post("title"),
							"ust_id" 			=> $this->input->post("ustId"),
							"seo_url" 			=> url_convert($this->input->post("seoUrl")),
							"is_active" 		=> 1,
							"update_date"		=> date("Y-m-d H:i:s")
						)

					);			

					//İŞLEM SONUCU MESAJLAR
					if($update){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt güncelledi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt güncellenirken bir sorun oluştu.'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME 
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}/edit/{$modul}/{$id}"));
				}else{

					//CONTENT
					$dataContents = $this->category_model->getDataAll(
						array(
							"ust_id" 		=> $id,
							"modul_metod" 	=> $modul
						),"rank ASC"
					);

					/******** GÖNDERİLENLER *********/
						$viewData->modul			= $modul;
						$viewData->dataContents		= $dataContents;
						$viewData->viewDocument 	= "add";
						$viewData->form_error 		= true;
					/******** GÖNDERİLENLER *********/
				}

			}elseif($metod == "delete"){

				/******** İŞLEMLER *********/
					$delete = $this->category_model->deleteData(
						array(
							"id" => $id
						)
					);		
				/******** İŞLEMLER *********/
				
				//İŞLEM SONUCU MESAJLAR
				if($delete){
					$alert = array(
						"icon" 	=> "success",
						"title" => 'Kayıt silindi.'
					);
				}else{				
					$alert = array(
						"icon" 	=> "error",
						"title" => 'Kayıt silinirken bir sorun oluştu!'
					);
				}

				//SONUÇLARI SESSION'A GÖNDERME 
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("admin/{$this->viewFolder}/{$modul}"));

			}elseif($metod == "subList"){
				
				$id		= $this->uri->segment(5);

				/******** İŞLEMLER *********/
					
					//CONTENT
					$dataContents = $this->category_model->getDataAll(
						array(
							"ust_id" 		=> $id,
							"modul_metod" 	=> $modul
						),"rank ASC"
					);

				/******** İŞLEMLER *********/
				
				/******** GÖNDERİLENLER *********/
					$viewData->modul						= $modul;
					$viewData->dataContents					= $dataContents;
					$viewData->viewDocument 				= "list";
				/******** GÖNDERİLENLER *********/
				
			}else{
				
				/******** İŞLEMLER *********/

					//CONTENT
					$dataContents = $this->category_model->getDataAll(
						array(
							"ust_id" 		=> $id,
							"modul_metod" 	=> $metod
						),"rank ASC",
					);

				/******** İŞLEMLER *********/

				/******** GÖNDERİLENLER *********/
					$viewData->modul						= $metod;
					$viewData->dataContents					= $dataContents;
					$viewData->viewDocument 				= "list";
				/******** GÖNDERİLENLER *********/
			}

			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* İLETİŞİM  **********/
		public function contact($id = 0){
				
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);	
				$this->viewFolder 	= "contact";
				$this->modelName 	= "contact_model";
				$this->nameModel 	= "İletişim Bilgileri";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){
					
					//İKONLAR
					$dataIcon = $this->icons_model->getDataAll(array("theme" => 1));


					/******** GÖNDERİLENLER *********/
						$viewData->dataIcon				= $dataIcon;
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_message(array("required" => "İçerik {field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						//EKLENEN KAYDI EN SON SIRAYA EKLEME
							$dataRank = $this->contact_model->getDataAll(array(),"rank DESC",1);
							if($dataRank){
								foreach($dataRank as $rows){
									$endRank = $rows->rank+1;
								}
							}else{
								$endRank = 0;
							}
						//EKLENEN KAYDI EN SON SIRAYA EKLEME

						$insert = $this->contact_model->insertData(

							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"icon" 				=> $this->input->post("icon"),
								"link" 				=> $this->input->post("link"),
								"description" 		=> $this->input->post("description"),
								"rank" 				=> $endRank,
								"home_active" 		=> 0,
								"is_active" 		=> 1,
								"creat_date"		=> date("Y-m-d H:i:s"),
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{
						
						//İKONLAR
						$dataIcon = $this->moduls_model->getIconsData(array());

						/******** GÖNDERİLENLER *********/
							$viewData->dataIcon				= $dataIcon;
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//İKONLAR
					$dataIcon = $this->icons_model->getDataAll(array("theme" => 1));
					
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->contact_model->getData(
						array(
							"id" => $id
						)
					);
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataIcon				= $dataIcon;
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						$update = $this->contact_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"title" 			=> $this->input->post("title"),
								"category"			=> $this->input->post("category"),
								"icon" 				=> $this->input->post("icon"),
								"link" 				=> $this->input->post("link"),
								"description" 		=> $this->input->post("description"),
								"is_active" 		=> 1,
								"update_date"		=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
						
							//İKONLAR
							$dataIcon = $this->moduls_model->getIconsData(array());

							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->contact_model->getData(
								array(
									"id" => $id,
								)
							);

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->dataIcon				= $dataIcon;
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->contact_model->deleteData(array("id" => $id));

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{
								
					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->contact_model->getDataAll(array(),"rank ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
				
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}
		
		/******* KULLANICILAR *******/
		public function users($id = 0){
							
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$userData 			= get_login_user();
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "users";
				$this->modelName 	= "users_model";
				$this->nameModel 	= "Kullanıcılar";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					/******** GÖNDERİLENLER *********/
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("user_name","Kullanıcı adı","required|trim|is_unique[users.user_name]");
					$this->form_validation->set_rules("full_name","Ad Soyad","required|trim");
					$this->form_validation->set_rules("email","E-posta","required|trim|valid_email|is_unique[users.email]");
					$this->form_validation->set_rules("password","Şifre","required|trim|min_length[4]|max_length[16]");
					$this->form_validation->set_rules("password_control","şifre","required|trim|min_length[4]|max_length[16]|matches[password]");
					$this->form_validation->set_message(
						array(
							"required" => "{field} alanını boş geçilemez!",
							"is_unique" => "{field} alanı daha önce kullanılmış!",
							"valid_email" => "Lütfen geçerli bir {field} alanı giriniz.",
							"matches" => "{field} aynı olmak zorunda.",
						)
					);

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						
						if($this->input->post("authority") == 0){

							if($userData->authority != 0){

								//İŞLEM SONUCU MESAJLAR				
								$alert = array(
									"icon" 	=> "error",
									"title" => 'Yetkisiz İşlem Yapmaya Çalışıyorsunuz!'
								);
								
								//SONUÇLARI SESSION'A GÖNDERME
								$this->session->set_flashdata("alert", $alert);
								redirect(base_url("admin/{$this->viewFolder}"));
								
							}else{

								/** YETKİ ŞABLONLARI **/
								$yetkiler = '{"giris":{"read":"on"},"projeler":{"read":"on"},"slayt":{"read":"on"},"menuler":{"read":"on"},"hizmetler":{"read":"on"},"hizmet-listesi":{"read":"on"},"hizmet-kategorileri":{"read":"on"},"cozumler":{"read":"on"},"cozum-listesi":{"read":"on"},"cozum-kategorileri":{"read":"on"},"sss":{"read":"on"},"iletisim-bilgileri":{"read":"on"},"gelen-kutusu":{"read":"on"},"kullanicilar":{"read":"on"},"dosya-yoneticisi":{"read":"on"},"istatistikler":{"read":"on"},"panel-loglari":{"read":"on"},"site-loglari":{"read":"on"},"site-ayarlari":{"read":"on"},"genel-ayarlar":{"read":"on"},"terimler":{"read":"on"},"dil":{"read":"on"},"panel-ayarlari":{"read":"on"},"moduller":{"read":"on"},"cikis-yap":{"read":"on"}}';
								/** YETKİ ŞABLONLARI **/

								$insert = $this->users_model->insertData(

									array(
										"img_url" 		=> $this->input->post("img_url"),
										"user_name" 	=> $this->input->post("user_name"),
										"full_name"		=> $this->input->post("full_name"),
										"email" 		=> $this->input->post("email"),
										"password" 		=> md5($this->input->post("password")),
										"authority" 	=> 0,
										"power"		 	=> $yetkiler,
										"is_active" 	=> 1,
										"creat_date"	=> date("Y-m-d H:i:s")
									)		
					
								);
								
							}
						}else{

							/** YETKİ ŞABLONLARI **/
							$yetkiler = '{"giris":{"read":"on"},"projeler":{"read":"on"},"slayt":{"read":"on"},"menuler":{"read":"on"},"hizmetler":{"read":"on"},"hizmet-listesi":{"read":"on"},"hizmet-kategorileri":{"read":"on"},"cozumler":{"read":"on"},"cozum-listesi":{"read":"on"},"cozum-kategorileri":{"read":"on"},"sss":{"read":"on"},"iletisim-bilgileri":{"read":"on"},"gelen-kutusu":{"read":"on"},"dosya-yoneticisi":{"read":"on"},"istatistikler":{"read":"on"},"panel-loglari":{"read":"on"},"site-loglari":{"read":"on"},"site-ayarlari":{"read":"on"},"genel-ayarlar":{"read":"on"},"terimler":{"read":"on"},"dil":{"read":"on"},"cikis-yap":{"read":"on"}}';
							/** YETKİ ŞABLONLARI **/
							
							$insert = $this->users_model->insertData(

								array(
									"img_url" 		=> $this->input->post("img_url"),
									"user_name" 	=> $this->input->post("user_name"),
									"full_name"		=> $this->input->post("full_name"),
									"email" 		=> $this->input->post("email"),
									"password" 		=> md5($this->input->post("password")),
									"authority" 	=> $this->input->post("authority"),
									"power"		 	=> $yetkiler,
									"is_active" 	=> 1,
									"creat_date"	=> date("Y-m-d H:i:s")
								)		
				
							);

						}				
									

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						/******** GÖNDERİLENLER *********/
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$control = $this->users_model->getData(array("id" => $id));

					if($userData->authority != 0){
						
						if($userData->authority != $control->authority){

							//İŞLEM SONUCU MESAJLAR				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Yetkisiz İşlem Yapmaya Çalışıyorsunuz!'
							);
							
							//SONUÇLARI SESSION'A GÖNDERME
							$this->session->set_flashdata("alert", $alert);
							redirect(base_url("admin/{$this->viewFolder}"));

						}else{

							$item = $this->users_model->getData(array("id" => $id));
							
						}
					}else{
						
						$item = $this->users_model->getData(array("id" => $id));
					}

					//MODÜLLER
					$moduller				= $this->moduls_model->getDataAll(array(),"rank ASC" );
					$treePowerMenu 			= treeDraw($moduller); //Kategori ağaçını oluşturma
					$htmlPowerMenu		 	= treePowerDraw($treePowerMenu, $item->power); //Ağaç verilerini html giydirme.

					/******** GÖNDERİLENLER *********/
						$viewData->htmlPowerMenu 		= $htmlPowerMenu;
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "profilUpdate"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$dataControl = $this->users_model->getData(
						array("id" => $id,)
					);

					if($dataControl->user_name != $this->input->post("user_name")) {
						$this->form_validation->set_rules("user_name","Kullanıcı adı","required|trim|is_unique[users.user_name]");
					}
					if($dataControl->email != $this->input->post("email")) {
						$this->form_validation->set_rules("email","E-posta","required|trim|valid_email|is_unique[users.email]");
					}

					$this->form_validation->set_rules("full_name","Ad Soyad","required|trim");
					$this->form_validation->set_message(
						array(
							"required" => "{field} alanını boş geçilemez!",
							"is_unique" => "{field} alanı daha önce kullanılmış!",
							"valid_email" => "Lütfen geçerli bir {field} alanı giriniz.",
						)
					);

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();
					/******** İŞLEMLER *********/

					if($validate){

						if($this->input->post("authority") == 0){

							if($userData->authority != 0){

								//İŞLEM SONUCU MESAJLAR				
								$alert = array(
									"icon" 	=> "error",
									"title" => 'Yetkisiz İşlem Yapmaya Çalışıyorsunuz!'
								);
								
								//SONUÇLARI SESSION'A GÖNDERME
								$this->session->set_flashdata("alert", $alert);
								redirect(base_url("admin/{$this->viewFolder}"));
								
							}else{

								$update = $this->users_model->updateData(
									array (
										"id" => $id
									), 
									array(
										"user_name" 	=> $this->input->post("user_name"),
										"full_name"		=> $this->input->post("full_name"),
										"email" 		=> $this->input->post("email"),
										"authority" 	=> 0,
										"update_date" 	=> date("Y-m-d H:i:s")
									)
								);
							}

						}else{

							$update = $this->users_model->updateData(
								array (
									"id" => $id
								), 
								array(
									"user_name" 	=> $this->input->post("user_name"),
									"full_name"		=> $this->input->post("full_name"),
									"email" 		=> $this->input->post("email"),
									"authority" 	=> $this->input->post("authority"),
									"update_date" 	=> date("Y-m-d H:i:s")
								)
							);

						}
		
						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}
		
						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));
		
					}else{

						/******** İŞLEMLER *********/
		
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->users_model->getData(array("id" => $id));
		
						/******** İŞLEMLER *********/
		
						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
						
							$this->load->view("admin/index", $viewData);
					}
					

				}elseif($metod == "passUpdate"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					$this->form_validation->set_rules("password","Şifre","required|trim|min_length[4]|max_length[16]");
					$this->form_validation->set_rules("password_control","şifre","required|trim|min_length[4]|max_length[16]|matches[password]");
					$this->form_validation->set_message(
						array(
							"required" => "{field} alanını boş geçilemez!",
							"matches" => "{field} aynı olmak zorunda.",
						)
					);

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();
					/******** İŞLEMLER *********/
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$control = $this->users_model->getData(array("id" => $id));

					if($validate){

						if($control->authority == 0){

							if($userData->authority != 0){
								
								//İŞLEM SONUCU MESAJLAR				
								$alert = array(
									"icon" 	=> "error",
									"title" => 'Yetkisiz İşlem Yapmaya Çalışıyorsunuz!'
								);
								
								//SONUÇLARI SESSION'A GÖNDERME
								$this->session->set_flashdata("alert", $alert);
								redirect(base_url("admin/{$this->viewFolder}"));

							}else{

								$update = $this->users_model->updateData(
									array ("id" => $id), 
									array(
										"password" 		=> md5($this->input->post("password")),
										"update_date" 	=> date("Y-m-d H:i:s")
									)
								);
							}

						}else{

							$update = $this->users_model->updateData(
								array ("id" => $id), 
								array(
									"password" 		=> md5($this->input->post("password")),
									"update_date" 	=> date("Y-m-d H:i:s")
								)
							);

						}
						
						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}
		
						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));
		
					}else{
							
						/******** İŞLEMLER *********/
		
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->users_model->getData(
								array(
									"id" => $id,
								)
							);
		
						/******** İŞLEMLER *********/
		
						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
						
							$this->load->view("admin/index", $viewData);
					}
					

				}elseif($metod == "yetkiUpdate"){
					
					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					$yetkiler = json_encode($this->input->post("yetkiler"));

					$update = $this->users_model->updateData(
						array (
							"id" => $id
						), 
						array(
							"power" 		=> $yetkiler,
							"update_date" 	=> date("Y-m-d H:i:s")
						)
					);
	
					//İŞLEM SONUCU MESAJLAR
					if($update){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt güncellendi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt güncellenirken bir sorun oluştu!'
						);
					}
	
					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));

				}elseif($metod == "delete"){

					if($userData->authority == 0){

						/******* TANIMLAMALAR *********/
						$id	= $this->uri->segment(4);
						/******* TANIMLAMALAR *********/

						/******** İŞLEMLER *********/

							$delete = $this->users_model->deleteData(array("id" => $id));

						/******** İŞLEMLER *********/

						//İŞLEM SONUCU MESAJLAR
						if($delete){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt silindi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt silinirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						//İŞLEM SONUCU MESAJLAR				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Yetkisiz İşlem Yapmaya Çalışıyorsunuz!'
						);
						
						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}

				}else{

					/******** İŞLEMLER *********/

					if($userData->authority == 0){
						//CONTENT
						$dataContents = $this->users_model->getDataAll(array(),"id ASC");
					}else{
						//CONTENT
						$dataContents = $this->users_model->getDataAll(array("authority !=" => 0 ),"id ASC");
					}

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents					= $dataContents;
						$viewData->viewDocument 				= "list";
					/******** GÖNDERİLENLER *********/

				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* GENEL AYARLAR *******/
		public function settingsgeneral($id = 0){
							
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);
				$this->viewFolder 	= "settingsgeneral";
				$this->modelName 	= "settings_general_model";
				$this->nameModel 	= "Genel Ayarlar";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "save"){

					$insert = $this->settings_general_model->insertData(

						array(
							"title" 			=> $this->input->post("title"),
							"tema" 				=> $this->input->post("tema"),
							"slogan" 			=> $this->input->post("slogan"),
							"link"				=> $this->input->post("link"),
							"copyright"			=> $this->input->post("copyright"),
							"logo"				=> "logo.png",
							"logo2"				=> "footer-logo.png",
							"seo_description" 	=> $this->input->post("seoDescription"),
							"seo_keyword"		=> $this->input->post("seoKeyword"),
							"smtp_protocol"		=> $this->input->post("smtpProtocol"),
							"smtp_sunucu"		=> $this->input->post("smtpSunucu"),
							"smtp_port"			=> $this->input->post("smtpPort"),
							"smtp_eposta"		=> $this->input->post("smtpEposta"),
							"smtp_sifre"		=> $this->input->post("smtpSifre"),
							"head_script"		=> $this->input->post("headScript"),
							"footer_script"		=> $this->input->post("footerScript"),
							"creat_date"			=> date("Y-m-d H:i:s"),
							"update_date"		=> date("Y-m-d H:i:s")
						)
		
					);
					
					//CONTENT
					$item = $this->settings_general_model->getData(array());

					//İŞLEM SONUCU MESAJLAR
					if($insert){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt eklendi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt eklenirken bir sorun oluştu.'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME 
					$this->session->set_flashdata("alert", $alert);

				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					$update = $this->settings_general_model->updateData(
						array (
							"id" 		=> $id
						),
						array(
							"title" 			=> $this->input->post("title"),
							"tema" 				=> $this->input->post("tema"),
							"slogan" 			=> $this->input->post("slogan"),
							"link"				=> $this->input->post("link"),
							"copyright"			=> $this->input->post("copyright"),
							"seo_description" 	=> $this->input->post("seoDescription"),
							"seo_keyword"		=> $this->input->post("seoKeyword"),
							"smtp_protocol"		=> $this->input->post("smtpProtocol"),
							"smtp_sunucu"		=> $this->input->post("smtpSunucu"),
							"smtp_port"			=> $this->input->post("smtpPort"),
							"smtp_eposta"		=> $this->input->post("smtpEposta"),
							"smtp_sifre"		=> $this->input->post("smtpSifre"),
							"head_script"		=> $this->input->post("headScript"),
							"footer_script"		=> $this->input->post("footerScript"),
							"update_date"		=> date("Y-m-d H:i:s")
						)
		
					);
					
					//CONTENT
					$item = $this->settings_general_model->getData(array());

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($update){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt güncellendi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt güncellenirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME 
					$this->session->set_flashdata("alert", $alert);
					
				}elseif($metod == "logoUpload"){

					/******* LOGO YÜKLEME ******/
					$id		=	$this->uri->segment(4);
					$metod	=	$this->uri->segment(5);

					$fileName		= url_convert(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME));
					$exten			= pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
					$fileNamefull	= $fileName.".".$exten;

					$config["allowed_types"] = "jpeg|jpg|png|svg";
					$config["upload_path"] = "upload/settings/";
					$config["file_name"] = $fileNamefull;

					$this->load->library("upload", $config);

					$upload = $this->upload->do_upload("file");

					if($upload){

						$file = $this->upload->data("file_name");

						$this->settings_general_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								$metod			=> $file,
								"update_date"	=> date("Y-m-d H.i:s")
							)
						);
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Dosya güncellendi.'
						);
						
					}else{
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Dosya güncellenirken bir sorun oluştu!'
						);
					}
					
					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));

				}elseif($metod == "logoDelete"){

					/******* LOGO SİLME ******/
					$id		=	$this->uri->segment(4);
					$metod	=	$this->uri->segment(5);

					$img = $this->settings_general_model->getData(array("id" => $id));
		
					$delete = $this->settings_general_model->updateData(
						array (
							"id" 		=> $id
						),
						array(
							$metod			=> "logo.png",
							"update_date"	=> date("Y-m-d H.i:s")
						)
					);
		
					//İŞLEM SONUCU MESAJLAR
					if($delete){
						
						unlink("upload/settings/".$img->$metod);
						
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Dosya silindi.'
						);
		
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Dosya silinirken bir sorun oluştu!'
						);
					}
					
					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));	
					
				}else{
					/******** İŞLEMLER *********/
						
					//CONTENT
					$item = $this->settings_general_model->getData(array());

					/******** İŞLEMLER *********/
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;			
				$viewData->item							= $item;
				$viewData->viewDocument					= "content";
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* GELEN KUTUSU  **********/
		public function inbox(){
				
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);	
				$this->viewFolder 	= "inbox";
				$this->modelName 	= "inbox_model";
				$this->nameModel 	= "Gelen Kutusu";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == null){

					/******** İŞLEMLER *********/					
						//CONTENT
						$dataContents = $this->inbox_model->getDataAll(array(),"id DESC",50, "contact_form");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents		= $dataContents;
						$viewData->nameForm			= "contact_form";
						$viewData->viewDocument 	= "content";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "view"){

					/******* TANIMLAMALAR *********/
						$id			= $this->uri->segment(4);
						$table		= $this->uri->segment(5);
					/******* TANIMLAMALAR *********/
					
					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->inbox_model->getData(
						array(
							"id" => $id
						), $table
					);

					$this->inbox_model->updateData(
						array(
							"id" => $id
						),
						array(
							"durum" => 1
						), $table
					);

					/******** GÖNDERİLENLER *********/
					$viewData->item 			= $item;
					$viewData->nameForm			= $table;
					$viewData->viewDocument 	= "view";			
					/******** GÖNDERİLENLER *********/
					
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
						$id			= $this->uri->segment(4);
						$table		= $this->uri->segment(5);
						/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/
						$delete = $this->inbox_model->deleteData(
							array(
								"id" => $id
							), $table
						);
						/******** İŞLEMLER *********/
						
						//İŞLEM SONUCU MESAJLAR
						if($delete){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt silindi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt silinirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/{$table}"));	
					
				}else{			
					
					//CONTENT
					$dataContents = $this->inbox_model->getDataAll(array(),"id DESC",50, $metod);


					/******** GÖNDERİLENLER *********/
					$viewData->dataContents		= $dataContents;
					$viewData->nameForm			= $metod;
					$viewData->viewDocument 	= "content";			
					/******** GÖNDERİLENLER *********/
				}
			
			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* TERİMLER  **********/
		public function terms(){
			/******* TANIMLAMALAR *********/
				if(!get_login_user()){redirect(base_url("admin/login"));}
				$metod				= $this->uri->segment(3);	
				$this->viewFolder 	= "terms";
				$this->modelName 	= "terms_model";
				$this->nameModel 	= "Terimler";
				$viewData 			= new stdClass();
			/******* TANIMLAMALAR *********/

				if($metod == "add"){

					/******** GÖNDERİLENLER *********/
						$viewData->viewDocument 		= "add";			
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "save"){

					$this->form_validation->set_rules("title","adı","required|trim");
					$this->form_validation->set_rules("metod","metod","required|trim|is_unique[terms.metod]");
					$this->form_validation->set_message(
						array(
							"required" => "İçerik {field} alanını boş geçilemez.",
							"is_unique" => "İçerik {field} alanını benzersiz olmalıdır."
						)
					);

					//FORM VALIDATION ÇALIŞTIRMA
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){

						$insert = $this->terms_model->insertData(

							array(
								"text" 			=> $this->input->post("title"),
								"metod" 		=> $this->input->post("metod"),
								"theme" 		=> $this->input->post("theme"),
								"creat_date"	=> date("Y-m-d H:i:s"),
								"update_date"	=> date("Y-m-d H:i:s")
							)		
			
						);			

						//İŞLEM SONUCU MESAJLAR
						if($insert){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt eklendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt eklenirken bir sorun oluştu.'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}"));

					}else{

						/******** GÖNDERİLENLER *********/
							$viewData->viewDocument 		= "add";
							$viewData->form_error 			= true;
						/******** GÖNDERİLENLER *********/

					}
				}elseif($metod == "edit"){

					/******* TANIMLAMALAR *********/
					$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
					$item = $this->terms_model->getData(array("id" => $id));
					
					/******** GÖNDERİLENLER *********/
						$viewData->item 				= $item;
						$viewData->viewDocument 		= "update";
					/******** GÖNDERİLENLER *********/

				}elseif($metod == "update"){

					/******* TANIMLAMALAR *********/
						$id				= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/
					
					$this->form_validation->set_rules("title","Başlık","required|trim");
					$this->form_validation->set_message(array("required" => "{field} alanını boş geçilemez"));

					//FORM VALIDATION ÇALIŞTIRMA.
					$validate = $this->form_validation->run();

					//VERİ TABANI İŞLEMLERİ
					if($validate){
						
						$update = $this->terms_model->updateData(
							array (
								"id" 		=> $id
							),
							array(
								"text" 			=> $this->input->post("title"),
								"metod" 		=> $this->input->post("metod"),
								"theme" 		=> $this->input->post("theme"),
								"update_date"	=> date("Y-m-d H:i:s")
							)

						);

						//İŞLEM SONUCU MESAJLAR
						if($update){
							$alert = array(
								"icon" 	=> "success",
								"title" => 'Kayıt güncellendi.'
							);
						}else{				
							$alert = array(
								"icon" 	=> "error",
								"title" => 'Kayıt güncellenirken bir sorun oluştu!'
							);
						}

						//SONUÇLARI SESSION'A GÖNDERME
						$this->session->set_flashdata("alert", $alert);
						redirect(base_url("admin/{$this->viewFolder}/edit/{$id}"));

					}else{
						/******** İŞLEMLER *********/
									
							//GELEN ID'YE GÖRE VERİLERİ ÇAĞIRMA
							$item = $this->terms_model->getData(array("id" => $id));

						/******** İŞLEMLER *********/

						/******** GÖNDERİLENLER *********/
							$viewData->item 				= $item;
							$viewData->form_error 			= true;
							$viewData->viewDocument 		= "update";
						/******** GÖNDERİLENLER *********/
					}
				}elseif($metod == "delete"){

					/******* TANIMLAMALAR *********/
					$id	= $this->uri->segment(4);
					/******* TANIMLAMALAR *********/

					/******** İŞLEMLER *********/

						$delete = $this->terms_model->deleteData(
							array(
								"id" => $id
							)
						);

					/******** İŞLEMLER *********/

					//İŞLEM SONUCU MESAJLAR
					if($delete){
						$alert = array(
							"icon" 	=> "success",
							"title" => 'Kayıt silindi.'
						);
					}else{				
						$alert = array(
							"icon" 	=> "error",
							"title" => 'Kayıt silinirken bir sorun oluştu!'
						);
					}

					//SONUÇLARI SESSION'A GÖNDERME
					$this->session->set_flashdata("alert", $alert);
					redirect(base_url("admin/{$this->viewFolder}"));
						
				}else{
							
					/******** İŞLEMLER *********/
						
						//CONTENT
						$dataContents = $this->terms_model->getDataAll(array(),"id ASC");

					/******** İŞLEMLER *********/
					
					/******** GÖNDERİLENLER *********/
						$viewData->dataContents				= $dataContents;
						$viewData->viewDocument 			= "list";
					/******** GÖNDERİLENLER *********/
				
				}

			/******** GÖNDERİLENLER *********/
				$viewData->notifications 				= $this->notifications;
				$viewData->htmlSideMenu 				= $this->htmlSideMenu;
				$viewData->htmlMobileSideMenu 			= $this->htmlMobileSideMenu;
				$viewData->viewFolder					= $this->viewFolder;
				$viewData->modelName					= $this->modelName;
				$viewData->nameModel 					= $this->nameModel;
			/******** GÖNDERİLENLER *********/

			$this->load->view("admin/index", $viewData);
		}

		/******* İÇERİK AKTİF/PASİF *******/
		public function dataActive($id, $model, $metod){
			
			$this->load->model($model);

			if($id){
				$active = ($this->input->post("data_checked") === "true") ? 1 : 0;

				$this->$model->updateData(
					array(
						"id" => $id
					),
					array (
						$metod => $active
					)
				);
			}
		}
		
		/******* GÖRSEL AKTİF/PASİF *******/
		public function dataImgActive($id, $model, $metod){
			$this->load->model($model);

			if($id){
				$active = ($this->input->post("data_checked") === "true") ? 1 : 0;

				$this->$model->updateImage(
					array(
						"id" => $id
					),
					array (
						$metod => $active
					)
				);
			}
		}

		/******* İÇERİK SIRALAMA *******/
		public function orderUpdate($model){
			
			$this->load->model($model);
				
			$data = $this->input->post("data");
			parse_str($data, $order);
			$items = $order["ord"];

			foreach($items as $rank => $id){
				$this->$model->updateData(
					array(
						"id"	=> $id
					),
					array (
						"rank"	=> $rank
					)
				);
			}

		}
		
		/******* İÇERİK RESİM YÜKLEME *******/
		public function imageUpload($id, $viewFolder, $model) {	

			$this->load->model($model);

			$fileName		= url_convert(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME));
			$exten			= pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
			$fileNamefull	= $fileName.".".$exten;

			$config["allowed_types"] = "jpeg|jpg|png|svg";
			$config["upload_path"] = "upload/{$viewFolder}/";
			$config["file_name"] = $fileNamefull;

			$this->load->library("upload", $config);

			$upload = $this->upload->do_upload("file");

			if($upload){
				$file = $this->upload->data("file_name");

				$this->$model->insertImage(
					array(
						"item_id"		=> $id,
						"img_url"		=> $file,
						"rank"			=> 0,
						"is_active"		=> 1,
						"creat_date"	=> date("Y-m-d H.i:s")
					)
				);
				
			}
		}
		
		/******* İÇERİK RESİM SİLME *******/
		public function imageDelete($id, $viewFolder, $model){

			$this->load->model($model);

			$img = $this->$model->getImage(
				array(
					"id" => $id
				)
			);

			$delete = $this->$model->deleteImage(
				array(
					"id" => $id
				)
			);

			//İŞLEM SONUCU MESAJLAR
			if($delete){
				
				unlink("upload/{$viewFolder}/".$img->img_url);
				
				$alert = array(
					"icon" 	=> "success",
					"title" => 'Kayıt silindi.'
				);
			}else{				
				$alert = array(
					"icon" 	=> "error",
					"title" => 'Kayıt silinirken bir sorun oluştu!'
				);
			}

			//SONUÇLARI SESSION'A GÖNDERME
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("admin/{$viewFolder}/edit/$img->item_id"));	
		}	
	}
?>