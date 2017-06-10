<div class="section banner_section who_we_help">
        <div class="container">
            <h4>Create Category</h4>
        </div>
    </div>
    <div class="section content_section">
        <div class="container">
            <div class="filable_form_container">
                <div class="form_container_block"> 
                    <form id="category" action="<?php echo base_url()?>category/add" method="post" class="cmxform">
                        <ul>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Category Name*</label>
                                    <input name="category_name" type="text" value=""> 
                                </div>
                                <label class="error"><?php echo form_error('category_name'); ?><label>
                            </li>
                        </ul>
                        <div class="next_btn_block">
                            <div class="next_btn">
                                <input type="submit"value="Submit" class="btn-success"><img src="<?php echo base_url()?>assets/images/small_triangle.png" alt="small_triangle">
                                <input type="button" class="btn-danger" value="Cancel" style="width:75px;height:36px;border:0px" onclick="javascript:window.location='<?php echo base_url()?>';"><img src="<?php echo base_url()?>assets/images/small_triangle.png" alt="small_triangle">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>		
    </div>  
    <script src="<?php echo base_url()?>assets/js/jquery.validate.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url()?>assets/js/custom_validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/js/category_validation.js" type="text/javascript"></script>

