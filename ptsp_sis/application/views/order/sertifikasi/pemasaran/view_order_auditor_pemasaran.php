<center><h2 align="center">Auditor</h2></center>
<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>nama Auditor</th>
            <th>Nama Sinkat Auditor</th>
            <th>Jabatan</th>
            <th>Posisi Tim</th>
            <?if(!$this->session->flashdata('cetak') && $this->uri->segment(2)=="orderAuditor" ){?>
			<th colspan="2">Action</td>
			<?}?>
        </tr>
    </thead>

 <tbody>
<?
$no=0;
foreach($result as $row){
	$no++;	
	?>
	<tr>
        <?php if($this->session->flashdata('tampung')){ ?>
		<td></td>
        <? } ?>
        <td><?=(($page-1)*$limit)+$no;?></td>
		<td><div><?=$row->nama_auditor;?></div></td>
		<td><div><?=$row->singkatan_nama_auditor;?></div></td>
		<td><div><?=$row->jabatan_auditor;?></div></td>
		<td><div><?=$row->posisi_tim_auditor;?></div></td>
	
	
        
	<? if($this->uri->segment(2)=="orderAuditor" ) { ?>
		<td colspan="2">
				<div>
				<?=anchor('order/delOrderAuditor/'.@$row->kd_order_sertifikasi.'/'.@$row->kd_order_auditor,
				img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
				array('title'=>'Hapus','alt'=>'Hapus',
				'onclick'=>'return confirm(\'Yakin '.$row->kd_order_auditor.' ingin dihapus?\')'));?>
				</div>
		</td>
	<? }?> 

	
	</tr>
<?}?>

</table>