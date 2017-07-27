<?=$this->load->view('view_header');?>
  <table border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="20">&nbsp;</td>
  </tr>
  <tr>
      <td><?=$this->searchbox;?></td>
  </tr>
  </table>
<div style="clear:both"><h3>Aktivitas User</h3></div>
<? if(!empty($result)){ ?>
<?=form_open('userlog',array('id'=>'formExpand'));?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td class="c-table-1" width="5"></td>
        <td class="c-table-x" align="left" width="10"><?=($ord=='userid' && $srt=='asc')? anchor($ordurl."userid/desc/$limit/index$page",'No'):anchor($ordurl."userid/asc/$limit/index$page",'No');?></td>
        <td class="c-table-x" align="left" width="10"><?=($ord=='userid' && $srt=='asc')? anchor($ordurl."userid/desc/$limit/index$page",'UserID'):anchor($ordurl."userid/asc/$limit/index$page",'UserID');?></td>
		<td class="c-table-x"><?=($ord=='ip' && $srt=='asc')? anchor($ordurl."ip/desc/$limit/index$page",'IP&nbsp;Address'):anchor($ordurl."ip/asc/$limit/index$page",'IP&nbsp;Address');?></td>
		<td class="c-table-x"><?=($ord=='time' && $srt=='asc')? anchor($ordurl."time/desc/$limit/index$page",'Waktu'):anchor($ordurl."time/asc/$limit/index$page",'Waktu');?></td>
		<td class="c-table-x"><?=($ord=='url' && $srt=='asc')? anchor($ordurl."url/desc/$limit/index$page",'URL'):anchor($ordurl."url/asc/$limit/index$page",'URL');?></td>
		<td class="c-table-x"><?=($ord=='action' && $srt=='asc')? anchor($ordurl."action/desc/$limit/index$page",'Action'):anchor($ordurl."action/asc/$limit/index$page",'Action');?></td>
		<td class="c-table-6"></td>
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}
?>
	<tr class="row0">
		<td class="<?=$thisclass2;?>" style="border-left:solid 1px" align="center"></td>
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=anchor('user/aktivitas_view/'.$row->no_urut,$row->userid);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=anchor('user/aktivitas_view/'.$row->no_urut,$row->ip);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=anchor('user/aktivitas_view/'.$row->no_urut,$row->time);?></div></td>
		<td class="<?=$thisclass;?>"><div class="c-clas-text-2"><?=anchor('user/aktivitas_view/'.$row->no_urut,ucwords($row->url));?></div></td>
		<td class="<?=$thisclass;?>" colspan="2"><div class="c-clas-text-2"><?=$row->action;?></div></td>
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
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
