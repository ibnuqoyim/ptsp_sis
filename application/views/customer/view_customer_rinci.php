<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1);?>">User</a></li>
    <li class="active">View</li>
</ul>

<div style="clear:both"></div>
<?=form_open(current_url());?>

<fieldset>
<legend><b><?=$this->judul;?></b></legend>	
<table class="table table-condensed  table-striped">
	<tbody>
 <tr>
   <td>
	<table class="table table-condensed  table-striped">
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Nama</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=$nama;?> </td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Alamat</td>
		<td valign="top" class="input-text-1" style="vertical-align:top"><div align="center">:</div></td>
		<td valign="top"><?=$alamat;?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Email</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=$email;?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Website</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?=$website;?>
		</td>
	</tr>
	<?php if($kd_tipe_customer=="cst2"){?>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Contact Person 1</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
		<?=$contact_person1;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Contact Person 2</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
		<?=$contact_person2;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Contact Person 3</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
		<?=$contact_person3;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Contact Person 4</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
		<?=$contact_person4;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Contact Person 5</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
		<?=$contact_person5;?>
		</td>
	</tr>
   	<?php }?>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;white-space:nowrap">Telepon</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=$telepon;?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Fax</td>
		<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td valign="top"><?=$fax;?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Negara</td>
		<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td valign="top"><?=$negara;?></td>
	</tr>
            <?php if(strtolower($negara) === "indonesia") { ?>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Propinsi</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=$propinsi;?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px; vertical-align:text-top">Kota</td>
		<td valign="top" class="input-text-1" style="vertical-align:text-top"><div align="center">:</div></td>
		<td valign="top"><?=$nama_kota;?></td>
	</tr>
            <? } ?>

	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Tipe Customer </td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?php
				if($kd_tipe_customer){
					$tipe=$this->mCustomer-> GetTipeCustomer($kd_tipe_customer);
					if($tipe){
						foreach($tipe as $row){
							echo $row->tipe_customer ;
						}
					}
				}
			?>  
		</td>      
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Sub Tipe Customer </td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?php 
				if($kd_subtipe_customer){
					$subtipe=$this->mCustomer->GetSubTipeCustomer($kd_tipe_customer,$kd_subtipe_customer);
					if($subtipe){
						foreach($subtipe as $row){
							//echo $kd_subtipe_customer;
							echo $row->nama_subtipe;
						}
					}
				}
			?>  
		</td>      
	</tr>
	<?php if($kd_tipe_customer=="cst2"){?>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Jumlah Karyawan</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?=$jml_karyawan;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Total Kapasitas Produksi</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?=$kapasitas_produksi_total;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Tahun Pendirian</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?=$tahun_pendirian;?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Market Area</td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top">
			<?=$market_area;?>
		</td>
	</tr>
	<?php }?>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Create </td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=mdate("%d-%m-%Y %h:%i:%s",strtotime($tgl_create));?></td>
	</tr>
	<tr>
		<td valign="top" class="input-text-1" style="padding-left:10px;">Tanggal Update </td>
		<td valign="top" class="input-text-1"><div align="center">:</div></td>
		<td valign="top"><?=mdate("%d-%m-%Y %h:%i:%s",strtotime($tgl_update));?></td>
	</tr>
	
	</table>
   </td>
  </tr>
  <?php if($kd_tipe_customer=="cst2"){?>
  <tr>	<td bgcolor="#FFFFFF" style="background-color:#FFF"></td>
  </tr>
  <tr>
	
	<td align="center" style="padding-top:15px">
            <? 
			if($result) 
			$this->load->view('customer/view_customer_detail.php');
			?>
         </td>
	
  </tr>
  <?php }?>
  <tr>
	<td style="padding:25px 25px 25px 0; text-align:right" colspan="3">
	        <button type="button" class ="btn btn-primary" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
		>Kembali</button>
	</td>
  </tr>
</table>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<?=$this->load->view('view_footer');?>
