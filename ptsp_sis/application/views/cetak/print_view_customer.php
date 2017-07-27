<?php
if($this->session->flashdata('xls')){
	header("Content-type: application/octet-stream");
	$namafile=($this->session->flashdata('namafile'))? $this->session->flashdata('namafile') : "chalsyxls";
	header("Content-Disposition: attachment; filename=".$namafile.".xls");
	#
	header("Pragma: no-cache");
	#
	header("Expires: 0");
	
}
?>
<html>
<head>
	<base href="<?=base_url();?>" />
     <link rel="stylesheet" type="text/css" href="css/print2.css" media="screen, projection" />
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">
<h2>Daftar Customer</h2>
<table border="1" cellpadding="0" cellspacing="0" width="100%">
	<tr>
        <th align="left" width="10">No</td>
		<th>Nama&nbsp;Perusahaan</td>
		<th>Email</td>
		<th>Telepon</td>
		<th>Kota</td>
        <?php if($this->session->userdata('profil')->groupname == 'super'){ ?>
		<th>Satuan&nbsp;Kerja</td>
        <? } ?>
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
?>
	<tr class="row0">
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=$row->nama;?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->email);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=$row->telepon;?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=($row->kd_negara=='102')?$row->nama_kota:"-";?></div></td>
        <?php if($this->session->userdata('profil')->groupname == 'super'){ ?>
			<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->nama_satker);?></div></td>
        <? } ?>
	</tr>
<?}?>
</table>
<div style="clear:both"></div>
<div class="textambahan" align="center" >Display #<?=$limit;?>
&nbsp;&nbsp; Page Result - <?=$page;?> of <?=$pages;?>
</div>
</body>
</html>