<?php
include '../Includes/db_config.php';
include '../Includes/header.php';
?>
<div class="section banner_section who_we_help">
  	<div class="container">
  		<h4>Manage Products</h4>
  	</div>
</div>
<div class="section content_section">
	<div class="container">
		<div class="filable_form_container">
			<div class="mange_buttons">
				<ul>
					<li><a href="add_product.php">Create Product</a></li>
					<li><a href="#">Delete</a></li>
				</ul>
			</div>
			<div class="table_container_block">
				<table width="100%">
					<thead>
						<tr>
						<th width="10%">
							<input type="checkbox" class="checkbox" id="checkbox_sample18"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample18"></label>
						</th>
						<th style="">Product Name <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
						<th style="">Product Image</th>
						<th style="">Product Price</th>
						<th style="">Product Category <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="checkbox" class="checkbox" id="checkbox_sample19"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample19"></label>
							</td>
							<td>Iphone</td>
							<td style="text-align:center"><img src="http://www.weatherforecast.co.uk/blog/wp-content/uploads/2015/01/noimage.jpg" style="width:80px; height:auto;"></td>
							<td style="text-align:right">Rs 60000</td>
							<td>Mobile</td>
							<td>
								<div class="buttons">
                                                                  <button class="btn btn_edit">Delete</button>
								  <a  class="btn btn_delete" href="edit_product.php">">Edit</a>
								</div>								
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" class="checkbox" id="checkbox_sample19"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample19"></label>
							</td>
							<td>Nexus 5</td>
							<td style="text-align:center"><img src="http://www.weatherforecast.co.uk/blog/wp-content/uploads/2015/01/noimage.jpg" style="width:80px; height:auto;"></td>
							<td style="text-align:right">Rs 39000</td>
							<td>Mobile</td>
							<td>
								<div class="buttons">
								  <button class="btn btn_edit">Edit</button>
								  <button class="btn btn_delete">Delete</button>
								</div>								
							</td>
						</tr>
						<tr>
							<td>
								<input type="checkbox" class="checkbox" id="checkbox_sample19"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample19"></label>
							</td>
							<td>I20</td>
							<td style="text-align:center"><img src="http://www.weatherforecast.co.uk/blog/wp-content/uploads/2015/01/noimage.jpg" style="width:80px; height:auto;"></td>
							<td style="text-align:right">Rs 709000</td>
							<td>Automobile</td>
							<td>
								<div class="buttons">
								  <button class="btn btn_edit">Edit</button>
								  <button class="btn btn_delete">Delete</button>
								</div>								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="pagination_listing">
				<ul>
					<li><a href="#">first</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">Last</a></li>
				</ul>
			</div>

		</div>
	</div>		
  </div>
<?php include '../Includes/footer.php'; ?>