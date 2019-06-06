<?php

if (!isset($template_linkki_arr) || !is_array($template_linkki_arr)) {
    $template_linkki_arr = array();
}

if (!isset($template_linkki_txt_arr) || !is_array($template_linkki_txt_arr)) {
    $template_linkki_txt_arr = array();
}

if (!isset($template_user)) { 
    $template_user = "";
}

if (!isset($template_header_insert)) { 
    $template_header_insert = "";
}

if (!isset($template_log_out)) {
    $template_log_out = "";
}

if (!isset($template_head_insert)) {
    $template_head_insert = "";
}
?>

<!DOCTYPE html>
<html>
<head>

    <title><?php echo $config["project_name"]; ?> - <?php echo $template_sivutitle; ?></title>
    <meta http-equiv="x-ua-compatible" content="ie=10">

    <link rel="icon" href="//www.oamk.fi/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="//www.oamk.fi/favicon.ico" type="image/x-icon"/>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseUrl']; ?>vendor/bootstrap-4.1.0-dist/bootstrap.min.css"/>
    <script src="<?php echo $config['urls']['baseUrl']; ?>vendor/bootstrap-4.1.0-dist/bootstrap.bundle.min.js"></script>
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseUrl']; ?>vendor/js-4.0.4-dist/select2.min.css"/>
    <script src="<?php echo $config['urls']['baseUrl']; ?>vendor/js-4.0.4-dist/select2.full.min.js"></script>
    
    <meta name='robots' content='noindex,nofollow'/>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseUrl']; ?>css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $config['urls']['baseUrl']; ?>css/main.css"/>
    
    
    <?php echo $template_head_insert; ?>
</head>

<body>

    <div class="container-fluid container-main-content">

            <div class="row">
                <div class="col-sm th_page_container">
                    
                    <div class="row logorivi">
                        <div class="col-sm col-lg-10 offset-lg-1">
                            <div class="row align-items-center logorivi_korkeus">
                                
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <div class="logo">
                                        <a href="#"><?php echo $config['project_name']; ?></a>
                                    </div>
                                </div>
                                
                                <div class="col-lg-9 col-md-8 col-sm-12 text-md-right">
                                    <h1><?php echo $config['project_name']; ?></h1>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row"> <!-- User bar -->
                        <div class="col-sm orange">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <div class="row">
                                        
                                        <div class="col-md-2">Hei <?php echo $template_user; ?>!</div>
                                        <div class="col-md-8 text-md-center"><?php echo $template_header_insert; ?></div>
                                        <div class="col-md-2 text-md-right"><?php echo $template_log_out; ?></div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                    if (isset($template_linkki_arr) && isset($template_linkki_txt_arr)) {
                        if (is_array($template_linkki_arr) && is_array($template_linkki_txt_arr)) {
                            if (count($template_linkki_arr) == count($template_linkki_txt_arr)) {
                                $x = 0;
                                $max = count($template_linkki_arr);
                                while ($x < $max) {
                                    if (!$x) {
                                        echo '<div class="row">
                                            <div class="col-md col-lg-10 offset-lg-1">';
                                        echo '<ol class="breadcrumb">';
                                    }
                                    
                                    $class = '';
                                    $aria  = '';
                                    if ($x == ($max - 1)) {
                                        $class = 'active';
                                        $aria  = 'aria-current="page"';
                                    }
                                    
                                    echo '<li class="breadcrumb-item ' . $class . '" ' . $aria . '><a href="' . $template_linkki_arr[$x] . '">' . $template_linkki_txt_arr[$x] . '</a></li>';
                                    $x++;
                                }
                                
                                if ($x) {
                                    echo "</ol>";
                                    echo "</div>
                                    </div>";
                                }
                            }
                        }
                    }
                    ?>

                    <div class="row">
                        <div class="col-md col-lg-10 offset-lg-1 pb-5" id="content">