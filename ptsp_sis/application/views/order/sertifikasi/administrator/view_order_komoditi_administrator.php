<center><h2 align="center">Komoditi</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>No SNI</th>
            <th>Komoditi</th>
            <th>Tipe Sertifikasi</th>
            <th>Jenis/Tipe Komoditi</th>
            <th>Merek Dagang</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderKomoditi" ){?>
			<th colspan="2">Action</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($result as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>
        <td><?=(($page-1)*$limit)+$no;?></td>
		<td><div><?=$row->no_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->nama_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->tipe_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->jenis_produk_komoditi;?></div></td>
		<td><div><?=$row->merk_dagang_komoditi;?></div></td>
	
	
        
	<? if($this->uri->segment(2)=="orderKomoditi" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/delOrderKomoditi/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_komoditi,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_order_komoditi.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>