<?php
class products_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	//--------Get products---------
	public function getProducts(){
		$query=$this->db->get('products');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return array();
		}
	}
	//--------Get product by id---------
	public function getProductById($id){
		$this->db->where('id', $id);
		$query=$this->db->get('products');
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//--------Add products---------
	public function addProduct($form_data){
		$this->db->insert('products', $form_data);
        return ($this->db->affected_rows() != 1) ? false : true;
	}
	//--------Update products---------
	public function updateProduct($form_data, $id){
		$this->db->where('id', $id);
        $this->db->update('products', $form_data);		
        return ($this->db->affected_rows() != 1) ? false : true;
	}
	//--------Delete products---------
	public function deleteProduct($id){
		$this->db->delete('products',array('id' => $id ));
        return ($this->db->affected_rows() != 1) ? false : true;
	}
}
?>	