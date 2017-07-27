
<center><h2 align="center">Sertifikat</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>No Sertifikat</th>
            <th>Tgl Cetak</th>
            <th>Tgl Awal Berlaku</th>
            <th>Tgl Akhir berlaku</th>
            <th>Nama Penandatangan</th>
            <th>Tgl Penandatangan</th>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderSertifikat as $row){
    $no++;  
    ?>
    <tr>
        <?php if($this->session->flashdata('tampung')){ ?>
        <td></td>
        <? } ?>
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->no_sertifikat;?></div></td>
        <td><div><?=$row->tgl_cetak_sertifikat;?></div></td>
        <td><div><?=$row->tgl_awal_berlaku_sertifikat;?></div></td>
        <td><div><?=$row->tgl_akhir_berlaku_sertifikat;?></div></td>
        <td><div><?=$row->nama_penandatangan_sertifikat;?></div></td>
        <td><div><?=$row->tgl_penandatangan_sertifikat;?></div></td>
    </tr>
<?}?>

</table>