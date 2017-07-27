<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".ucfirst($this->uri->segment(2));?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
	<table width="550" class="tablefield">
	<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Nama</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'nama','class'=>'input','maxlength'=>'255'));?>  * <?=form_error('nama')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tempat Lahir </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Tempat_lahir','class'=>'input','maxlength'=>'255'));?>  * <?=form_error('Tempat_lahir')?></td>
				</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Lahir </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Tanggal_Lahir','value'=>'','id'=>'Tanggal_Lahir','size'=>'10','maxlength'=>'10'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Jenis Kelamin </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Jenis_Kelammin','class'=>'input','maxlength'=>'1'));?>  * <?=form_error('Jenis_Kelammin')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Usia</td>
				<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Usia','class'=>'input','value'=>$Usia,'maxlength'=>'11','size'=>'50'));?> * <?=form_error('Usia')?> </td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Nip</td>
				<td width="20" valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Nip','class'=>'input','value'=>$Nip,'maxlength'=>'20','size'=>'30'));?> * <?=form_error('Nip')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Pangkat</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Pangkat','class'=>'input','value'=>$Pangkat,'maxlength'=>'255','size'=>'30'));?> * <?=form_error('Pangkat')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Gol Ruang </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Gol_Ruang','class'=>'input','value'=>$Gol_Ruang,'maxlength'=>'255'));?>  * <?=form_error('Gol_Ruang')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">T M T Pangkat </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'T_M_T_Pangkat','value'=>'','id'=>'T_M_T_Pangkat','size'=>'10','maxlength'=>'10'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Jabatan</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Jabatan','class'=>'input','value'=>$Jabatan,'maxlength'=>'255'));?>  
			    * <?=form_error('Jabatan')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">T M T Jabatan </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'T_M_T_Jabatan','value'=>'','id'=>'T_M_T_Jabatan','size'=>'10','maxlength'=>'10'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Masa kerja Tahun </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Masa_Kerja_TH','class'=>'input','value'=>$Masa_Kerja_TH,'maxlength'=>'11'));?>  * <?=form_error('Masa_Kerja_TH')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Masa kerja Bulan </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'Masa_Kerja_BLN','class'=>'input','value'=>$Masa_Kerja_BLN,'maxlength'=>'11'));?>  * <?=form_error('Masa_Kerja_BLN')?></td>
			</tr>
			<? } ?>
		<tr>
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="submit" class="button">Simpan</button>&nbsp;
			<button type="button" onClick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" class="button">Kembali</button>
		</td>
	</tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>