<table border="0" cellpadding="0" cellspacing="0" width="100%" >
	<tr><?=form_open(current_url());?>
    	<?php if($this->session->flashdata('tampung')){ ?>proses
		<td class="c-table-xa"></td>
        <? } ?>
        <td class="c-table-xa" align="left" width="8">No</td>
        <td class="c-table-xa" align="left">Jenis/Nama&nbsp;Contoh</td>
		<td width="170" class="c-table-xa" >Parameter Uji</td>
		<td class="c-table-xa">Jumlah Uji</td>			 
		<td class="c-table-xa">Jumlah Contoh</td>
		<td class="c-table-xa">Harga</td>		
		<td class="c-table-xa">Jumlah</td>
		
	</tr>
<?
$no=0;
foreach($result as $row){
	$no++;
	if($no%2){$thisclass='c-clas-2';$thisclass2='c-clas-2rlt';}
	else {$thisclass='c-clas-3';$thisclass2='c-clas-3rlt';}	
	?>
	<tr class="row0">
        <?php if($this->session->flashdata('tampung')){ ?>
		<td class="<?=$thisclass2;?>" style="border-left:solid 1px" align="center"></td>
        <? } ?>
        <td class="<?=$thisclass;?>" align="center"><?=(($page-1)*$limit)+$no;?></td>
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?=$row->jenis_contoh;?>/<?=$row->nama_contoh;?></div></td>
	
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1"><?php
	
    		$res=$this->mOrder->getParameter($row->kd_detail_order,false);
	
	if($res){
		$jum_uji=""; $subtotal_title=""; $totjum_uji=0;$txt_jumuji="";$txt_status_parameter="";$status_parameter="";
		$txt_status_parameter1="";$txt_nmanalis='';$txt_nmanalis1='';$analis="";$nip='';

		foreach($res as $par){
			echo "<li style=\"margin-left:7px\" title=\"".formatRupiah($par->harga_satuan)."\">".
					$par->nama_parameter."</li>";
			$txt_jumuji .= "<li style=\"margin-left:7px\" title=\"".$par->nama_parameter."\">".
					$par->jumlah_uji."</li>";			
			
			
			if($this->session->userdata('profil')->groupname == $row->jenis_contoh ){					
			     $txt_status_parameter1 .= "<a href=\"index.php/order/input_status_parameter/$par->kd_detail_order/$par->kd_parameter/?TB_iframe=true&height=620&width=880&modal=true\" class=\"thickbox\" title=\"Input Status Parameter\" 
			     alt=\"Input Status Parameter\">";
			     $txt_nmanalis1 .= "<a href=\"index.php/order/input_analis_parameter/$par->kd_detail_order/$par->kd_parameter/?TB_iframe=true&height=200&width=350&modal=true\" class=\"thickbox\" title=\"Tentukan nama analis untuk $par->nama_parameter\" 
			     alt=\"Tentukan nama analis untuk $par->nama_parameter\">";
			}elseif($this->session->userdata('profil')->groupname == 'analis'){
			     if($par->nip_analis == $this->session->userdata('userid') && $par->nm_analis <>'(NULL)'){
			     $txt_status_parameter1 .= "<a href=\"index.php/order/input_status_parameter/$par->kd_detail_order/$par->kd_parameter/?TB_iframe=true&height=620&width=880&modal=true\" class=\"thickbox\" title=\"Input Status Parameter\" 
			     alt=\"Input Status Parameter\">";
			     }

			}
			$txt_status_parameter .=$txt_status_parameter1."<li style=\"margin-left:7px\" 
						title=\"".$par->nama_parameter."\">".
				$par->status_parameter."</li></a>";
			$txt_nmanalis .="<li id=\"orders$no\" style=\"margin-left:7px\" 
			title=\"".$par->nama_parameter."\">".$txt_nmanalis1.
			($par->nm_analis !=''? $par->nm_analis:"<font color=\"red\">Belum ditentukan </font>").
			"</li></a>";
			
			
		        $totjum_uji += $par->jumlah_uji;
			$jum_uji .=">>".$par->nama_parameter." (".$par->jumlah_uji.") \n\r";
				
			$status_parameter .=">>".$par->nama_parameter." (".$par->status_parameter.") \n\r";
			$analis .=">>".$par->nm_analis." (".$par->nm_analis.") \n\r";

			$subtotal_title .= ">>".formatRupiah($par->harga_satuan)." X ".$par->jumlah_uji." X ".
						$row->jumlah_contoh."  \n\r  ";
			$subtotal_title .="=".($par->harga_satuan*$par->jumlah_uji*$row->jumlah_contoh);
		}
		

	}
	?></div></td>
	<td class="<?=$thisclass;?>">
		<div class="c-clas-text-1" title="<?=$jum_uji;?>" style="text-align:center"><?=$txt_jumuji;$txt_jumuji="";?></div>
	</td>
	
	<td class="<?=$thisclass;?>"><div class="c-clas-text-1" style="text-align:center"><?=$row->jumlah_contoh;?></div></td>
	
	<td class="<?=$thisclass;?>">
	<div class="c-clas-text-1" style="text-align:right" title="<?=$subtotal_title;?>"><?=formatRupiah($row->harga_subtotal);?>
	</div>
	</td>
	</tr>
<?}?>

</table>
