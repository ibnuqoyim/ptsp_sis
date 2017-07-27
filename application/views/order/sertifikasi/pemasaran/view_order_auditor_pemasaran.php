<center><h2 align="center">Auditor</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>nama Auditor</th>
            <th>Nama Sinkat Auditor</th>
            <th>Jabatan</th>
            <th>Posisi Tim</th>
            
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
		<td><div><?=$row->nama_auditor;?></div></td>
		<td><div><?=$row->singkatan_nama_auditor;?></div></td>
		<td><div><?=$row->jabatan_auditor;?></div></td>
		<td><div><?=$row->posisi_tim_auditor;?></div></td>
	</tr>
<?}?>

</table>