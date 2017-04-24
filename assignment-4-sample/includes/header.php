<?php
error_reporting(-1);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie" lang="en" dir="ltr"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie" lang="en" dir="ltr"><![endif]-->
<!--[if gt IE 8]> <html class="no-js gt-ie8 ie" lang="en" dir="ltr"><![endif]-->

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title>Assignment 4 | <?php echo isset($page_title) ? $page_title : 'Page title goes here';?></title>
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/stylesheet.css" rel="stylesheet" type="text/css" media="all">
        <!--<link href="css/small-resolution.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/medium-resolution.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/high-resolution.css" rel="stylesheet" type="text/css" media="all">-->

        <!-- bxSlider CSS file -->
        <link href="css/jquery.bxslider.css" rel="stylesheet" />

        <!-- Responsive -->
        <link href="css/responsive.css" rel="stylesheet" />
        
        <!-- Custom CSS file -->
        <link href="css/custom.css" rel="stylesheet" />
        
        <!-- Uniform CSS file -->
        <link href="js/plugins/uniform/css/uniform.default.css" rel="stylesheet" />
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>

    <body>
        <!--wrapper-starts-->
        <div id="wrapper">
            <!--header-starts-->
            <header class="clearfix">
                <div class="container"><!--container Start-->
                    <div class="Logo_Cont left"><!--Logo_Cont Start-->
                        <a href="index.php"><img src="images/logo.png" alt=""  /></a>
                    </div><!--Logo_Cont End-->
                    <div class="Home_Cont_Right right"><!--Home_Cont_Right Start-->
                        <div class="Home_Cont_Right_Top left"><!--Home_Cont_Right_Top Start-->
                            <div class="Top_Search1 left">Call Us Today! (02) 9017 8413</div>
                            <div class="Top_Search2 right"><input  id="tags1" name="" type="text" onclick="this.value = '';" onblur="validate_field('phone');"  value="Type desired Job Location" /></div>
                        </div><!--Home_Cont_Right_Top End-->

                        <div class="Home_Cont_Right_Bottom left"><!--Home_Cont_Right_Bottom Start-->
                            <div class="toggle_menu"><a href="javascript:void(0)">Menu</a></div>
                            <div id="topMenu">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="blog_index.html">Dating Blog</a></li>
                                    <li><a href="who_we_help.html">Who We Help</a></li>
                                    <li><a href="why_vital.html">Why Vital</a></li>
                                    <li><a href="reviews.html">Reviews</a></li>
                                    <li><a href="contact_us.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div><!--Home_Cont_Right_Bottom End-->
                    </div><!--Home_Cont_Right End-->
                </div><!--container End-->
            </header>
            <!--header-ends-->
            
            <div class="section banner_section who_we_help">
                <div class="container">
                    <h4><?php echo isset($page_title) ? $page_title : 'Page title goes here';?></h4>
                </div>
            </div>
            
            <?php
            //include the db.php
            include('db.php');
            
            $page_size = 2;
            
            $productUploadFilePath = 'uploads/product';
            
            /**
             * Generates a unique filename.
             * 
             * @param type $fileName
             * @param type $filePath
             * @param type $keepOriginalName
             * @return type
             */
            function generateUniqueFilename($fileName, $filePath, $keepOriginalName = false) {
                $ext = trim(substr(strrchr($fileName, '.'), 1));
                if ($keepOriginalName) {
                    $fileName = str_replace(" ", "_", $fileName);
                } else {
                    $new_name = trim(substr(md5(microtime()), 2, -5));
                    $fileName = $new_name . '.' . $ext;
                }
                $no = 1;
                $newFileName = $fileName;
                while (file_exists($filePath . "/" . $newFileName)) {
                    $no++;
                    $newFileName = substr_replace($fileName, "_$no.", strrpos($fileName, "."), 1);
                }
                return $newFileName;
            }
