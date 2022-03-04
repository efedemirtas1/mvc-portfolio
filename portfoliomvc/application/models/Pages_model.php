<?php

	class Pages_model extends CI_Model {

		public $tableName = "pages";
		public $tableImageName = "page_images";
        		
	/****  GENEL KAYIT İŞLEMLERİ ****/

        //TÜM KAYITLAR
        public function getDataAll($where = array(), $order = "id ASC", $limit = null){
            $this->db->limit($limit);
            $this->db->where($where);	
            $this->db->order_by($order);
            return $this->db->get($this->tableName)->result();
        }

        //KAYIT SAYISI
        public function dataCount($where = array()) {
            $this->db->where($where);
            $this->db->from($this->tableName);
            return $this->db->count_all_results();
        }

        //TEK KAYIT GETİRME
        public function getData($where = array()){
            return $this->db->where($where)->get($this->tableName)->row();
        }

        //KAYIT EKLEME
        public function insertData($data = array()){
            return $this->db->insert($this->tableName, $data);
        }

        //KAYIT GÜNCELLEME
        public function updateData($where = array(), $data = array()){
            return $this->db->where($where)->update($this->tableName, $data);
        }

        //KAYIT SİLME
        public function deleteData($where = array()){
            return $this->db->where($where)->delete($this->tableName);
        }
    
    /****  MODEL RESİM İŞLEMLERİ ****/

        //TÜM RESİMLER
        public function getImageAll($where = array(), $order = "id ASC", $limit = null){
            $this->db->limit($limit);
            $this->db->where($where);
            $this->db->order_by($order);
            return $this->db->get($this->tableImageName)->result();
        }

        //TEK RESİM
        public function getImage($where = array()){
            return  $this->db->where($where)->get($this->tableImageName)->row();
        }

        //KAPAK FOTO GÜNCELLEME
        public function updateImage($where = array(), $data = array()){
            return $this->db->where($where)->update($this->tableImageName, $data);
        }

        //RESİM EKLEME
        public function insertImage($data = array()){
            return $this->db->insert($this->tableImageName, $data);
        }

        //RESİM SİLME
        public function deleteImage($where = array()){
            return $this->db->where($where)->delete($this->tableImageName);
        }

    	/****  ARAMA ****/ 
        public function searchData($aranan = null){
            $this->db->like('title', $aranan, 'both'); 
            $this->db->or_like('description', $aranan, 'both');
            $this->db->or_like('short_description', $aranan, 'both');
            return $this->db->get($this->tableName)->result();
        }
    }
?>