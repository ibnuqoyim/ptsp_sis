 <center><h2 align="center">Laporan Sertifikat Hasil Uji (SHU)</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No.</th>
            <th>No. BHPCA</th>
            <th>No. SHU</th>
            <th>Tgl.<br>Terbit SHU</th>
            <th>Tgl.<br>SHU diterima</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderAuditSHU" ){?>
            <th colspan="2">Action</td>
            <?}?>
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
        
    <? if($this->uri->segment(2)=="orderAuditSHU" ) { ?>
        <td colspan="2">
                <div>
                <?=anchor('order/delorderAuditSHU/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_audit_shu,
                img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
                array('title'=>'Hapus','alt'=>'Hapus',
                'onclick'=>'return confirm(\'Yakin '.$row->kd_order_audit_shu.' ingin dihapus?\')'));?>
                </div>
        </td>
    <? }?> 

    
    </tr>
<?}?>

</table>