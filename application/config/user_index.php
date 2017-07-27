<?if(!empty($result)){?>
<?=form_open('user/delete',array('id'=>'formdelete'));?>
<table border="0" cellpadding="0" cellspacing="0" class="c-table-0">
	<tr>
		<td class="c-table-1" align="center"><input type="checkbox" style="margin:0px" id="chkall" /></td>
		<td class="c-table-x"><?=($ord=='users.username' && $srt=='asc')? anchor($ordurl."users.username/desc/$limit/index$page",'UserId'):anchor($ordurl."users.username/asc/$limit/index$page",'UserId');?></td>
		<td class="c-table-x"><?=($ord=='users.name' && $srt=='asc')? anchor($ordurl."users.name/desc/$limit/index$page",'Nama'):anchor($ordurl."users.name/asc/$limit/index$page",'Nama');?></td>
		<td class="c-table-x"><?=($ord=='users.position' && $srt=='asc')? anchor($ordurl."users.position/desc/$limit/index$page",'Posisi'):anchor($ordurl."users.position/asc/$limit/index$page",'Posisi');?></td>
		<td class="c-table-x"><?=($ord=='users.division' && $srt=='asc')? anchor($ordurl."users.division/desc/$limit/index$page",'Divisi'):anchor($ordurl."users.division/asc/$limit/index$page",'Divisi');?></td>
		<td class="c-table-x"><?=($ord=='groups.desc' && $srt=='asc')? anchor($ordurl."groups.desc/desc/$limit/index$page",'Group'):anchor($ordurl."groups.desc/asc/$limit/index$page",'Group');?></td>
		<td class="c-table-x"><?=($ord=='users.added_by' && $srt=='asc')? anchor($ordurl."users.added_by/desc/$limit/index$page",'Diaktifkan Oleh'):anchor($ordurl."users.added_by/asc/$limit/index$page",'Diaktifkan Oleh');?></td>
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
		<td class="<?=$thisclass;?>a" align="center"><input name="username[]" type="checkbox" class="chkall" value="<?=$row->username;?>" style="margin:0px"></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=anchor('user/edit/'.$row->username,$row->username);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=$row->name;?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->position);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=ucwords($row->division);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=$row->groupname;?></div></td>
		<td class="<?=$thisclass;?>" colspan="2"><div class="c-clas-text-2"><?=$row->added_by;?></div></td>
	</tr>
<?}?>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0" id="menu-display">
	<tr>
		<td>
			<div class="textambahan" align="center" >Display #
			<?=form_dropdown('limit',array(5=>5,10=>10,30=>30,50=>50),$limit,'onchange="setLimit(this.value)"  class="inputan-3"');?>
			&nbsp;&nbsp; Page Result - <?=$page;?> of <?=$pages;?>
			</div>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	<?if($pages>1){?>
	<tr>
		<td>
		<?if($page>1){?>
			<div class="button2-right"><div class="start"><?=anchor($pageurl.'index1','Start');?></span></div></div>
			<div class="button2-right"><div class="prev"><?=anchor($pageurl.'index'.($page-1),'Prev');?></span></div></div>
		<?} else {?>
			<div class="button2-right off"><div class="start"><span>Start</span></div></div>
			<div class="button2-right off"><div class="prev"><span>Prev</span></div></div>
		<?}?>
			<div class="button2-left"><div class="page">
			<?
			$limitpages=5;//harus ganjil
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
	
<div style="margin-top: 15px;" align="center">
	<?if(($this->userresult->groupname=='user' && $this->userresult->ijin_tulis) || $this->userresult->groupname=='super'){?>
		<button type="button" style="border:none;background-color:transparent" id="addbutton"><?=img('images/internal_files/add-File1.jpg');?><br /><span class="textkolom">Tambah</span></button>
	<?}?>
	<?if(($this->userresult->groupname=='user' && $this->userresult->ijin_hapus) || $this->userresult->groupname=='super'){?>
		<button type="submit" style="border:none;background-color:transparent"><?=img('images/internal_files/delete1.jpg');?><br /><span class="textkolom">Hapus</span></button>
	<?}?>
</div>
<?=form_close();?>
<?}?>