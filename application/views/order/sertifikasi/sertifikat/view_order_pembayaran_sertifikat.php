<center><h2 align="center">Pembayaran</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>Nomor</th>
            <th>Tgl. Pbayar</th>
            <th>Jumlah bayar</th>
            <th>dari</th>
            <th>Untuk</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderPembayaran"){?>
			<th colspan="2">Hapus</td>
			<th colspan="2">Cetak</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderPembayaran as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>       
		<td><div><?=$row->no_pembayaran;?></div></td>		
		<td><div><?=$row->tgl_bayar;?></div></td>
		<td><div><?=$row->nilai_bayar;?></div></td>
		<td><div><?=$row->nama_pembayar;?></div></td>
		<td><div><?=$row->tujuan_pembayaran;?></div></td>
	
	
        
	<? if($this->uri->segment(2)=="orderPembayaran" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/delOrderPembayaran/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_pembayaran,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_pembayaran.' ingin dihapus?\')'));?>
				</div>
		</td>
		<td colspan="2">
				<div>
				<?=anchor_popup('order/orderKwitansi/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_pembayaran,
				img(array('src'=>'images/print1.jpg','border'=>'0','height'=>'16')),
				array('title'=>'cetak','alt'=>'cetak'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>