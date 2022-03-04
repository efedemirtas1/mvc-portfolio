<?php

	class Inbox_model  extends CI_Model {
		
		//TÜM KAYITLAR
		public function getDataAll($where = array(), $order = "id DESC", $limit = null, $tableName){
			$limit != null ? $this->db->limit($limit) : "" ;
			$this->db->where($where);	
			$this->db->order_by($order);
			return $this->db->get($tableName)->result();
		}

		public function getData($where = array(), $tableName){
			return $this->db->where($where)->get($tableName)->row();
		}

		//KAYIT SAYISI
		public function dataCount($where = array(), $tableName) {
			$this->db->where($where);
			$this->db->from($tableName);
			return $this->db->count_all_results();
		}

    	//KAYIT EKLEME
		public function insertData($data = array(), $tableName){
			return $this->db->insert($tableName, $data);
		}

    	//KAYIT GÜNCELLEME
		public function updateData($where = array(), $data = array(), $tableName){
			return $this->db->where($where)->update($tableName, $data);
		}

        //KAYIT SİLME
		public function deleteData($where = array(), $tableName){
			return $this->db->where($where)->delete($tableName);
		}

	}
?>