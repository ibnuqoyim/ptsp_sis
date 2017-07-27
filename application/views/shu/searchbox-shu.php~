<div class="form">
<?=form_open('shu',array('id'=>'frmsearch', 'class'=>'ajax'));?><fieldset>
<legend><span class="title">Pencarian</span></legend>
<div style="margin-top:10px">
<table border="0" align="right" cellpadding="0" cellspacing="0" style="padding:0px">
	<tr>
		<td align="right" style="padding-bottom:5px" width="150"><div class="input-text-1">No. Order</div></td>
		<td style="padding-bottom:5px">
			<div class="formelement">
			<?=form_input('no_order',(isset($no_order)? $no_order:''),'class="input"');?>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" style="padding-bottom:5px" width="150"><div class="input-text-1">No. Analisis/Pengujian</div></td>
		<td style="padding-bottom:5px">
			<div class="formelement">
			<?=form_input('no_pengujian',(isset($no_pengujian)? $no_pengujian:''),'class="input"');?>
			</div>
		</td>
	</tr>
	<tr>
		<td align="right" style="padding-bottom:5px" width="150"><div class="input-text-1">No. SHU</div></td>
		<td style="padding-bottom:5px">
			<?=form_input('no_shu',(isset($no_lhu)? $no_lhu:''),'class="input"');?>
		</td>
	</tr>
        <tr>
            	<td align="right" style="padding-bottom:5px" width="150"><div class="input-text-1">Tanggal Cetak</div></td>
            	<td style="padding-bottom:5px">
			<?=form_input(array('name'=>'tgl_cetak','value'=>'','id'=>'tgl_cetak',
				'class'=>'input','size'=>'10','maxlength'=>'10'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</td>
        </tr>
	<tr>
		<td align="right" style="padding-bottom:5px" width="150"><div class="input-text-1">File SHU</div></td>
		<td style="padding-bottom:5px"><?=form_input('file_shu',(isset($file_shu)? $file_shu:''),'class="input"');?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right">
			<button type="submit" class="button" >Cari</button>&nbsp;
			<button type="button" class="button" onclick="goReset()">Reset</button>
		</td>
	</tr>
</table>
</div>	</fieldset>
<?=form_close();?>
</div>
