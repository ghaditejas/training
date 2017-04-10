<?php include 'header.php'; ?>
<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Manage Category</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="mange_buttons">
                <ul>
                    <!--<li class="search_div">
             <div class="Search">
                    <input name="search" type="text" /> 
                    <input type="submit" class="submit" value="submit">
             </div>
                    </li> -->
                    <li><a href="add_category.php">Create Category</a></li>
                    <li><a href="#">Delete</a></li>
                </ul>
            </div>
            <div class="table_container_block">
                <table width="100%">
                    <thead>
                        <tr>
                            <th width="10%">
                                <input class="checkbox" id="checkbox_sample18" type="checkbox"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample18"></label>
                            </th>
                            <th style="width:60%">Name <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="checkbox" id="checkbox_sample19" type="checkbox"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample19"></label>
                            </td>
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
                                <input class="checkbox" id="checkbox_sample20" type="checkbox"> <label class="css-label mandatory_checkbox_fildes" for="checkbox_sample20"></label>
                            </td>
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

            <div class="pagination">
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
<?php include 'footer.php'; ?>