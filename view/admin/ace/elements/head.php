<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/font-awesome/css/font-awesome.min.css" />

    
    <?php
        if(isset($page_css) && count($page_css) != 0) {
            foreach($page_css as $css) require_once('page_css/'.$css);
        }
    ?>

    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" /> -->

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/fonts/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/OJ_custom.css" />    

    <!--[if lte IE 9]>
        <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?php echo $fullpath; ?>assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo $fullpath; ?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo $fullpath; ?>assets/js/html5shiv.min.js"></script>
    <script src="<?php echo $fullpath; ?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>