<center><h2 align="center">Pabrik</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>Pabrik</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>No. Fax</th>
            <th>Jml Karyawan</th>
            <th>Standar S.Mutu</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderPabrik" ){?>
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
		<td><div><?=$row->nama_pabrik;?></div></td>
		<td><div><?=$row->alamat_pabrik;?></div></td>
		<td><div><?=$row->telepon_pabrik;?></div></td>
		<td><div><?=$row->fax_pabrik;?></div></td>
		<td><div><?=$row->jumlah_karyawan_pabrik;?></div></td>
		<td><div><? 
				$smm=$this->mSMM->readSMM($row->kd_sertifikasi_smm);
				if ($smm){
					echo $smm->nama_sertifikasi_smm	;
				}
				?></div></td>
	
        
	<? if($this->uri->segment(2)=="orderPabrik" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/delOrderPabrik/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_pabrik,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_order_pabrik.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>