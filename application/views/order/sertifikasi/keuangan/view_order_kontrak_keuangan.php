
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
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderKontrak" ){?>
            <th colspan="2">Action</td>
            <?}?>
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
        
    <? if($this->uri->segment(2)=="orderKontrak" ) { ?>
        <td colspan="2">
                <div>
                <?=anchor_popup('order/viewOrderKontrak/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_kontrak,
                img(array('src'=>'images/preview.gif','border'=>'0','height'=>'16')),
                array('title'=>'view','alt'=>'view'));?> 
        </td>
    <? }?> 

    
    </tr>
<?}?>

</table>