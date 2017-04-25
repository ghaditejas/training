<?php
/**
 * Classname: Category
 * Functionname: category_list,add,edit,delete
 * 
 * @category category
 * @package CI_Controller
 * @author Tejas Ghadigaonkar
 */
class Category extends CI_Controller {
    
    /**
     *@method __construct
     *@desc loads library helpers and model
     *@author Tejas Ghadigaonkar 
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->model('category_model');
    }
    
    /**
     *@method category_list 
     *@desc lists the categories  by calling the view
     *@param int $offset
     */
     public function category_list($offset=1) {
        $search="";
        if($this->input->post('offset')){
            $offset=$this->input->post('offset');
        }
        $offset=($offset-1)*LIMIT;
        if($this->input->post('search')){
            $search=$this->input->post('search');
        }
        else if($this->input->post('search_saved')){
            $search=$this->input->post('search_saved');
        }
        $data['search']=$search;
        $res=$this->category_model->get_category($offset,$search);
        $data['list']=$res;
        $data['offset']=$offset;
        $table_name='category';
        $data['pages']=$this->category_model->pagination($table_name,$search);
        $data['page_name']='category/list_category';
        $this->load->view('main_template',$data); 
    }

    /**
     * @method add
     * @desc adds category into th database
     * @author Tejas Ghadigaonkar
     */
    public function add() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('category_name', 'Category', 'required|alpha_numeric_spaces');
            if ($this->form_validation->run() == TRUE) {
                $data=array(
                    'name'=>$this->input->post('category_name'),
                     'created_on'=> date('Y-m-d H:i:s')
                        );
               $this->category_model->insert_category($data);
               $this->session->set_flashdata('success','Category added Successfully');
               redirect();
            }
        }
        $data['page_name']='category/add_category';
        $this->load->view('main_template',$data);
        
    }

    /**
     *@method edit
     *@desc edits the selected category by updating it in database
     * @param int $id
     */
    public function edit($id) {
        $res=$this->category_model->get_editcategory($id);
        $data['edit']=$res;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('category_name', 'Category', 'required');
            if ($this->form_validation->run() == TRUE) {    
                $name=$this->input->post('category_name');
                $this->category_model->category_update($name,$id);
               $this->session->set_flashdata('success','Category edited Successfully');
               redirect();
            }
        }
        $data['page_name']='category/edit_category';
        $this->load->view('main_template',$data);
    }
    
    /**
     * @method delete
     * @desc deletes the category from database 
     * @author Tejas Ghadigaonkar
     */
    public function delete(){        
        $ids =$this->input->post('category_id');
        $del=$this->category_model->delete_cateory($ids);
        echo $del;
    }

}

?>