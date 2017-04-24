<?php
/**
 * Classname: Product
 * Functionname: view,add,edit,money,delete
 * 
 * @category product
 * @package CI_Controller
 * @author Tejas Ghadigaonkar
 */
class Product extends CI_Controller {

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
        $this->load->library('upload');
        $this->load->model('category_model');
        $this->load->model('product_model');
    }

    /**
     * @method view
     * @desc list products in database according to its selected category
     * @param int $id
     * @param int $offset
     * @author Tejas Ghadigaonkar
     */
    public function view($id = 0,$offset=1) {
        $search="";
        $offset=($offset-1)*LIMIT;
        $data['category']=$id;
        if($this->input->post('search')){
            $search=$this->input->post('search');
        }
        $sort_by = $this->input->post('sort_by');
        $sort_type = $this->input->post('sort_by_val');
        
        $data['sort_by'] = $sort_by;
        $data['sort_type'] = $sort_type;
        
        $res = $this->product_model->get_product($id,$offset,$search,$sort_by,$sort_type);
        $data['list'] = $res;
        $data['offset']=$offset;
        $table_name="product";
        $data['pages']=$this->category_model->pagination($table_name,$search,$id);
        $data['page_name'] = 'product/list_product';
        $this->load->view('main_template', $data);
    }
    
    /**
     * @method add
     * @desc adds the product in database
     * @param int $id
     * @author Tejas Ghadigaonkar
     */
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

    /**
     * @method edit
     * @desc edits the selected product and update it in database
     * @param int $id
     * @author Tejas Ghadigaonkar
     */
    public function edit($id) {
        $result = $this->category_model->get_category();
        $data['cat'] = $result;
        $res = $this->product_model->edit_getproduct($id);
        $data['list'] = $res;

        $data['page_name'] = 'product/edit_product';
        $this->load->view('main_template', $data);
    }
    /**
     * @method money
     * @desc checks the regular expression
     * @param string $num
     * @return boolean
     * @author Tejas Ghadigaonkar
     */
    public function money($num) {
        if (preg_match('/^\d{0,9}(\.\d{0,2})?$/', $num)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * @method delete
     * @desc deletes the category from database 
     * @author Tejas Ghadigaonkar
     */
    public function delete() {
        $ids = $this->input->post('product_id');
        $del = $this->product_model->delete_product($ids);
        echo $del;
    }

}

?>