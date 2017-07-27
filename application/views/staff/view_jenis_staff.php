<?=$this->load->view('view_header');?>
  <table border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="20">&nbsp;</td>
  </tr>
  <tr>
      <td><?=$this->searchbox;?></td>
  </tr>
  </table>
<div style="clear:both"></div>
<?if(!empty($result)){?>
<?=form_open('user/delete',array('id'=>'formdelete'));?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="c-table-1" align="center"><input type="checkbox" style="margin:0px" id="chkall" /></td>
        <td class="c-table-x">No</td>
		<td class="c-table-x"><?=($ord=='staff.NIP' && $srt=='asc')? anchor($ordurl."staff.NIP/desc/$limit/index$page",'NIP'):anchor($ordurl."staff.NIP/asc/$limit/index$page",'NIP');?></td>
		<td class="c-table-x"><?=($ord=='staff.Nama' && $srt=='asc')? anchor($ordurl."staff.Nama/desc/$limit/index$page",'Nama'):anchor($ordurl."staff.Nama/asc/$limit/index$page",'Nama');?></td>
		<td class="c-table-x"><?=($ord=='staff.Pangkat' && $srt=='asc')? anchor($ordurl."staff.Pangkat/desc/$limit/index$page",'Pangkat'):anchor($ordurl."staff.Pangkat/asc/$limit/index$page",'Pangkat');?></td>
		<td class="c-table-x"><?=($ord=='staff.Gol_Ruang' && $srt=='asc')? anchor($ordurl."staff.Gol_Ruang/desc/$limit/index$page",'Golongan'):anchor($ordurl."staff.Gol_Ruang/asc/$limit/index$page",'Golongan');?></td>
		<td class="c-table-x"><?=($ord=='groups.desc' && $srt=='asc')? anchor($ordurl."groups.desc/desc/$limit/index$page",'Group'):anchor($ordurl."groups.desc/asc/$limit/index$page",'Group');?></td>
		<td class="c-table-x"><?=($ord=='staff.Jabatan' && $srt=='asc')? anchor($ordurl."staff.Jabatan/desc/$limit/index$page",'Jabatan'):anchor($ordurl."staff.Jabatan/asc/$limit/index$page",'Jabatan');?></td>
		<td class="c-table-6"></td>
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';}
	else {$thisclass='c-clas-3';}
?>
	<tr class="row0">
		<td class="<?=$thisclass;?>" style="border-left:solid 1px" align="center"><input name="username[]" type="checkbox" class="chkall" value="<?=trim($row->NIP);?>" style="margin:0px"></td>
        <td class="<?=$thisclass;?>"><?=(($page-1)*$limit)+$no;?></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=anchor('user/edit/'.$row->NIP,$row->NIP);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=$row->Nama;?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->Pangkat);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->Gol_Ruang);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=$row->groupname;?></div></td>
		<td class="<?=$thisclass;?>" colspan="2" style="border-right:solid 1px"><div class="c-clas-text-2"><?=$row->Jabatan;?></div></td>
	</tr>
<?}?>
</table>
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
<!-- 
<div style="margin-top: 15px;" align="center">
	<? if( /*($this->userresult->groupname=='user') ||*/ $this->session->userdata('profil')->groupname=='super'){?>
		<button type="button" style="border:none;background-color:transparent" id="addbutton"><?=img('images/add-File1.jpg');?><br /><span class="textkolom">Tambah</span></button>
	<?}?>
	<? if (/*($this->userresult->groupname=='user' && $this->userresult->ijin_hapus) ||*/ $this->session->userdata('profil')->groupname=='super'){?>
		<button type="submit" style="border:none;background-color:transparent"><?=img('images/delete1.jpg');?><br /><span class="textkolom">Hapus</span></button>
	<?}?>
</div>
//-->
<?=form_close();?>
<? } ?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
