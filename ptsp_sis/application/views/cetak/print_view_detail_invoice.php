<table border="1" cellpadding="0" cellspacing="0" width="100%" >
	<tr><?=form_open(current_url());?>
    	<?php if($this->session->flashdata('tampung')){ ?>proses
		<td class="c-table-xa"></td>
        <? } ?>
        <td class="c-table-xa" align="left" width="8">No</td>
	<td class="c-table-xa" align="left">Jenis/Nama&nbsp;Contoh</td>
        <td class="c-table-xa" align="left">No.&nbsp;Analisis</td>
			 
	<td class="c-table-xa">Jumlah Contoh</td>
	<td class="c-table-xa">Harga</td>		
	<td class="c-table-xa">Jumlah</td>
		
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
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=$row->jenis_contoh;?>/<?=$row->nama_contoh;?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=$row->no_pengujian;?></div></td>	
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center"><?=$row->jumlah_contoh;?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center">
		<?=formatRupiah($row->harga_subtotal/$row->jumlah_contoh);?></div></td>
	
	<td class="<?=$thisclass;?>">
	<div class="c-clas-text-1" style="text-align:right" title="<?=$subtotal_title;?>"><?=formatRupiah($row->harga_subtotal);?>
	</div>
	</td>
	
	</tr>
	
<?}?>
	<tr>
		<td class="<?=$thisclass;?>" colspan="5">
		<div class="c-clas-text-1" style="text-align:center" >Biaya Pengujian</div></td>
		<td class="<?=$thisclass;?>"  width="170" >
			<div  style="text-align:right" ><?=formatRupiah($totbiayaorder);?></div>
		</td>
	
	
	</tr>
</table>
