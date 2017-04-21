<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->model('category_model');
        $this->load->model('product_model');
    }

    public function view($id = "",$offset=0) {
        $limit=2;
        $res = $this->product_model->get_product($id,$offset,$limit);
        $data['list'] = $res;
        $data['page_name'] = 'product/list_product';
        $this->load->view('main_template', $data);
    }

    public function add($id = "") {
        $data['upload_error'] = "";
        $file_name = "";
        $res = $this->category_model->get_category();
        $data['list'] = $res;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('product_name', 'Product Name', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('price', 'Price', 'required|callback_money');
            $this->form_validation->set_rules('category', 'Category', 'required');
            if ($this->form_validation->run() == TRUE) {
                if (!empty($_FILES['upload']['name'])) {
                    if (!file_exists('./upload')) {
                        $di = umask(0);
                        mkdir('./upload', 0777, true);
                        umask($di);
                    }
                    $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
                    if (!($ext == "jpg" || $ext == "png")) {
                        $data['upload_error'] = "Invalid File Format";
                    } else {
                        $upload_config['upload_path'] = "./upload/";
                        $upload_config['allowed_types'] = 'jpg|png';
                        $new_name = "product" . time();
                        $upload_config['file_name'] = $new_name;
                        $this->upload->initialize($upload_config);
                        if ($this->upload->do_upload('upload')) {
                            $img = $this->upload->data();
                            $file_name = $img['file_name'];
                        }
                    }
                }
                if ($data['upload_error'] == "") {
                    $data = array(
                        'name' => $this->input->post('product_name'),
                        'price' => $this->input->post('price'),
                        'image' => $file_name,
                        'category' => $this->input->post('category')
                    );
                    if ($id == "") {
                        $data['created_on'] = date('Y-m-d H:i:s');
                        $this->product_model->insert_product($data);
                        $this->session->set_flashdata('success', 'Product added Successfully');
                    } else {
                        $this->product_model->update_product($data, $id);
                        $this->session->set_flashdata('success', 'Product edited Successfully');
                    }
                    redirect('/product/view', 'location');
                }
            }
        }
        $data['page_name'] = 'product/add_product';
        $this->load->view('main_template', $data);
    }

    public function edit($id) {
        $result = $this->category_model->get_category();
        $data['cat'] = $result;
        $res = $this->product_model->edit_getproduct($id);
        $data['list'] = $res;

        $data['page_name'] = 'product/edit_product';
        $this->load->view('main_template', $data);
    }

    public function money($num) {
        if (preg_match('/^\d{0,9}(\.\d{0,2})?$/', $num)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete() {
        $ids = $this->input->post('product_id');
        $del = $this->product_model->delete_product($ids);
        echo $del;
    }

}

?>