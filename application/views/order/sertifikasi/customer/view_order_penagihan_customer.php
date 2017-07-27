<center><h2 align="center">Penagihan</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No. Penagihan</th>
            <th>Tgl. Penagihan</th>
            <th>Penagihan Ke</th>
            <th>Jumlah</th>
            <th>Panjar</th>
            <th>Saldo</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderPenagihan"){?>
			<th colspan="2">Cetak</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderInvoice as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>       
		<td><div><?=$row->no_invoice;?></div></td>		
		<td><div><?=$row->tgl_invoice;?></div></td>
		<td><div><?=$row->invoice_ke;?></div></td>
		<td><div><?=$row->harga_total;?></div></td>
		<td><div><?=$row->jumlah_bayar;?></div></td>
		<td><div><?=$row->sisa_bayar;?></div></td>
	
	
        
	<? if($this->uri->segment(2)=="orderPenagihan" ) { ?>
		
		<td colspan="2">
				<div>
				<?=anchor_popup('order/viewOrderPenagihan/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_invoice,
				img(array('src'=>'images/print1.jpg','border'=>'0','height'=>'16')),
				array('title'=>'cetak','alt'=>'cetak'));?>
				</div>
		</td>
	<? }?> 
	
	</tr>
<?}?>

</table>