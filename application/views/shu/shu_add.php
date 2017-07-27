<html>
<head>
<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/<?=($this->uri->segment(1)==="order" && $this->uri->segment(2)!="")?"flick/":"";?>screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/chalsy.js"></script>
    <link rel="stylesheet" type="text/css" href="css/chalsy.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link type="text/css" href="js/calendar/css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="js/calendar/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="js/calendar/js/jquery-ui-1.8.14.custom.min.js"></script>
</head>
<body>
<div style="clear:both"></div>
<div class="title" style="margin-left:10px"><?=$this->judul;?></div>
<p><?=$this->errormsg;?></p>
<?= form_open_multipart(current_url());?>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
        <input type="hidden" name="kd_order" value="<?=@$kd_order;?>">
        <input type="hidden" name="kd_detail_order" value="<?=@$kd_detail_order;?>">
	<table width="550" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td>
			<table width="550" border="0" cellspacing="3" cellpadding="0">
			<tr>
				<td width="150" valign="top" class="input-text-1" style="padding-left:10px;">No. LHU </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'no_lhu','class'=>'input-option','maxlength'=>'20','value'=>$no_lhu));?>  * <?=form_error('no_lhu')?></td>
			</tr>
			<tr>
				<td width="150" valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Cetak</td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><?=form_input(array('name'=>'tgl_cetak','class'=>'input-option','value'=>$tgl_cetak,'size'=>'10','maxlength'=>'10','id'=>'tgl_cetak'));?><style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style></td>
			</tr>
			<tr>
				<td width="150" valign="top" class="input-text-1" style="padding-left:10px;">Upload File LHU </td>
				<td width="20" valign="top" class="input-text-1"><div align="center">:</div></td>
				<td width="413" valign="top"><input type="file" name="userfile" class="input-option" size="20" /></td>
			</tr>
			<? if($this->session->userdata('profil')->groupname == 'super'){?>
			<? } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding-top:15px">
			<button type="submit" class="button">Simpan</button>
		</td>
	</tr>
	</table>
<?=form_close();?>
<?=$this->javascript;?>
<? //=$this->load->view('view_footer');?>
</body>
</html>
