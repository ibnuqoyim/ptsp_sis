
<center><h2 align="center">Laporan Evaluasi</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>Tgl. Evaluasi / Rapat</th>
            <th>No. Evaluasi</th>
            <th>Isi Rapat</th>
            <th>Keputusan Rapat</th>
           
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderEvaluasi as $row){
    $no++;  
    ?>
    <tr>
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->tgl_evaluasi?></div></td>
        <td><div><?=$row->no_evaluasi;?></div></td>
        <td><div><?=$row->isi_evaluasi;?></div></td>
        <td><div><?=$row->keputusan_evaluasi;?></div></td>
    </tr>
<?}?>

</table>