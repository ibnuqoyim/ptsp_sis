<center><h2 align="center">Penawaran</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>No Surat Penawaran</th>
            <th>Tgl Surat Penawaran</th>
            <th>Jml Biaya Penawaran</th> 
            <th>Cetak Surat Penawaran</th>
            <th>cetak Lampiran Penawaran</th> 
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
		<td><div><?=$row->no_penawaran;?></div></td>
		<td><div><?=$row->tgl_penawaran;?></div></td>
		<td><div>Rp. <?=number_format($row->harga_total_penawaran,2);?></div></td>
		<td>
				<div>
				<?=anchor_popup('order/viewOrderSuratPenawaran/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_penawaran,
				img(array('src'=>'images/print1.jpg','border'=>'0','height'=>'16')),
				array('title'=>'cetak','alt'=>'cetak'));?>
				</div>
		</td>
		<td>
				<div>
				<?=anchor_popup('order/viewOrderLampiranPenawaran/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_penawaran,
				img(array('src'=>'images/print1.jpg','border'=>'0','height'=>'16')),
				array('title'=>'cetak','alt'=>'cetak'));?>
				</div>
		</td>
	
	</tr>
<?}?>

</table>