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
<body> 
<h2>Daftar Order</h2>
<table border="1" cellpadding="0" cellspacing="0" width="100%" style="padding:2px">
	<tr>
        <th align="left" width="10">No</td>
		<th>No.Order</td>
		<th>Customer&nbsp;Asal</td>
		<th>Customer&nbsp;Tujuan</td>
		<th width="50">Tgl.Selesai</td>
		<th width="100">Status&nbsp;Order</td>
		<th width="80">Status&nbsp;Bayar</td>
		<th width="75">Jumlah&nbsp;SHU</td>
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
	$jum_rhu=$this->mOrder->getRHU($row->kd_order,'',true);
	$jum_shu=$this->mOrder->getSHU($row->kd_order,'',true);
	$res=$this->mOrder->getDetail('',false,$row->kd_order);
	$jum_sertifikat=0;
	if($res){
		foreach($res as $dat){
			$jum_sertifikat +=$dat->jumlah_sertifikat;
		}
		
	}
	
?>
	<tr class="row0">
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
		<td class="<?=$thisclass;?>">
			<div class="c-clas-text-1"><?=$row->no_order;?></div></td>
		<td class="<?=$thisclass;?>">
			<div class="c-clas-text-2"><?=$row->nama_customer_asal;?></div></td>
		<td class="<?=$thisclass;?>">
			<div class="c-clas-text-2"><?=$row->nama_customer_tujuan;?></div></td>
		<td class="<?=$thisclass;?>">
			<div class="c-clas-text-2"><?=tg_indo(date($row->tgl_perkiraan_selesai));?></div></td>
		<td class="<?=$thisclass;?>">
			<div class="c-clas-text-2"><?=ucwords($row->status_order); ?></div></td>
		<td class="<?=$thisclass;?>">
        		<div class="c-clas-text-2" style="visibility:visible"><?=ucwords($row->status_bayar);?></div>
        		<span id="bayar<?=$no;?>"></span>
        	</td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?php
		echo number_format($jum_shu);
		?> dari <?php echo $jum_sertifikat."&nbsp;&nbsp;"; ?>
        </div></td>
	</tr>
<? } ?>
</table>
<div style="clear:both"></div>
			<div class="textambahan" align="center" >Display #<?=$limit;?>
			&nbsp;&nbsp; Page Result - <?=$page;?> of <?=$pages;?>
			</div>
</body>
</html>
