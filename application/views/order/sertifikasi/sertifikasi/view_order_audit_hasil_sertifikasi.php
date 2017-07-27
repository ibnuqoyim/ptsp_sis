
<center><h2 align="center">Hasil Audit</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No.</th>
        	<th>Tgl.<br>Temuan</th>
            <th>Tgl.<br>diterima</th>
            <th>Tgl.<br>Target<br>penyelesain</th>
            <th>Tgl.<br>Tindakan<br>Perbaiakan <br>Diterima</th>
            <th>Tgl.<br>Tindakan<br>Perbaiakan</th>
            <th>Tgl.<br>verifikasi<br>Tindakan<br>Perbaiakan</th>
            <th>Kategori</th>
            <th>status</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderAuditHasil" ){?>
			<th colspan="2">Action</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderAuditHasil as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>
		<td><div><?=$no;?></div></td>
		<td><div><?=$row->tgl_temuan_audithasil?></div></td>
		<td><div><?=$row->tgl_diterima_audithasil;?></div></td>
		<td><div><?=$row->tgl_targert_penyelesaian_audithasil;?></div></td>
		<td><div><?=$row->tgl_terima_tindakanperbaikan_audithasil;?></div></td>
		<td><div><?=$row->tgl_tindakanperbaikan_audithasil;?></div></td>
		<td><div><?=$row->tgl_verifikasi_tindakanperbaikan_audithasil;?></div></td>
		<td><div><?=$row->kategori_temuan_audithasil;?></div></td>
		<td><div><?=$row->status_temuan_audithasil;?></div></td>
        
	<? if($this->uri->segment(2)=="orderAuditHasil" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/derAuditHasilEdit/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_audithasil,
				img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
		   		array('title'=>'Edit','alt'=>'Edit'));?> | &nbsp;&nbsp;
				<?=anchor('order/delorderAuditHasil/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_audithasil,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_audithasil.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>