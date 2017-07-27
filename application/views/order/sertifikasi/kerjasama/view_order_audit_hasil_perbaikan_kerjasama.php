
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
		<td><div><?=$row->status_perbaikanhasil;?></div></td>
		<td><div><?=$row->kd_auditor;?></div></td>
		<td><div><?=$row->keterangan;?></div></td>
	</tr>
<?}?>

</table>