<?php $this->load->view('view_header');?>
<div class="content">
<!-- <p>
 	<?=$this->searchbox;?>
</p>-->
<p>&nbsp;</p>
<div style="clear:both"></div>
<p>
	<?php 
		$tombol='<button type="button" style="border:none;cursor:pointer;background-color:transparent" id="addbutton"><img src="images/add-File1.jpg" border="0"><br /><span class="textkolom">Tambah Baru</span></button>';
		//echo anchor('staff/add/',$tombol,'style="text-decoration:none"');
	?>
</p>
<?if(!empty($result)){?>
<?=form_open('staff',array('id'=>'formExpand'));?>
<table class="table table-condensed table-bordered table-striped">
	<thead>
	<tr class="info">
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Pangkat</th>
		<th>Jabatan</th>		
		<th>Satuan&nbsp;Kerja</th>
		<th>Action</th>
	</tr>
	</thead>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
?>
	<tr class="row0">
        <td align="center"><?=(($page-1)*$limit)+$no;?></td>
	   	<td><div class="c-clas-text-1"><?=$row->NIP;?></div></td>
	   	<td><div class="c-clas-text-2"><?=$row->Nama;?></div></td>
	   	<td><div class="c-clas-text-2"><?=$row->Pangkat;?></div></td>
	   	<td><div class="c-clas-text-2"><?=ucwords($row->Jabatan);?></div></td>
	   	<td><div class="c-clas-text-2"><?=$row->nama_satker;?></div></td>
	   	<td><div class="c-clas-text-2">
			<?=anchor('staff/view/'.$row->NIP,img(array('src'=>'images/preview.gif','border'=>'0','height'=>'16')),
			array('title'=>'View','alt'=>'View'));?>&nbsp;|&nbsp;
			<!--<?=anchor('staff/edit/'.$row->NIP,img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
			array('title'=>'Edit','alt'=>'Edit'));?>&nbsp;|&nbsp;-->
			<?=anchor('user/add/'.$row->NIP,img(array('src'=>'images/tambah.png','border'=>'0','height'=>'16')),
			array('title'=>'Jadikan User','alt'=>'Jadikan User'));?><!-- &nbsp;|&nbsp;
			<?=anchor('staff/del/'.$row->NIP,img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
			array('title'=>'Hapus','alt'=>'Hapus','onclick'=>'return confirm(\'Yakin '.$row->Nama.' ingin dihapus?\')'));?> 
			//-->
		</div>
	   </td>
	</tr>
<? } ?>
</table>
<div style="clear:both"></div>
<table border="0" align="center" cellpadding="0" cellspacing="0" id="menu-display">
	<tr>
		<td>
			<div class="textambahan" align="center" >Display #
			<?=form_dropdown('limit',array(5=>5,10=>10,30=>30,50=>50),$limit,'onchange="setLimit(this.value)"  class="input-option"');?>
			&nbsp;&nbsp; Page Result - <?=$page;?> of <?=$pages;?>
			</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	<?if($pages>1){?>
	<tr>
		<td align="center">
		<?if($page>1){?>
			<div class="button2-right"><div class="start"><?=anchor($pageurl.'index1','Start');?></span></div></div>
			<div class="button2-right"><div class="prev"><?=anchor($pageurl.'index'.($page-1),'Prev');?></span></div></div>
		<?} else {?>
			<div class="button2-right off"><div class="start"><span>Start</span></div></div>
			<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>
		<?}?>
			<div class="button2-left"><div class="page">
			<?
			$limitpages=15;//harus ganjil
			$halflimit=ceil(($limitpages-1)/2);
			$bf=$page-$halflimit;
			$af=$page+$halflimit;
			if($bf<1){
			$startpage=1;
			$endpage=$af+1-$bf;
			} elseif($af>$pages){
			$startpage=$bf-$af+$pages;
			$endpage=$pages;
			} else {
			$startpage=$bf;
			$endpage=$af;
			}
			if($startpage<1){$startpage=1;}
			if($endpage>$pages){$endpage=$pages;}
			for($i=$startpage;$i<=$endpage;$i++){
				if($i==$page){
					echo '<span>',$i,'</span> ';
				} else {
					echo anchor($pageurl.'index'.$i,$i).' ';
				}
			}
			?>
			</div></div>
			<?if($page<$pages){?>
			<div class="button2-left"><div class="next"><?=anchor($pageurl.'index'.($page+1),"Next");?></div></div>
			<div class="button2-left" style="margin-bottom:10px;"><div class="end"><?=anchor($pageurl.'index'.$pages,"End");?></div></div>
			<?} else {?>
			<div class="button2-left off"><div class="next"><span>Next</span></div></div>
			<div class="button2-left off" style="margin-bottom:10px;"><div class="end"><span>End</span></div></div>
			<?}?>
		</td>
	</tr>
	<?}?>
</table>
<?=form_close();?>
<? } ?>
</div>
<?=$this->javascript;?>
<?php $this->load->view('view_footer');?>