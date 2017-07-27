<center><h2 align="center">Jadwal Audit</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>Tgl. Audit</th>
            <th>waktu</th>
            <th>Deskripsi</th>
            <th>Nama singkat Auditor</th>
            
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderJadwalDetail as $row){
	$no++;	
	?>
	<tr>
        
		<td><div><?=$row->tgl_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->waktu_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->deskripsi_audit_jadwaldetail;?></div></td>
		<td><div><?=$row->singkatan_nama_auditor;?></div></td>
        
	
	</tr>
<?}?>

</table>