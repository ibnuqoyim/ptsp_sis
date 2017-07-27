<? $this->load->view('view_header');?>
	<div>
		<ul class="nav nav-tabs" class="tabs">
    		<li><a href="<?=base_url();?>index.php/tarif/JenisSertifikasi">Tarif</a></li>
    		<li ><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/dokumen/ItemDokumen">Dokumen</a></li>
            <li><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/auditor">Auditor & Evaluator</a></li>
		</ul>
	
<p>&nbsp;<? if($this->errormsg) echo "<p>".$this->errormsg."</p>"; ?> </p>  
<div class="title"><?=$this->judul;?></div>	
<!--<p>
	<? $this->load->view('auditor/searchbox-auditor_sertifikasi');?>
</p> -->
<p>&nbsp;</p>
<p><?php 
	$tombol='<button type="button" style="border:none;cursor:pointer;background-color:transparent" 
		id="addbutton"><img src="images/add-File1.jpg" border="0"><br /><span class="textkolom">Tambah Baru</span></button>';
	if($this->session->userdata('profil')->groupname == 'super' || $this->session->userdata('profil')->groupname == 'admin' 
		|| $this->session->userdata('profil')->groupname == 'pemasaran' || 
		   			$this->session->userdata('profil')->groupname == 'sertifikasi'){
		echo anchor('auditor/index/-/-/add/',$tombol,'style="text-decoration:none"');
	}
   ?>
</p>

<? if(!empty($result)){?>
	<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No</th>
        	<th>Nama Auditor / Evaluator</th>
			<th>Jabatan</th>
			<th>Nama Singkat Auditor / Evaluator</th>
			<th>Action</th>
        </tr>
    </thead>

 <tbody>

	<?=form_open('tarif',array('id'=>'formExpand'));?>
	
		<?
		$no=0;
		foreach($result as $row){
			$no++;			
		?>
		<tr >
			
        	<td align="center" style="vertical-align:top"><?=(($page-1)*$limit)+$no;?></td>
        	<td style="vertical-align:top"><?=$row->nama_auditor;?></td>
       		<td style="vertical-align:top"><?=$row->jabatan_auditor;?></td>
       		<td style="vertical-align:top"><?=$row->singkatan_nama_auditor;?></td>

		<?php 
		if($this->session->userdata('profil')->groupname == 'super' || 
		   			$this->session->userdata('profil')->groupname == 'admin' || 
		   			$this->session->userdata('profil')->groupname == 'pemasaran'|| 
		   			$this->session->userdata('profil')->groupname == 'sertifikasi'){ ?>		
			<td  style="vertical-align:top">
				<div class="c-clas-text-2">
					<?=anchor('auditor/index/'.$row->kd_auditor."/-/edit",
					img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
					array('title'=>'Edit','alt'=>'Edit'));?>&nbsp;&nbsp;|&nbsp;&nbsp;
					<?=anchor('auditor/index/'.$row->kd_auditor."/-/del",
					img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
					array('title'=>'Hapus','alt'=>'Hapus','onclick'=>'return confirm(\'Yakin '.
					$row->nama_auditor.' ingin dihapus berikut turunannya?\')'));?>
				</div>
			</td>
			<? 
		} ?>
		</tr>
	<?
} ?>
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
<script language="javascript">

function collapse_tarif(no_order){
  if(document.getElementById('expand'+no_order).innerHTML==0){
	  <?php 
	  for($x=1;$x<=count($expandname);$x++){
		  echo "if(no_order==".$x.") { document.getElementById('expand".$x."').innerHTML='".$expandname[$x]."'; }\n";
	  }
	  ?>
	  document.getElementById('collapse_img' + no_order).src="images/min.jpg";
  }else{
    document.getElementById('expand'+no_order).innerHTML="";
	  document.getElementById('collapse_img' + no_order).src="images/plus.jpg";
  }
}
</script>
<? $this->load->view('view_footer');?>