<html>
<head>
	<base href="<?=base_url();?>" />
	<!-- versi baru jquery tidak jalan auto completenya-->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <!--<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>-->
    <link href="js/jquery-ui-1.9.2/css/base/jquery-ui-1.9.2.custom.css" rel="stylesheet">    
    <script src="js/jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.js"></script>

    <script type="text/javascript" src="js/autocomplete/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />

    <!--  Bootstrap Addon -->
    <link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap.css" />
    <!--<link rel="stylesheet" href="js/bootstrap-3.3.5/css/bootstrap-theme.min.css" />  -->
    <script src="js/bootstrap-3.3.5/js/bootstrap.js"></script> 
</head>
<body  style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">

<table class="table table-condensed table-bordered table-striped">
	<tbody>
	<tr>
		<tr>
			<td>No. Kontrak</td>
			<td><div align="center">:</div></td>
			<td><?=$no_kontrak;?></td>
		</tr>
		<tr>
			<td>Tanggal Cetak Kontrak</td>
			<td><div align="center">:</div></td>
			<td><?=$tgl_cetak_kontrak;?></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Nama Penandatangan kontrak BBK</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_penandatangan_bbk_kontrak;?></td>
		</tr>
		<tr>
			<td>Nip Penandatangan kontrak BBK</td>
			<td><div align="center">:</div></td>
			<td><?=$nip_penandatangan_bbk_kontrak;?> </td>
		</tr>
		<tr>
			<td>Jabatan Penandatangan kontrak BBK</td>
			<td><div align="center">:</div></td>
			<td><?=$jabatan_penandatangan_bbk_kontrak;?> </td>
		</tr>

		<tr>
			<td valign="top">Tgl.Penandatangan kontrak BBK</td>
			<td valign="top"><div align="center">:</div></td>
			<td><?=$tgl_penandatangan_bbk_kontrak;?> </td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Nama Penandatangan kontrak Perusahaan</td>
			<td><div align="center">:</div></td>
			<td><?=$nama_penandatangan_perusahaan_kontrak;?></td>
		</tr>
		<tr>
			<td>Nip Penandatangan kontrak Perusahaan</td>
			<td><div align="center">:</div></td>
			<td><?=$nip_penandatangan_perusahaan_kontrak;?></td>
		</tr>
		<tr>
			<td>Jabatan Penandatangan kontrak Perusahaan</td>
			<td><div align="center">:</div></td>
			<td ><?=$jabatan_penandatangan_perusahaan_kontrak;?></td>
		</tr>
		<tr>
			<td>Tgl. Penandatangan kontrak Perusahaan </td>
			<td><div align="center">:</div></td>
			<td><?=$tgl_penandatangan_perusahaan_kontrak;?> </td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;<br /></td>
		</tr>
		<tr>
			<td>Nama Pembuat Kontrak</td>
			<td><div align="center">:</div></td>
			<td ><?=$nip_pembuat_kontrak;?></td>
		</tr>
		<tr>
			<td>Nip Pembuat Kontrak </td>
			<td><div align="center">:</div></td>
			<td><?=$nama_pembuat_kontrak;?> </td>
		</tr>
		<tr>
			<td>Tgl. kontrak diterima bagian kerjasama</td>
			<td><div align="center">:</div></td>
			<td><?=$tgl_diterima_kontrak;?> </td>
		</tr>
    	
	</table>

</body>
</html>