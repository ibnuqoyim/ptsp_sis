<html>
<head>
<base href="<?=base_url();?>" />

     <link rel="stylesheet" type="text/css" href="css/screen.css" media="screen, projection" />
    <!--  <link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/chalsy.css" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" /> //-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen, projection" />
	<![endif]-->
</head>
<body onload="window.print()" style="background-color:#FFF">
<h1><?=$title;?></h1>
<?php
session_start();
$filter=strip_tags($_SESSION['tampung'],"<table><tr><td><p><h1><h2><h3><b><div>");
// Outputs: apearpearle pear
$cari = array('Apakah sudah benar data diatas ?', 
			  'Simpan',
			  'Cetak',
			  'Kembali',
			  'class="tablefield"',
			  'class="input-text-1"',
			  'class="c-table-1a"',
			  'class="c-table-xa"',
			  'class="c-clas-2rlt"',
			  'class="c-clas-2"'
			  );
$filter = str_replace($cari, '', $filter);
$filter = str_replace('border="0"','border="1" style="border:1 solid;"', $filter);

echo $filter;
?>
</body>
</html>