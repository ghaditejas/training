<!DOCTTYPE html>
<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/css/default.css" rel="stylesheet" type="text/css" media="all">
        <link href="<?php echo base_url()?>assets/css/stylesheet.css" rel="stylesheet" type="text/css" media="all">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo base_url()?>assets/js/jquery3.2.js" type="text/javascript"></script>
        
    </head>
    <body>
        <div id="wrapper">
            <header class="clearfix">
                <div>
                    <div class="Logo_Cont left col-md-6">
                        <a href="../Category/index.php"><img src="<?php echo base_url()?>assets/images/logo.png" alt=""></a>
                    </div>
                    <div class="Home_Cont_Right right col-md-6">
                        <div class="Home_Cont_Right_Top left">
                            <div class="Top_Search1 left" style="text-align:"center">Call Us Today! (02) 9017 8413</div>
                            <div class="right">
                                <input id="tags1" name="" value="Type desired Job Location" type="text" style="float:right;margin-right:20px">
                            </div>
                        </div>
                        <div class="Home_Cont_Right_Bottom left">
                            <div class="toggle_menu">
                                <a href="javascript:void(0)">Menu</a></div>
                            <div id="topMenu" style="margin-right: 20px">
                                <ul>
                                    <li><a href="<?php echo base_url()?>">Categories</a></li>
                                    <li><a href="<?php echo base_url()?>product/view">Products</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>