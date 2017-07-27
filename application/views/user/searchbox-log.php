<div class="form">
<?=form_open('user/aktivitas',array('id'=>'frmsearch'));?>
<fieldset>
<legend><b>Pencarian</b></legend>
<div style="margin-top:10px">
	<table border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" style="padding-bottom:5px" width="100"><div class="input-text-1">User ID </div></td>
			<td style="padding-bottom:5px"><?=form_input('userid',(isset($userid)? $userid:''),'class="input"');?></td>
		</tr>
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">IP</div></td>
			<td style="padding-bottom:5px"><?=form_input('ip',(isset($ip)? $ip:''),'class="input"');?></td>
		</tr>
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">URL</div></td>
			<td style="padding-bottom:5px"><?=form_input('url',(isset($url)? $url:''),'class="input" size="30"');?></td>
		</tr>
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">Action</div></td>
			<td style="padding-bottom:5px"><?=form_input('action',(isset($action)? $action:''),'class="input" size="30"');?></td>
		</tr>
        <!-- 
		<tr>
			<td align="right" style="padding-bottom:5px"><div class="input-text-1">Tanggal</div></td>
			<td style="padding-bottom:5px"><?=form_input(array('name'=>'tanggal','value'=>'','id'=>'tanggal','class'=>'input','size'=>'10','maxlength'=>'10'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style></td>
		</tr>
        //-->
		<tr><td></td>
			<td align="right">
				<a href="javascript:void();"><button type="submit" class="button">Cari</button></a>&nbsp;
				<a href="javascript:void();"><button type="button" class="button" onclick="goReset()">Reset</button></a>
            </td>
		</tr>
	</table>
</div></fieldset>
<?=form_close();?>
</div>
