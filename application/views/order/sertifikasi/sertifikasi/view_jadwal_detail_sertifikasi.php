<center><h2 align="center">Jadwal Audit</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>Tgl. Audit</th>
            <th>waktu</th>
            <th>Deskripsi</th>
            <th>Nama singkat Auditor</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderJadwalDetail" ){?>
			<th colspan="2">Action</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderJadwalDetail as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>
		<td><div><?=$row->tgl_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->waktu_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->deskripsi_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->singkatan_nama_auditor;?></div></td>
        
	<? if($this->uri->segment(2)=="orderJadwalDetail" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/delOrderJadwalDetail/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_audit_jadwaldetail,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_order_audit_jadwaldetail.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>