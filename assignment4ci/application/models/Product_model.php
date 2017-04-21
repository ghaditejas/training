<?php

class Product_model extends CI_Model {

    public function __construct() {
         parent::__construct();
        $this->load->database();
    }
    
    public function insert_product($data){
        $this->db->insert('product', $data);
    }
    
    public function get_product($id=""){
        if($id==""){
            $this->db->select('product.id AS prod_id,product.name,product.image,product.price,category.name AS cat_name');
            $this->db->from('category');
            $this->db->join('product','category.id = product.category');
            $this->db->where('product.status',1);
        }else{
            $this->db->select('product.id AS prod_id,product.name,product.image,product.price,category.name AS cat_name');
            $this->db->from('category');
            $this->db->join('product','category.id = product.category');
            $this->db->where('product.status',1);
            $this->db->where('product.category',$id);
        }
        $query=$this->db->get();
        return $query->result_array();
    }
    
    public function edit_getproduct($id){
        $this->db->where('id',$id);
        $query=$this->db->get('product');
        return $query->result_array();
    }
    
    public function update_product($data,$id){
        $this->db->where('id', $id);
         $this->db->update('product', $data);
    }
    
    public function delete_product($ids){
        $data=array (
                'status'=>0
                );
        $this->db->where_in('id',$ids);
        $this->db->update('product',$data);
        if($this->db->affected_rows()>0){
              return 1;
        }
    }
}