<table border="1" cellpadding="0" cellspacing="0" width="100%" >
	<tr><?=form_open(current_url());?>
    	<?php if($this->session->flashdata('tampung')){ ?>proses
		<td class="c-table-xa"></td>
        <? } ?>
        <td class="c-table-xa" align="left" width="8">No</td>
        <td class="c-table-xa" align="center">Nama Biaya Lain</td>
	<td width="170" class="c-table-xa" align="center">Harga</td>
	<td class="c-table-xa" align="center">Jumlah Biaya Lain</td>
	<td class="c-table-xa" align="center">Satuan</td>
	<td class="c-table-xa" align="center">Jumlah</td>
	</tr>
<?
$no=0;
$totbiayalain=0;
foreach($resultbiaya_lain as $row){
	$totbiayalain +=$row->sub_total_biaya;
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
	?>
	<tr class="row0">
        <?php if($this->session->flashdata('tampung')){ ?>
		<td class="<?=$thisclass2;?>" style="border-left:solid 1px" align="center"></td>
        <? } ?>
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=$row->nama_biaya;?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:right">
		<?=formatRupiah($row->nilai_biaya);?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center">
		<?=number_format($row->jumlah_biaya);?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center">
		<?=$row->satuan_biaya;?></div></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:right" >
		<?=formatRupiah($row->sub_total_biaya );?>
	</div>
	
	</tr>
<?}?>
<tr>
<td colspan="5" class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center" >Biaya Lain-lain</td>
<td colspan="1" class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:right" >
	<?=formatRupiah($totbiayalain);?></div></td>
</tr>
</table>
