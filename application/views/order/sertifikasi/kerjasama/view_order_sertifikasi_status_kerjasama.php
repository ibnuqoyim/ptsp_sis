<html>
<head>
<base href="<?=base_url();?>" />
	<link rel="stylesheet" type="text/css" href="css/<?=($this->uri->segment(1)==="order" && $this->uri->segment(2)!="")?"flick/":"";?>screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chalsy.js"></script>
	<link rel="stylesheet" type="text/css" href="css/chalsy.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>
<body>
<div style="clear:both"></div>
<p></p>
<div class="title" style="margin-left:10px"><center><?=$this->judul;?></center></div>

<?= form_open(current_url());?>
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td>
		     <fieldset>
                              <legend>
				<font color="blue">Status Penyampaian Informasi dari Seksi Pemasaran Sampai ke Bagian Sertifikat</font>
			      </legend>
			      <?=@$rincian_historis;?>
		     </fieldset>			
		</td>	    
	</tr>
	</table>

	<table width="100%" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td>
                     <fieldset>
                              <legend>
				<font color="blue">Status Akhir Sertifikasi</font>
			      </legend>
			      <?=$status_order_sertifikasi;?>
			
		     </fieldset>			
		</td>
	</tr>
	</table>
<?=form_close();?>
</body>
</html>
