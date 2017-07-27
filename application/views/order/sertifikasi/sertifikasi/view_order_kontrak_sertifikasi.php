
<center><h2 align="center">Kontrak</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>No Kontrak</th>
            <th>Tgl Cetak Sertifikat</th>
            <th>Tgl.Ditantangani BBK</th>
            <th>Tgl.Ditantangani Perusahaan</th>
            <th>Tgl.Diterima BBK</th>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderKontrak as $row){
    $no++;  
    ?>
    <tr>
        <?php if($this->session->flashdata('tampung')){ ?>
        <td></td>
        <? } ?>
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->no_kontrak;?></div></td>
        <td><div><?=$row->tgl_cetak_kontrak;?></div></td>
        <td><div><?=$row->tgl_penandatangan_bbk_kontrak;?></div></td>
        <td><div><?=$row->tgl_penandatangan_perusahaan_kontrak;?></div></td>
        <td><div><?=$row->tgl_diterima_kontrak;?></div></td>
        
     </tr>
<?}?>

</table>