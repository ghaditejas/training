<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Add Product</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="form_container_block">
                <form id="add_product" action="<?php echo base_url();?>product/add" method="post" enctype="multipart/form-data" class="cmxform">
                    <ul>
                        <li class="fileds">
                            <div class="name_fileds">
                                <label>Product Name*</label>
                                <input name="product_name" type="text"> 
                                <label class="error"><?php echo form_error('product_name'); ?></label>
                            </div>
                        </li>
                        <li class="fileds">
                            <div class="name_fileds">
                                <label>Product Price*</label>
                                <input name="price" type="text"> 
                                <label class="error"><?php echo form_error('price'); ?></label>
                            </div>
                        </li>
                        <li class="fileds">
                            <div class="upload_fileds">
                                <label>Upload Image</label>
                                <input name="upload" id="uploadFile" type="file" placeholder="Choose File" style="width:380px">
                                <label class="error">
                                    <?php 
                                    if(isset($upload_error)){
                                        echo $upload_error;
                                    }
                                    ?>
                                </label>
                            </div>						
                        </li>
                        <li class="fileds">
                            <div class="name_fileds">
                                <label>Select Category*</label>
                                <select name="category" class="category custom_dropdown required">
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach($list as $row){
                                    ?>
                                    <option value="<?php echo $row['id']?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label class="error"><?php echo form_error('category'); ?></label>
                            </div>
                        </li>
                    </ul>
                    <div class="next_btn_block">
                        <div class="next_btn">
                            <input type="submit"value="Submit" class="btn-success"><img src="<?php echo base_url();?>assets/images/small_triangle.png" alt="small_triangle">
                            <input type="button" class="btn-danger" value="cancel" style="width:75px;height:36px;border:0px" onclick="javascript:window.location = '<?php echo base_url();?>product/view';"><img src="<?php echo base_url();?>assets/images/small_triangle.png" alt="small_triangle">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>		
</div>
<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/additional-methods.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/custom_validation.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/category_validation.js" type="text/javascript"></script>
