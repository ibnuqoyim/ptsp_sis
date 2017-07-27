
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
	</tr>
<?}?>

</table>