
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
            <!--<?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderSertifikat" ){?>
            <th colspan="2">Action</td>
            <?}?>-->
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
    <!--    
    <? if($this->uri->segment(2)=="orderSertifikat" ) { ?>
        <td colspan="2">
                <div>
                <?=anchor('order/delorderSertifikat/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_sertifikat,
                img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
                array('title'=>'Hapus','alt'=>'Hapus',
                'onclick'=>'return confirm(\'Yakin '.$row->kd_sertifikat.' ingin dihapus?\')'));?>
                </div>
        </td>
    <? }?> 
    -->
    
    </tr>
<?}?>

</table>