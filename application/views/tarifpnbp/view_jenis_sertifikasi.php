<?php $this->load->view('view_header');?>
	<div>
		<ul class="nav nav-tabs" class="tabs">
    		<li class="active"><a data-toggle="tab"  href="#">Tarif</a></li>
    		<li><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/dokumen/ItemDokumen">Dokumen</a></li>
            <li><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <?if($this->session->userdata('profil')->groupname != 'customer'){ ?>
				<li><a href="<?=base_url();?>index.php/auditor">Auditor</a></li>
			<? }?>
		</ul>
	<div style="clear:both"></div>
    <p>&nbsp;</P>
<p>
      		&nbsp;<? if($this->errormsg) echo "<p>".$this->errormsg."</p>"; ?> 
</p>  
<div class="title"><?=$this->judul;?></div>	
<!--<p>
	<? $this->load->view('tarifpnbp/searchbox-jenis_sertifikasi');?>
</p>-->
<p>&nbsp;</p>
<p><?php 
	$tombol='<button type="button" style="border:none;cursor:pointer;background-color:transparent" 
		id="addbutton"><img src="images/add-File1.jpg" border="0"><br /><span class="textkolom">Tambah Baru</span></button>';
	if($this->session->userdata('profil')->groupname == 'super' || $this->session->userdata('profil')->groupname == 'admin' 
		|| $this->session->userdata('profil')->groupname == 'penerima'){
		echo anchor('tarif/JenisSertifikasi/-/-/add/',$tombol,'style="text-decoration:none"');
	}
   ?>
</p>

<? if(!empty($result)){?>
	<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr class="info">
        	<th>No</th>
			<th>Nama Jenis Tarif Sertifikasi</th>
			<?php
				if($this->session->userdata('profil')->groupname == 'super' || 
		  			 $this->session->userdata('profil')->groupname == 'admin'|| 
		  			 $this->session->userdata('profil')->groupname == 'pemasaran'){?>
			<th>Action</th>
			<?php }?>
        </tr>
    </thead>

 <tbody>

	<?=form_open('tarif',array('id'=>'formExpand'));?>
	
		<?
		$no=0;
		foreach($result as $row){
			$no++;
			
			$treeTarif=$this->mTarif->getTarif('',$row->kd_sertifikasi_jenis,true);
			///print_r($treeTarif);
			$expandname[$no] ="";
			if($treeTarif){
				$expandname[$no] = "<ol class=\"list-group\">";
				foreach($treeTarif as $Tarifna){
					$expandname[$no] .= "<li class=\"list-group-item\"><b>".anchor('tarif/InputItem/'.$Tarifna->kd_sertifikasi_jenistarif , $Tarifna->nama_jenistarif)."</b></li>";
					$treeItem=$this->mTarif->getItem('',$Tarifna->kd_sertifikasi_jenistarif,true);
						if($treeItem){
							$expandname[$no] .= "<ul class=\"list-group-item\" type=\"a\">";
							foreach($treeItem as $Itemna){
								$expandname[$no] .= "<li>".anchor('tarif/InputItem/'.$Tarifna->kd_sertifikasi_jenistarif.'/'.
                                                $Itemna->kd_sertifikasi_jenistarifitem .'/-/-/detail', $Itemna->nama_sertifikasi_jenistarifitem).
                                                " | Rp. ".number_format($Itemna->harga_sertifikasi_jenistarifitem).",-</li>";
							}
							$expandname[$no] .= "</ul>";
						}
				}
				$expandname[$no] .= "</ol>";
			}
		?>
		<tr >
			
        	<td align="center" style="vertical-align:top"><?=(($page-1)*$limit)+$no;?></td>

       	
		<td >
			<div class="c-clas-text-1">
				<?php
				if($this->session->userdata('profil')->groupname == 'super' || 
		  			 $this->session->userdata('profil')->groupname == 'admin'|| 
		  			 $this->session->userdata('profil')->groupname == 'pemasaran'){?>		
						<?=anchor('tarif/JenisTarif/'.$row->kd_sertifikasi_jenis,
							img(array('src'=>'images/tambah.png','border'=>'0','height'=>'20')),
							array('title'=>'Tinput Tarif','alt'=>'input tarif'));?> 
						<?=anchor('tarif/JenisTarif/'.$row->kd_sertifikasi_jenis,ucfirst($row->nama_sertifikasi_jenis)."[$row->kd_sertifikasi_jenis]",
						array('title'=>'Input Tarif','alt'=>'Input Tarif'));?>
				<? 
				} else {
						echo ucfirst($row->nama_sertifikasi_jenis)." [$row->kd_sertifikasi_jenis]"; 
				} ?> &nbsp;&nbsp;
				<? 
				if($expandname[$no] != "") { 
				?>
					<!--<a href="javascript:void()" onclick="collapse_tarif(<?=$no;?>)">
					<?=img(array('src'=>'images/plus.jpg','border'=>'0','height'=>'16','id'=>'collapse_img'.$no));?></a>
					<div class="c-clas-text-1" id="expand<?=$no;?>"></div>	-->
					<?=$expandname[$no];?>
						
				<? 
				}//=$treeview->Render();"?>

			</div><?
				?>
		</td>

		<?php 
		if($this->session->userdata('profil')->groupname == 'super' || 
		   			$this->session->userdata('profil')->groupname == 'admin' || 
		   			$this->session->userdata('profil')->groupname == 'pemasaran'){ ?>		
			<td  style="vertical-align:top">
				<div class="c-clas-text-2">
					<?=anchor('tarif/JenisTarif/'.$row->kd_sertifikasi_jenis,img(array('src'=>'images/tambah.png','border'=>'0','height'=>'20')),
					array('title'=>'Tambah Jenis Tarif','alt'=>'Tambah Tarif'));?>&nbsp;&nbsp;|&nbsp;&nbsp;
					<?=anchor('tarif/JenisSertifikasi/'.$row->kd_sertifikasi_jenis."/-/edit",
					img(array('src'=>'images/edit.gif','border'=>'0','height'=>'16')),
					array('title'=>'Edit','alt'=>'Edit'));?>&nbsp;&nbsp;|&nbsp;&nbsp;
					<?=anchor('tarif/JenisSertifikasi/'.$row->kd_sertifikasi_jenis."/-/del",
					img(array('src'=>'images/del.gif','border'=>'0','height'=>'16')),
					array('title'=>'Hapus','alt'=>'Hapus','onclick'=>'return confirm(\'Yakin '.
					$row->nama_sertifikasi_jenis.' ingin dihapus berikut turunannya?\')'));?>
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