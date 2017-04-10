<?php
$error = '';
$success = '';
$page_load = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['category_name'])) {
        $error = "This is required";
    } else if (!preg_match('/^[a-zA-Z]/', $_POST['category_name'])) {
        $error = 'Only Alphabets ';
    }
    if (empty($error)) {
        include 'db_config.php';
        $name = $_POST['category_name'];
        $sqlquery = "INSERT INTO assign_category(name) VALUES('" . $name . "')";
        if ($conn->query($sqlquery)) {
            $success = 'Category added Succesfully';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error();
        }

        mysqli_close($conn);
    } else {
        $page_load = true;
    }
} else {
    $page_load = true;
}
if ($page_load) {
    ?>
    <?php include 'header.php'; ?>
    <div class="section banner_section who_we_help">
        <div class="container">
            <h4>Create Category</h4>
        </div>
    </div>
    <div class="section content_section">
        <div class="container">
            <div class="filable_form_container">
                <div class="form_container_block">
                    <form id="add_category" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <ul>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Category Name</label>
                                    <input name="category_name" type="text"> 
                                </div>
                                <span><?php echo $error; ?>
                            </li>
                        </ul>
                        <div class="next_btn_block">
                            <div class="next_btn">
                                <center><input type="submit"value="Submit"><img src="../images/small_triangle.png" alt="small_triangle"></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>		
    </div>  
    <script src="../js/jquery.validate.min.js" type="text/javascript"></script> 
    <script src="../js/custom_validation.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
    <?php if (!empty($success)) { ?>
            alert('<?php echo $success; ?>');
    <?php } ?>
            $("#add_category").validate({
                rules: {
                    category_name: {
                        required: true,
                        pass: true
                    }
                },
                messages: {
                    category_name: {
                        required: 'This field is Required*'
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

    </script>
    <?php include 'footer.php'; ?>

<?php } ?>

