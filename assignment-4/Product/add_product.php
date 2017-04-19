<?php
/*
 * Adds the product in database by firing query on database also creates a folder to store uploaded files
 */
$error_name = '';
$error_price = '';
$error_select = '';
$error_ext = '';
$target_dir = '../upload/';
$pageload = true;
include '../Includes/db_config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!file_exists('../upload')){
    $oldumask = umask(0);
    mkdir('../checkupload', 0777, true);
    umask($oldumask); 
    }
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
        $sqlquery = "INSERT INTO assign_product(name,price,image,category,created_on) values('" . $_POST['product_name'] . "','" . $_POST['price'] . "','" . $img_name . "','" . $_POST['category'] . "','" . date('Y-m-d H:i:s') . "')";
        if ($conn->query($sqlquery)) {
            $success = 'Category added Succesfully';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error();
        }
    }
} else {
    $pageload = true;
}

if ($pageload) {
    include '../Includes/header.php';
    ?>
    <div class="section banner_section who_we_help">
        <div class="container">
            <h4>Add Product</h4>
        </div>
    </div>
    <div class="section content_section">
        <div class="container">
            <div class="filable_form_container">
                <div class="form_container_block">
                    <form id="add_product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" class="cmxform">
                        <ul>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Name</label>
                                    <input name="product_name" type="text"> 
                                    <label clas="error"><?php echo $error_name; ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Price</label>
                                    <input name="price" type="text"> 
                                    <label class="error"><?php echo $error_price; ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="upload_fileds">
                                    <label>Upload Image</label>
                                    <input name="upload" id="uploadFile" type="file" placeholder="Choose File" style="width:380px">
                                    <label class="error"><?php echo $error_ext; ?></label>
                                </div>						
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Select Category</label>
                                    <select name="category" class="category custom_dropdown required">
                                        <option value="">Select Category</option>
                                        <?php
                                        $sqlquery = "SELECT name,id From assign_category";
                                        $result = $conn->query($sqlquery);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?><option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
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
                                <input type="button" class="btn-danger" value="cancel" style="width:75px;height:36px;border:0px" onclick="javascript:window.location = 'list_product.php';"><img src="../images/small_triangle.png" alt="small_triangle">
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
    <?php
    include '../Includes/footer.php';}?>