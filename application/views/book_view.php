<html>
<head>
    <title>ITX.WEB.ID</title>
    <base href="<?php echo base_url(); ?>" />
    <link type="text/css" rel="stylesheet" href="css/flick/jquery-ui-1.8.13.custom.css" />
    <link type="text/css" rel="stylesheet" href="css/tab.css" />
</head>
<body>
<center><h2> Book & Member List</h2></center>
<div id="tabs">
 
    <ul>
        <li><a href="#read">Book List</a></li>
        <li><a href="#read2">Member List</a></li>
    </ul>
 
    <div id="read">
        <table id="tabel"></table>
    </div>
 
    <div id="read2">
        <table id="tabel2"></table>
    </div>
 
</div>
 
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-templ.js"></script>
 
<script type="text/template" id="readTemp">
    <tr>
        <td>${id}</td>
        <td>${title}</td>
        <td>${author}</td>
    </tr>
 
</script>
 
<script type="text/template" id="readTemp2">
    <tr>
        <td>${no}</td>
        <td>${name}</td>
        <td>${address}</td>
    </tr>
 
</script>
 
<script type="text/javascript" src="js/all.js"></script>
</body>
</html>