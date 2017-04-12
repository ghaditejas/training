<?php
include '../Includes/db_config.php';
include '../Includes/header.php';
?>
<div class="section banner_section who_we_help">
  	<div class="container">
  		<h4>Edit Product</h4>
  	</div>
  </div>
<div class="section content_section">
	<div class="container">
		<div class="filable_form_container">
			<div class="form_container_block">
				<ul>
					<li class="fileds">
						<div class="name_fileds">
							<label>Product Name</label>
							<input name="firstname" type="text"> 
						</div>
					</li>
					<li class="fileds">
						<div class="name_fileds">
							<label>Product Price</label>
							<input name="price" type="text"> 
						</div>
					</li>
					<li class="fileds">
						<div class="upload_fileds">
							<label>Upload Image</label>
							<input id="uploadFile" type="file" placeholder="Choose File">
						</div>						
					</li>
					<li class="fileds">
						<div class="name_fileds">
							<label>Select Category</label>
							<select name="category" class="select category" style="z-index: 10; opacity: 0;">
								<option value="mobile">Mobile</option>
								<option value="automobile">Automobile</option>
							</select><span class="select">Mobile</span> 
						</div>
					</li>
				</ul>
				<div class="next_btn_block">
					<div class="next_btn">
						 <input type="submit"value="Submit" class="btn-success"><img src="../images/small_triangle.png" alt="small_triangle">
                                <input type="button" class="btn-danger" value="cancel" style="width:75px;height:36px" onclick="javascript:window.location='list_product.php';"><img src="../images/small_triangle.png" alt="small_triangle">
					</div>
				</div>
			</div>
		</div>
	</div>		
  </div>
<?php include '../Includes/footer.php'; ?>