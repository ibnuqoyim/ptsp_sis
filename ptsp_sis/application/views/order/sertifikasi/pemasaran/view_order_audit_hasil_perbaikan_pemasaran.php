
<center><h2 align="center">Daftar Penaganan Tindakan perbaikan</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No.</th>
        	<th>Tgl. diterima dari perusahaan</th>
            <th>Tgl. diberikan ke auditor</th>
            <th>Tgl. Kembali dari auditor</th>
             <th>Tgl. dikembalikan ke perushaan</th>
            <th>nama Auditor</th>
            <th>Status Hasil Perbaikan</th>
            <th>Keterangan</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderAuditHasil" ){?>
			<th colspan="2">Action</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderAuditHasilPerbaikan as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>
		<td><div><?=$no;?></div></td>
		<td><div><?=$row->tgl_diterima_dari_perusahaan;?></div></td>
		<td><div><?=$row->tgl_diberikan_ke_auditor;?></div></td>
		<td><div><?=$row->tgl_diterima_dari_auditor;?></div></td>
		<td><div><?=$row->tgl_dkembalikan_ke_perusahaan;?></div></td>
		<td><div><?=$this->mAuditor->readAuditor($row->kd_auditor)->nama_auditor;?></div></td>
		<td><div><?=$row->status_perbaikanhasil;?></div></td>
		<td><div><?=$row->keterangan;?></div></td>
	<? if($this->uri->segment(2)=="orderAuditHasil" ) { ?>
		<td colspan="2">
				<div>
				<!--<?=anchor('order/orderAuditHasilEditPerbaikan/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_perbaikanhasil,
				img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
		   		array('title'=>'Edit','alt'=>'Edit'));?> | &nbsp;&nbsp;-->
				<?=anchor('order/delOrderAuditHasilPerbaikan/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_perbaikanhasil,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.@$row->kd_perbaikanhasil.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>
