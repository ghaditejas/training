<?php
/**
 * Classname: Category_Model
 * Functionname: insert_category,
 * 
 * @category product
 * @package CI_Model
 * @author Tejas Ghadigaonkar
 */
class Category_Model extends CI_Model {
    /**
     * @method __construct
     * @desc load the database 
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @method insert_category
     * @desc inserts category in database
     * @param arrray $data
     */
    public function insert_category($data) {
        $this->db->insert('category', $data);
    }
    /**
     * @method get_category
     * @desc used to get categories from database
     * @param int $offset
     * @return array
     */
    public function get_category($offset,$search="") {
        if($search!=""){
        $this->db->like('name',$search);    
        }
        $this->db->where('status', 1);
        $this->db->limit(LIMIT, $offset);
        $query = $this->db->get('category');
        return $query->result_array();
    }
    /**
     * @method get_editcategory
     * @desc used to get category of a given id
     * @param type $id
     * @return array
     */
    public function get_editcategory($id) {
        $data = array(
            'id' => $id
        );
        $query = $this->db->get_where('category', $data);
        return $query->result_array();
    }
    
    /**
     * @method category_update
     * @desc update the category n database
     * @param string $name
     * @param int $id
     */
    public function category_update($name, $id) {
        $data = array(
            'name' => $name
        );
        $this->db->where('id', $id);
        $this->db->update('category', $data);
    }
    
    /**
     * @method delete_category
     * @desc deletes the selected category
     * @param int $ids
     * @return int
     */
    public function delete_cateory($ids) {
        $data = array(
            'status' => 0
        );
        $this->db->where_in('id', $ids);
        $this->db->update('category', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        }
    }
    /**
     * @method pagination
     * @sdesc counts the total no. of categories
     * @param string $table_name
     * @param int $id
     * @return int
     */
    public function pagination($table_name,$search,$id = 0) {
        if($search!=""){
        $this->db->like('name',$search);    
        }
        if ($id) {
            $this->db->where('category', $id);
            $this->db->where('status', 1);
            $this->db->from($table_name);
            $count = $this->db->count_all_results();
        } else {
            $this->db->where('status', 1);
            $this->db->from($table_name);
            $count = $this->db->count_all_results();
        }
        if ($count % LIMIT == 0) {
            return($count / LIMIT);
        } else {
            return(floor($count / LIMIT) + 1);
        }
        
    }
    /**
     * @method get_categorylist
     * @desc gets list of category
     * @return array
     */
    public function get_categorylist(){
        $this->db->where('status', 1);
        $query = $this->db->get('category');
        return $query->result_array();
    }

}

?>