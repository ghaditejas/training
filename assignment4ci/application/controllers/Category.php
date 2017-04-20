<?php

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->model('category_model');
    }

    public function category_list() {
        $res=$this->category_model->get_category();
        $data['list']=$res;
        $data['page_name']='category/list_category';
        $this->load->view('main_template',$data); 
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('category_name', 'Category', 'required');
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
    
    public function delete(){        
        $ids =$this->input->post('category_id');
        $del=$this->category_model->delete_cateory($ids);
        echo $del;
    }

}

?>