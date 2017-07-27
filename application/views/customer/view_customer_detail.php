<center><h2 align="center">Daftar Detail Komoditi</h2></center>
<table border="0" cellpadding="0" cellspacing="0" width="100%" >
	<tr><?=form_open(current_url());?>
    	<?php if($this->session->flashdata('tampung')){ ?>proses
		<td class="c-table-xa"></td>
        <? } ?>
        <td class="c-table-xa" align="left" width="8">No</td>
        <td class="c-table-xa" align="left">Nama Komoditi</td>
	<td class="c-table-xa" align="left">Tipe Komoditi</td>
	<td class="c-table-xa" align="left">Brand Komoditi</td>
	<td class="c-table-xa" align="left">Kapasitas Produksi</td>
	
	<?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="DetailKomoditi" ){?>
		<td class="c-table-xa" width="30">Action</td>
		<td class="c-table-xa"></td>
	<?}?>
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
	
	?>
	<tr class="row0">
        <?php if($this->session->flashdata('tampung')){ ?>
		<td class="<?=$thisclass2;?>" style="border-left:solid 1px" align="center"></td>
        <? } ?>
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
	<td class="<?=$thisclass;?>">
		<div class="c-clas-text-1"><?=$row->nama_komoditi;?></div>
	</td>
	<td class="<?=$thisclass;?>">
		<div class="c-clas-text-1"><?=$row->tipe_komoditi;?></div>
	</td>
	<td class="<?=$thisclass;?>">
		<div class="c-clas-text-1"><?=$row->brand_komoditi;?></div>
	</td>
	<td class="<?=$thisclass;?>">
		<div class="c-clas-text-1";?><?=$row->kapasitas_produksi;?></div></a>
	</td>
	
	
        
	<? if($this->uri->segment(2)=="DetailKomoditi" ) { ?>
		<td class="<?=$thisclass;?>" colspan="2"><div class="c-clas-text-2">
			<?=anchor('customer/editDetailKomoditi/'.@$row->kd_customer.'/'.@$row->kd_komoditi  ,
			img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
			array('title'=>'Edit','alt'=>'Edit'));?>&nbsp;|&nbsp;
			<?=anchor('customer/delDetailKomoditi/'.@$row->kd_customer.'/'.$row->kd_komoditi,
			img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
			array('title'=>'Hapus','alt'=>'Hapus',
			'onclick'=>'return confirm(\'Yakin '.$row->kd_komoditi.' ingin dihapus?\')'));?>
		</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>
