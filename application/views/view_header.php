   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="css/thickbox.css" media="screen" /> 
    <link rel="stylesheet" type="text/css" href="css/main.css" /> 
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/chalsy.css" />
    <link type="text/css" rel="stylesheet" href="css/tab.css" />
    <script type="text/javascript" src="js/chalsy.js"></script>
    <script type="text/javascript" src="js/thickbox.js"></script>
    <script type="text/javascript" src="js/syxscript.js"></script>  

    <!-- versi baru jquery tidak jalan auto completenya-->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <!--<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>-->
    <link href="js/jquery-ui-1.9.2/css/base/jquery-ui-1.9.2.custom.css" rel="stylesheet">    
    <script src="js/jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>

    <script type="text/javascript" src="js/autocomplete/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />

    <!--  Bootstrap Addon -->
    <link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap.css" />
    <!--<link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap-theme.min.css" />  -->
    <script src="js/bootstrap-3.3.5/js/bootstrap.js"></script>  

    <!-- jQuery -->
    <!--<script type="text/javascript" src="js/smartmenus/libs/jquery/jquery.js"></script> 
    baru tapi akibatnya uato complete tidak jalan-->
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="js/smartmenus/jquery.smartmenus.js"></script>
    <link href="js/smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.css" rel="stylesheet">    
    <script type="text/javascript" src="js/smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.js"></script>      

    <!-- SmartMenus core CSS (required) -->
    <link href="js/smartmenus/css/sm-core-css.css" rel="stylesheet" type="text/css" />
    <!-- "sm-mint" menu theme (optional, you can use your own CSS, too) -->
    <link href="js/smartmenus/css/sm-blue/sm-blue.css" rel="stylesheet" type="text/css" />

    <link href="navbar.css" rel="stylesheet">
    <!-- #main-menu config - instance specific stuff not covered in the theme -->
    <!-- Put this in an external stylesheet if you want the media query to work in IE8 (e.g. where the rest of your page styles are) -->
    <style type="text/css">
        @media (min-width: 768px) {
            #main-menu {
                position: relative;
                z-index: 9999;
            }
            #main-menu ul {
                width: 12em; /* fixed width only please - you can use the "subMenusMinWidth"/"subMenusMaxWidth" script options to override this if you like */
            }
        }


    </style>
    <!-- SmartMenus jQuery init -->
    <script type="text/javascript">
         $(function() {
            $('#main-menu').smartmenus({
                subMenusSubOffsetX: 6,
                subMenusSubOffsetY: -8
            });
        });
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
    <title>Sistem Informasi Sertifikasi (SIS)</title>
   
</head>

<body>
  <!--<div class="container" id="page">-->

     

  <!-----------------------------------------------------------------------------------/
  /---------------------------------menu login-----------------------------------------/
  ------------------------------------------------------------------------------------->      
	<?php  if($this->session->userdata('login')==true){ ?>
    
		    <?php $this->load->view('view_mainmenu'); ?>
    
	<?php }?>

  <!-----------------------------------------------------------------------------------/
  /---------------------------------end menu ------------------------------------------/
  /------------------------------------------------------------------------------------>  

  
  <!-- breadcrumbs -->
  <!--<div class="container">

<div>
	<div id="content"> -->
    <!--<div class="container">-->
        <!-- Jika anda menggunakan PHP 5.3.x keatas Maka pastikan di konfigurasi php.ini, short_open_tag di on (enable) kan -->