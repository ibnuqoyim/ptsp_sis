
<center><h2 align="center">Laporan Evaluasi</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>Tgl. Evaluasi / Rapat</th>
            <th>No. Evaluasi</th>
            <th>Isi Rapat</th>
            <th>Keputusan Rapat</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderEvaluasi" ){?>
            <th colspan="2">Action</td>
            <?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderEvaluasi as $row){
    $no++;  
    ?>
    <tr>
        <?php if($this->session->flashdata('tampung')){ ?>
        <td></td>
        <? } ?>
        <td><div><?=$no;?></div></td>
        <td><div><?=$row->tgl_evaluasi?></div></td>
        <td><div><?=$row->no_evaluasi;?></div></td>
        <td><div><?=$row->isi_evaluasi;?></div></td>
        <td><div><?=$row->keputusan_evaluasi;?></div></td>
        
    <? if($this->uri->segment(2)=="orderEvaluasi" ) { ?>
        <td colspan="2">
                <div>
                <?=anchor('order/delorderEvaluasi/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_evaluasi,
                img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
                array('title'=>'Hapus','alt'=>'Hapus',
                'onclick'=>'return confirm(\'Yakin '.$row->kd_order_evaluasi.' ingin dihapus?\')'));?>
                </div>
        </td>
    <? }?> 

    
    </tr>
<?}?>

</table>