<center><h2 align="center">Komoditi</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>No SNI</th>
            <th>Komoditi</th>
            <th>Tipe Sertifikasi</th>
            <th>Jenis/Tipe Komoditi</th>
            <th>Merek Dagang</th>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($result as $row){
	$no++;	
	?>
	<tr>
        <td><?=(($page-1)*$limit)+$no;?></td>
		<td><div><?=$row->no_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->nama_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->tipe_sertifikasi_komoditi;?></div></td>
		<td><div><?=$row->jenis_produk_komoditi;?></div></td>
		<td><div><?=$row->merk_dagang_komoditi;?></div></td></tr>
<?}?>

</table>