<html>
<head>
<base href="<?=base_url();?>" />
	<link rel="stylesheet" type="text/css" href="css/<?=($this->uri->segment(1)==="order" && $this->uri->segment(2)!="")?"flick/":"";?>screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chalsy.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="css/chalsy.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
    <link type="text/css" href="js/calendar/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="js/calendar/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
</head>
<body>
<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; Edit LHU";?></p>
<p><?=$this->errormsg;?></p>
<?=form_open_multipart(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="kd_lhu" value="<?=$kd_lhu;?>" id="<id="<?=@$kd_lhu;?>" />
	<input type="hidden" name="save" value="1" />
	<table width="550" class="tablefield">
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">No Order</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top">&nbsp;&nbsp;<?=$result->no_order;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Jenis Contoh</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top">&nbsp;&nbsp;<?=$result->jenis_contoh;?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">No LHU</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'no_lhu','class'=>'input','value'=>$no_lhu,'maxlength'=>'200')); ?>  * <?=form_error('no_lhu')?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Tgl Cetak</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'tgl_cetak','class'=>'input','value'=>mdate("%Y-%m-%d", strtotime($tgl_cetak))
,'id'=>'tgl_cetak','size'=>'10','maxlength'=>'10'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style> * <?=form_error('tgl_cetak');?></td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">File LHU</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top">
					<?=($file_lhu!="")?"<a href='$file_lhu' target='_blank'>".basename($file_lhu)."</a>":"-";?>
				</td>
			</tr>
			<tr>
				<td width="100" valign="top" class="input-text-1" style="padding-left:10px;">Replace File LHU</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><input type="file" name="userfile" class="input-option" size="20" /></td>
			</tr>
	
		<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
			<button type="submit" name="save" class="button" value="1">Simpan</button>&nbsp;
            <button type="button" onclick="javascript:window.location.href='<?=site_url()."/".$this->uri->segment(1);?>'" class="button">Kembali</button>
         </td>
    </tr>
	</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
</body>
</html>
