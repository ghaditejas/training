<?php
/*
 * Edit the specified product in database  by using the id obtained and firing query on database
 */
$error_name = '';
$error_price = '';
$error_select = '';
$error_ext = '';
$target_dir = '../upload/';
$pageload = true;
include '../Includes/db_config.php';
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['product_name'])) {
        $error_name = "This is required";
    } else if (preg_match('/[\!@#$%&*()~]/', $_POST['category_name'])) {
        $error_name = 'Only Alphabnumeric ';
    }
    if (empty($_POST['price'])) {
        $error_price = "This is required";
    } else if (!preg_match('/^\d{0,9}(\.\d{0,2})?$/', $_POST['price'])) {
        $error_price = "Input is not valid";
    }
    if (empty($_POST['category'])) {
        $error_select = "This is required";
    }
    if (!($_FILES['upload']['name'] == '')) {
        $ext = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
        if (!($ext == "jpg" || $ext == "png")) {
            $error_ext = "Invalid File";
        }
        if (empty($error_ext)) {
            $img_name = 'product_image_' . time() . '.' . $ext;
            $target_file = $target_dir . $img_name;
            move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);
        }
    }
    if (empty($error_name) && empty($error_price) && empty($error_select) && empty($error_ext)) {
        $sqlquery = "UPDATE assign_product SET name='" . $_POST['product_name'] . "',price='" . $_POST['price'] . "',image='" . $img_name . "',category='" . $_POST['category'] . "' where id='" . $product_id . "'";
        if ($conn->query($sqlquery)) {
            echo $success = 'Category Eidted Succesfully';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error();
        }
    }
} else {
    $pageload = true;
}

if ($pageload) {
    /*
     * Gets the product name ,price ,category,an image if uploaded of teh product that is to be edited
     */
    $sqlvalues = "SELECT assign_product.name,assign_product.image,  
               assign_product.price,assign_category.name AS cat_name ,assign_product.category as cat_id
               FROM   assign_category  
               LEFT JOIN assign_product  
               ON assign_category.id = assign_product.category where 
               assign_product.id='" . $product_id . "'";
    $result = $conn->query($sqlvalues);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_name = $row['name'];
            $product_price = $row['price'];
            $product_image = $row['image'];
            $product_categoryname = $row['cat_name'];
            $category_id = $row['cat_id'];
        }
    }
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
                    <form id="add_product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?product_id=" . $product_id ?>" method="post" enctype="multipart/form-data" class="cmxform">
                        <ul>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Name</label>
                                    <input name="product_name" type="text" value="<?php echo $product_name; ?>"> 
                                    <label class="error"><?php echo $error_name; ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Price</label>
                                    <input name="price" type="text" value = "<?php echo $product_price; ?>"> 
                                    <label class="error"><?php echo $error_price; ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="upload_fileds">
                                    <label>Upload Image</label>
                                    <input name="upload" id="uploadFile" type="file">
                                    <?php if (!empty($product_image)&&file_exists('../upload/' . $row['image'])) { ?>
                                        <img src="../upload/<?php echo $product_image; ?>" style="width:80px; height:auto;" alt="Image NOT Available"><?php } ?>
                                    <label class="error"><?php echo $error_ext; ?></label>
                                </div>						
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Select Category</label>
                                    <select name="category" class="category required" style="z-index: 10; opacity: 1;">
                                        <?php
                                        $sqlquery = "SELECT name,id From assign_category";
                                        $result = $conn->query($sqlquery);
                                        if ($result->num_rows > 0) {
                                            while ($row1 = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?php echo $row1['id'] ?>"
                                                <?php if ($category_id == $row1['id']) {
                                                    echo 'selected="selected"';
                                                } ?>
                                                        >
                                                <?php echo $row1['name'];?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        mysqli_close($conn);
                                        ?>
                                    </select>
                                    <label class="error"><?php echo $error_select; ?></label>
                                </div>
                            </li>
                        </ul>
                        <div class="next_btn_block">
                            <div class="next_btn">
                                <input type="submit"value="Submit" class="btn-success"><img src="../images/small_triangle.png" alt="small_triangle">
                                <input type="button" class="btn-danger" value="cancel" style="width:75px;height:36px" onclick="javascript:window.location = 'list_product.php';"><img src="../images/small_triangle.png" alt="small_triangle">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>		
    </div>
    <script src="../js/jquery.validate.min.js" type="text/javascript"></script> 
    <script src="../js/additional-methods.min.js" type="text/javascript"></script> 
    <script src="../js/custom_validation.js" type="text/javascript"></script>
    <script type="text/javascript">
                                    /*
                                     * Validates the product name field ,price,category field and uploaded file extension then sumbits the  form if it is proper
                                     */
                                    $(document).ready(function () {
    <?php if (!empty($success)) { ?>
                                            alert('<?php echo $success; ?>');
    <?php } ?>
                                        $("#add_product").validate({
                                            rules: {
                                                product_name: {
                                                    required: true,
                                                    pass1: true
                                                },
                                                price: {
                                                    required: true,
                                                    money: true
                                                },
                                                category: {
                                                    required: true
                                                },
                                                upload: {
                                                    accept: "image/jpeg, image/png"
                                                }
                                            },
                                            messages: {
                                                product_name: {
                                                    required: 'This field is Required*'
                                                },
                                                price: {
                                                    required: 'This field is Required*'
                                                },
                                                category: {
                                                    required: 'Please Select a Category*'
                                                }
                                            },
                                            submitHandler: function (form) {
                                                form.submit();
                                            }
                                        });
                                    });

    </script>
    <?php include '../Includes/footer.php';
} ?>