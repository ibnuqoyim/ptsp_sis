<?=$this->load->view('view_header');?>
<div style="clear:both"></div>
<p><?=anchor(site_url()."/".$this->uri->segment(1),ucfirst($this->uri->segment(1)))." &raquo; ".ucfirst($this->uri->segment(2));?></p>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="kd_customer" value="<?=$kd_customer;?>" id="editlagi" />
	<input type="hidden" name="save" value="1" />
	<div class="row">
     			<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Perusahaan / Orang</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'nama','class'=>'form-control','value'=>$nama,'maxlength'=>'200',
							'size'=>'30'));?>  * <?=form_error('nama')?>
					</div>
        		</div>
    </div>
    <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Perusahaan / Orang</label>
        			<div class="col-sm-6">        					
							<?=form_textarea(array('name'=>'alamat','class'=>'form-control','value'=>$alamat,
				'maxlength'=>'250','rows'=>'5','cols'=>'30'));?>
					</div>
        		</div>
    </div>
    <?php if($kd_tipe_customer=="cst2"){?>
    <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Alamat Pabrik</label>
        			<div class="col-sm-6">        					
							<?=form_textarea(array('name'=>'alamat_pabrik','class'=>'form-control','value'=>$alamat_pabrik,'maxlength'=>'250','rows'=>'3','cols'=>'40'));?>
					</div>
        		</div>
    </div>	
	<?php }?>
	 <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Email</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'email','class'=>'form-control','value'=>$email,'maxlength'=>'100','size'=>'30'));?>
					</div>
        		</div>
    </div>


	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Website</label>
        			<div class="col-sm-6">
						<?=form_input(array('name'=>'website','class'=>'form-control','value'=>$website,'maxlength'=>'100','size'=>'30'));?>
					</div>
        		</div>
    </div>
	<?php if($kd_tipe_customer=="cst2"){?>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Contact Person 1</label>
        			<div class="col-sm-6">        					
		<?=form_input(array('name'=>'contact_person1','class'=>'form-control','value'=>$contact_person1,'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Contact Person 2</label>
        			<div class="col-sm-6">        					
		<?=form_input(array('name'=>'contact_person2','class'=>'form-control','value'=>$contact_person2,'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Contact Person 3</label>
        			<div class="col-sm-6">        					
		<?=form_input(array('name'=>'contact_person3','class'=>'form-control','value'=>$contact_person3,'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Contact Person 4</label>
        			<div class="col-sm-6">        					
		<?=form_input(array('name'=>'contact_person4','class'=>'form-control','value'=>$contact_person4,'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Contact Person 5</label>
        			<div class="col-sm-6">        					
		<?=form_input(array('name'=>'contact_person5','class'=>'form-control','value'=>$contact_person5,'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<?php }?>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Telepon</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'telepon','class'=>'form-control','value'=>$telepon,'maxlength'=>'50',
			'size'=>'30'));?>  * <?=form_error('telepon')?>
			</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Fax</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'fax','class'=>'form-control','value'=>$fax,'maxlength'=>'20','size'=>'20'));?></div>
        		</div>
    </div>
    <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Negara</td>
                <td width="20" valign="top" class="form-control" style="vertical-align:text-top"><div align="center">:</div></label>
        			<div class="col-sm-6">        					
			<?=form_dropdown('kd_negara',$this->mCustomer->GetNegaraList4DropDown(),$kd_negara,
			'class="input-option" id="countryID1" onChange="GetStates(document.getElementById(\'countryID1\').options[document.getElementById(\'countryID1\').selectedIndex].value)"');?>
               </div>
        		</div>
    </div>
            
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Propinsi</label>
        			<div class="col-sm-6">        					
			<?=form_dropdown('propinsi',$this->mCustomer->GetPropinsiList4DropDown(),$propinsi,
			'class="input-option" onChange="showKab()" id="propinsi"');?>

       </div>
        		</div>
    </div>
    <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Kotamadya/Kabupaten</label>
        			<div class="col-sm-6">        					
			<select name="kota" class="input-option" id="kabupaten">
			<?php
				if($kota){
					$kotamadya=$this->mCustomer->GetKabupaten($propinsi);
					if($kotamadya){
						//echo "<option>".$kota."</option>";
						foreach($kotamadya as $row){
							echo "<option value='".$row->kd_kota."' ";
							if($row->kd_kota==$kota) echo "selected";
							echo ">".$row->nama_kota."</option>";
						}
					}
				}
			?>
                	</select>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Tipe Customer </label>
        			<div class="col-sm-6">        					
			<?=form_dropdown('kd_tipe_customer',$this->mCustomer->GetTipeCustomerList4DropDown(),
			$kd_tipe_customer,'class="input-option" onChange="cekSubTipe(this.value)" id="kd_tipe_customer"');?>&nbsp;
			<!--<span id="subtipe"></span>-->
			<select name="kd_subtipe_customer" class="input-option" id="subtipe">
			<?php
				if($kd_subtipe_customer){
					$sub=$this->mCustomer-> GetSubTipeCustomer($kd_tipe_customer,$kd_subtipe_customer);
					if($sub){
						//echo "<option>".$kota."</option>";
						foreach($sub as $row){
							echo "<option value='".$row->kd_subtipe_customer."' ";
							if($row->kd_subtipe_customer==$kd_subtipe_customer) echo "selected";
							echo ">".$row->nama_subtipe ."</option>";
						}
					}
				}
			?>
                	</select>
		</div>
        		</div>
    </div>
	<?php if($kd_tipe_customer=="cst2"){?>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Jumlah Karyawan</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'jml_karyawan','class'=>'form-control','value'=>$jml_karyawan,
			'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Total Kapasitas Produksi</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'kapasitas_produksi_total','class'=>'form-control','value'=>$kapasitas_produksi_total,
			'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Tahun Pendirian</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'tahun_pendirian','class'=>'input-text','value'=>$tahun_pendirian,
			'maxlength'=>'4','size'=>'4','id'=>'tahun_pendirian'));?>
			<style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
		</div>
        		</div>
    </div>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Market Area</label>
        			<div class="col-sm-6">        					
			<?=form_input(array('name'=>'market_area','class'=>'form-control','value'=>$market_area,
			'maxlength'=>'100','size'=>'30'));?>
		</div>
        		</div>
    </div>
	<?php }?>
	<div class="col-xs-12"><hr></div>
	<p>&nbsp;</p>
	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">&nbsp;</label>
        			<div class="col-sm-6">       					
		   				<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
		   				<button type="button" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
                   			class="btn btn-primary">Kembali</button>
						<button type="button" 
							onclick="javascript:window.location.href='<?=site_url('customer/DetailKomoditi/'.$kd_customer);?>'" 
                   			class="btn btn-primary">Next</button>
					</div>
        		</div>
    </div>
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<script language="JavaScript" type="text/JavaScript">
	function GetStates(nilai){
		if(nilai != 102){
			document.getElementById('propinfo').style.visibility="collapse";
			document.getElementById('propinfo2').style.visibility="collapse";
		} else {
			document.getElementById('propinfo').style.visibility="visible";
			document.getElementById('propinfo2').style.visibility="visible";
		}
	}
	
   function cekSubTipe(nilai)
   {
	
	<?php
        echo 'if (nilai=="cst1"){';
		$arrdata=$this->mCustomer->GetSubTipeCustomer('cst1');	
         	echo 'document.getElementById(\'subtipe\').innerHTML = ';
         		echo '"<select name=\'subtipe\' class=\'input-option\'>';			
		if($arrdata){
        	foreach($arrdata as $row){
         		for($j=1;$j<=count($row);$j++){
			echo "<option value='".$row->kd_subtipe_customer ."'>".$row->nama_subtipe."</option>";
			}                
		}
		}
        echo '</select>"'; 
	echo '}else if (nilai=="cst2"){';
		$arrdata=$this->mCustomer->GetSubTipeCustomer('cst2');	
         	echo 'document.getElementById(\'subtipe\').innerHTML = ';
         		echo '"<select name=\'subtipe\' class=\'input-option\'>';			
		if($arrdata){
        	foreach($arrdata as $row){
         		for($j=1;$j<=count($row);$j++){
			echo "<option value='".$row->kd_subtipe_customer ."'>".$row->nama_subtipe."</option>";
			}                
		}}
        echo '</select>"';
        echo '}else if (nilai=="cst3"){';
		$arrdata=$this->mCustomer->GetSubTipeCustomer('cst3');	
         	echo 'document.getElementById(\'subtipe\').innerHTML = ';
         		echo '"<select name=\'subtipe\' class=\'input-option\'>';			
		if($arrdata){
        	foreach($arrdata as $row){
         	for($j=1;$j<=count($row);$j++){
			echo "<option value='".$row->kd_subtipe_customer ."'>".$row->nama_subtipe."</option>";
		}                
		}
		}
        echo '</select>"';
        echo '}else { ';
        echo 'document.getElementById(\'subtipe\').innerHTML = ""';
        echo '}';
	
	 	
     ?>
   }
   
 function showKab()
 {
	 <?php
	 $arrdata=$this->mCustomer->GetPropinsiList4DropDown();
	 	for($j=1;$j<=count($arrdata);$j++){
			echo "if (document.getElementById('propinsi').value == \"".$j."\"){document.getElementById('kabupaten').innerHTML = \"";
			$kota=$this->mCustomer->GetKabupaten($j);
			if($kota){
				foreach($kota as $row){
					echo "<option value='".$row->kd_kota."'>".$row->nama_kota."</option>";
				}
				//echo "\n\r";
			}
			echo "\"}\n\r";
		}
	 ?>
 }
</script>
<?=$this->load->view('view_footer');?>
