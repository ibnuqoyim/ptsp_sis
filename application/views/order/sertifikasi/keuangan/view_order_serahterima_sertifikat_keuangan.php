<center><h2 align="center">Sertifikat</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>No Sertifikat</th>
            <th>Tgl Cetak Sertifikat</th>
            <th>Tgl Awal Berlaku</th>
            <th>Tgl Akhir berlaku</th>
            <th>Tgl Penyerahan</th>
            <th>Metode Penyerahan</th>
            <th>Nama Penyerahan</th>
            <th>Nama Penerima</th>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderSertifikat as $row){
    $no++;  
    ?>
    <tr>
       
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->no_sertifikat;?></div></td>
        <td><div><?=$row->tgl_cetak_sertifikat;?></div></td>
        <td><div><?=$row->tgl_awal_berlaku_sertifikat;?></div></td>
        <td><div><?=$row->tgl_akhir_berlaku_sertifikat;?></div></td>
        <td><div><?=$row->tgl_serah_sertifikat;?></div></td>
        <td><div><?=$row->metode_serah_sertifikat;?></div></td>
        <td><div><?=$row->nama_penyerah_sertifikat;?></div></td>
        <td><div><?=$row->nama_penerima_sertifikat;?></div></td>
    </tr>
<?}?>

</table>