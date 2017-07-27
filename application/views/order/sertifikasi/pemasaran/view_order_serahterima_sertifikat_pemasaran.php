<!--<p>&nbsp;</P>
    <p> <? 
        $tombol1='<span style="float:left">
                        <img src="images/printer.gif" border="0" height="40"><br />
                  <span class="textkolom"><b>Cetak</span></b></span>';
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

        //echo anchor('order/cetak/'.base64_encode(current_url()),
         //       $tombol1,'target="_blank" border="0" height ="40" style="text-decoration:none"');
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/SerahTerima/orderSerahTerima/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        ?>
        
    </P>
    <p>&nbsp;</P>
    <p>&nbsp;</P> 
-->
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
        <?php if($this->session->flashdata('tampung')){ ?>
        <td></td>
        <? } ?>
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