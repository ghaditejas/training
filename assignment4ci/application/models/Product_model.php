<?php
/**
 * Classname: Product_Model
 * Functionname: insert_category,
 * 
 * @category product
 * @package CI_Model
 * @author Tejas Ghadigaonkar
 */
class Product_model extends CI_Model {

    /**
     * @method __construct
     * @desc load the database 
     */
    public function __construct() {
         parent::__construct();
        $this->load->database();
    }
    
    /**
     * @method insert_product
     * @desc inserts the product in database
     * @param array $data
     */
    public function insert_product($data){
        $this->db->insert('product', $data);
    }
    
    /**
     * @method get_product
     * @desc used to get products from database
     * @param int $id
     * @param int $offset
     * @return array
     */
    public function get_product($id=0,$offset){
        if($id){
            $this->db->select('product.id AS prod_id,product.name,product.image,product.price,category.name AS cat_name');
            $this->db->from('category');
            $this->db->join('product','category.id = product.category');
            $this->db->where('product.status',1);
            $this->db->where('product.category',$id);
        }else{
            $this->db->select('product.id AS prod_id,product.name,product.image,product.price,category.name AS cat_name');
            $this->db->from('category');
            $this->db->join('product','category.id = product.category');
            $this->db->where('product.status',1);
        }
        $this->db->limit(LIMIT, $offset);
        $query=$this->db->get();
        return $query->result_array();
    }
    
    /**
     * @method edit_product
     * @desc gets the product according to the input
     * @param int $id
     * @return array
     */
    public function edit_getproduct($id){
        $this->db->where('id',$id);
        $query=$this->db->get('product');
        return $query->result_array();
    }
    
    /**
     * @method update_product
     * @desc update the selected product in database
     * @param array $data
     * @param int $id
     */
    public function update_product($data,$id){
        $this->db->where('id', $id);
         $this->db->update('product', $data);
    }
    
    /**
     * @method delete_product
     * @desc deletes the selected product
     * @param int $ids
     * @return int
     */
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