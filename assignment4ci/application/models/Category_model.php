<?php

class Category_Model extends CI_Model {

    public function __construct() {
         parent::__construct();
        $this->load->database();
    }
    
    public function insert_category($data){
        $this->db->insert('category', $data);
    }
    
    public function get_category(){
        $this->db->where('status',1);
        $query=$this->db->get('category');
        return $query->result_array();
        
    }
    
    public function get_editcategory($id){
        $data=array(
                'id'=>$id
                );
        $query=$this->db->get_where('category',$data);
        return $query->result_array();
    }
    
    public function category_update($name,$id){
        $data=array(
                'name'=> $name
                );
        $this->db->where('id', $id);
       $this->db->update('category', $data);
    }
    
    public function delete_cateory($ids){
        $data=array (
                'status'=>0
                );
        $this->db->where_in('id',$ids);
        $this->db->update('category',$data);
        if($this->db->affected_rows()>0){
              return 1;
        }
    }
}

?>