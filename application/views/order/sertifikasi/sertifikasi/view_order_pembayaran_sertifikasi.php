<center><h2 align="center">Pembayaran</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>Nomor</th>
            <th>Tgl. Pbayar</th>
            <th>Jumlah bayar</th>
            <th>dari</th>
            <th>Untuk</th>
            
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($resultOrderPembayaran as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>       
		<td><div><?=$row->no_pembayaran;?></div></td>		
		<td><div><?=$row->tgl_bayar;?></div></td>
		<td><div><?=$row->nilai_bayar;?></div></td>
		<td><div><?=$row->nama_pembayar;?></div></td>
		<td><div><?=$row->tujuan_pembayaran;?></div></td>
	
	</tr>
<?}?>
 </tbody>
</table>