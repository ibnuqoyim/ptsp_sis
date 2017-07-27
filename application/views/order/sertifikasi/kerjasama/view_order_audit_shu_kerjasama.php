 <center><h2 align="center">Laporan Sertifikat Hasil Uji (SHU)</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>No. BHPCA</th>
            <th>No. SHU</th>
            <th>Tgl.<br>Terbit SHU</th>
            <th>Tgl.<br>SHU diterima</th>
            
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderAuditSHU as $row){
    $no++;  
    ?>
    <tr>
        <?php if($this->session->flashdata('tampung')){ ?>
        <td></td>
        <? } ?>
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->no_bhpc?></div></td>
        <td><div><?=$row->no_shu;?></div></td>
        <td><div><?=$row->tgl_shu;?></div></td>
        <td><div><?=$row->tgl_diterima_shu;?></div></td>
     </tr>
<?}?>

</table>