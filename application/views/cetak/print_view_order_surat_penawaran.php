<html>
<head>
	<base href="<?=base_url();?>" />
    <link rel="stylesheet" type="text/css" href="css/print2.css" media="screen, projection" />
</head>
<body onLoad="window.print()" style="background-color:#FFF" style="font-family:Verdana, Geneva, sans-serif">

<table  width="100%" >
    <tbody>
        <tr>
            <td width="100">Nomor</td>
            <td>:</td>
            <td><?=$no_penawaran;?></td>
            <td align="right">Bandung,&nbsp;&nbsp;<?=tgl_indo(date($tgl_penawaran));?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td><?=$jumlah_lampiran_penawaran;?></td>
            <td></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?=$perihal_penawaran;?></td>
            <td></td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
        </tr>Erik
</table>
<table  width="100%" >
    <tbody>
        <tr><td>Kepada</td></tr>
        <tr><td>Pimpinan</td></tr>
        <tr><td><?=$nama_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$alamat_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$telpon_perusahaan_pemohon;?></td></tr>
        <tr><td><?=$fax_perusahaan_pemohon;?></td></tr>
        <tr><td>CP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$nm_kontak_perusahaan_pemohon;?></td></tr>
        <tr><td>HP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$nohp_kontak_perusahaan_pemohon;?></td></tr>
        <tr><td>E-mail&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$email_kontak_perusahaan_pemohon;?></td></tr>
        <tr><td>&nbsp;&nbsp;</td></tr>
        <tr><td>&nbsp;&nbsp;</td></tr>
        <tr><td>&nbsp;&nbsp;</td></tr>
    </tbody>
</table>
<table  width="100%" >
    <tbody>
        <!--<tr><td><p><?=$isi_surat_penawaran?></p></td></tr>  -->
        <? if($no_surat_permohonan!=''){ ?>
         <tr><td><p>Menindaklanjuti Surat Permohonan saudara nomor : <?=$no_surat_permohonan;?> tanggal  <?=tgl_indo(date($tgl_surat_permohonan));?> perihal informasi <?=$perihal_penawaran;?> di 
            <?=$nama_pabrik;?> - <?=$negara_pabrik;?>, dengan ini kami sampaiakan tagihan biaya untuk kegiatan tersebut adalah sebagai berikut:</p></td></tr>   
        <?php }else { ?>
                    <tr><td><p>Berkenaan dengan akan dilaksanakannya <?=$nama_sertifikasi_tahapan?> perihal informasi <?=$perihal_penawaran;?> di 
            <?=$nama_pabrik;?> - <?=$negara_pabrik;?>, dengan ini kami sampaiakan tagihan biaya untuk kegiatan tersebut adalah sebagai berikut:</p></td></tr> 
        <?php } ?> 
        <tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>
        <tr><td><p>Tidak dibenarkan untuk memberikan hadiah ataupun gratifikasi dalam bentuk apapun kepada auditor/PPC terkait kegiatan sertifikasi</p></td></tr>      
        <tr><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td></tr>
         <tr><td><p>Apabila ada perubahan tipe kategori produk, merk, legalitas/susunan organisasi produsen, jumlah karyawan produsen mohon diinformasikan kepada Seksi Pemasaran dengan nomor Tlp. 022-7206296 ext. 130. Atas perhatian dan kerjasamanya kami sampaikan terima kasih</p></td></tr>   
    </tbody>
</table>

<table  width="100%" >
	<tbody>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td align="center">A.n Kepala Perusahaan,</td>
		</tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td align="center">Manager Pemasaran</td>
        </tr>
		<tr>
			<td></td>
			<td>&nbsp;</td>
			<td></td>
			<td>&nbsp;</td>
			<td></div></td>

		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="center"></td>
			<td></td>
			<td align="center"></td>
			<td>&nbsp;</td>
			<td align="center">(Rahayu Dwi Lestari)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		
</table>
</body>
</html>