<?$this->load->view('view_header');?> 
<?=$this->javascript;?>      
<p><?//=anchor(site_url()."/".$this->uri->segment(1),"Order")." &raquo; Tambah Data Permohonan";?></p>
<?=form_open(current_url());?>
	<div class="steptitle">Step 1</div>
	<div class="wizard-steps">
  		<div class="active-step"><a href="index.php/order/Add"><span>1</span> Permohonan</a></div>
  		<div><a href="Step 2" onclick="return false"><span>2</span> Dokumen</a></div>
  		<div><a href="Step 3" onclick="return false"><span>3</span> Penawaran</a></div>
        <div><a href="Step 4" onclick="return false"><span>4</span> Kontrak</a></div>
  		<div><a href="Step 5" onclick="return false"><span>5</span> Penagihan</a></div>
  		<div><a href="Step 6" onclick="return false"><span>6</span> Pembayaran</a></div>
  		<div><a href="Step 7" onclick="return false"><span>7</span> Jadwal Audit</a></div>
  		<div><a href="Step 8" onclick="return false"><span>8</span> Audit</a></div>
  		<div><a href="Step 9" onclick="return false"><span>9</span> Tim Evaluasi/Teknis</a></div>
  		<div><a href="Step 10" onclick="return false"><span>10</span> Sertifikat</a></div>
  		<div><a href="Step 11" onclick="return false"><span>11</span> Penyerahan Sertifikat</a></div>        
	</div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">Permohonan</a></li>
            <li class="disabled"><a  href="<?=base_url();?>index.php/order/orderPabrik" style="pointer-events:none; cursor:default">Pabrik</a></li>
    		<li class="disabled"><a href="<?=base_url();?>index.php/order/Komoditi" style="pointer-events:none; cursor:default">Komoditi</a></li>  
            <li class="disabled"><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>" style="pointer-events:none; cursor:default">Cetak Permohon</a></li>          
		</ul>
	</div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>

<p><?=@$this->errormsg;?></p>
<?php
    
	$dat=$this->mUser->getDetail($this->session->userdata('userid'));
	
?>

	<input type="hidden" name="nip_penerima" value="<?=$dat->nip_baru;?>" >
    <input type="hidden" name="nm_penerima" value="<?=$dat->Nama;?>" >
	<input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="<?=$kd_order_sertifikasi;?>" />
	<input type="hidden" name="kd_jenis_layanan" value="2"  id="<?=$kd_jenis_layanan;?>" />
	<input type="hidden" name="save" value="1" />
	
		
       		
        	
             <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Perusahaan Pemohon&nbsp;*
        				<?=anchor('customer/add/true/',img(array('src'=>'images/tambah.png','border'=>'0','height'=>'20'))." Baru",
						array('title'=>'Pemohon Baru','alt'=>'Pemohon Baru','class'=>'input-text','id'=>'pemohon' ));?>
        			</label>        			
                    <div class="col-sm-6"><?=form_error('nama_perusahaan_pemohon')?>      
                            <input type="text" id="perusahaan_pemohon" autocomplete="off" name="nama_perusahaan_pemohon" 
                            value="<?=$nama_perusahaan_pemohon;?>" class="form-control" placeholder="atomatis">   
                            
                    </div>
        		</div>
        	</div>            
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Alamat Perusahaan Pemohon</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'alamat_perusahaan_pemohon','class'=>'form-control',
								'value'=>$alamat_perusahaan_pemohon,'maxlength'=>'250','size'=>'50',
								'readonly'=>'1','style'=>'background-color:#e6edf1'));?>
					</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Telpon Perusahaan Pemohon</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'telpon_perusahaan_pemohon','class'=>'form-control',
								'value'=>$telpon_perusahaan_pemohon,
								'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
					</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Fax Perusahaan Pemohon</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'fax_perusahaan_pemohon','class'=>'form-control',
								'value'=>$fax_perusahaan_pemohon,
							'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
					</div>
        		</div>
        	</div>
             <div class="col-xs-12" id="importir1" style="visibility:visible"><hr></div>
            <H4>Untuk Produk Impor</H4>
            <div class="row" id="importir2" style="visibility:visible">
                
                <div class="form-group">
                   <div class="col-xs-12"><hr>
                    
                   </div>
                </div>
            </div>
             <div class="row" id="importir3" style="visibility:visible">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Nama Importir&nbsp;*  
                        <?=anchor('customer/add/true/',img(array('src'=>'images/tambah.png','border'=>'0','height'=>'20'))." Baru",
                        array('title'=>'Importir Baru','alt'=>'importir Baru','class'=>'input-text','id'=>'importir' ));?>
                    </label>
                    <div class="col-sm-6">  <?=form_error('nama_perusahaan_importir')?>                          
                            <?=form_input(array('name'=>'nama_perusahaan_importir','class'=>'form-control','value'=>$nama_perusahaan_importir,
                            'maxlength'=>'200','size'=>'30','id'=>'perusahaan_importir'));?>  
                    </div>
                </div>
            </div>
            <div class="row" id="importir4" style="visibility:visible">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Alamat Importir</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'alamat_perusahaan_importir','class'=>'form-control',
                                'value'=>$alamat_perusahaan_importir,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row" id="importir5" style="visibility:visible">
                <div class="form-group" >
                    <label  class="col-sm-3 control-label">No. Telpon </label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'telpon_perusahaan_importir','class'=>'form-control',
                                'value'=>$telpon_perusahaan_importir,
                                'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row" id="importir6" style="visibility:visible">
                <div class="form-group" >
                    <label  class="col-sm-3 control-label">No. Fax </label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'fax_perusahaan_importir','class'=>'form-control',
                                'value'=>$fax_perusahaan_importir,
                            'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row" id="importir7" style="visibility:visible">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. API</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'no_api_perusahaan_importir','class'=>'form-control',
                                'value'=>$no_api_perusahaan_importir,
                            'maxlength'=>'50','size'=>'30',));?>
                    </div>
                </div>
            </div>

        	 <div class="col-xs-12"><hr></div>
        	
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Kontak Perusahaan Pemohon * </label>
        			<div class="col-sm-6">  <?=form_error('nm_kontak_perusahaan_pemohon')?>      					
							<?=form_input(array('name'=>'nm_kontak_perusahaan_pemohon','class'=>'form-control',
								'value'=>$nm_kontak_perusahaan_pemohon,'maxlength'=>'200','size'=>'30'));?>  
								
					</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Hp Kontak Perusahaan Pemohon *</label>
        			<div class="col-sm-6">      <?=form_error('nohp_kontak_perusahaan_pemohon')?>    					
							<?=form_input(array('name'=>'nohp_kontak_perusahaan_pemohon','class'=>'form-control',
								'value'=>$nohp_kontak_perusahaan_pemohon,'maxlength'=>'50','size'=>'30',
								'onkeydown'=>'return HanyaAngkaAbjad(event)'));?> 
					</div>
        		</div>
        	</div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email Kontak Perusahaan Pemohon *</label>
                    <div class="col-sm-6">      <?=form_error('email_kontak_perusahaan_pemohon')?>                       
                            <?=form_input(array('name'=>'email_kontak_perusahaan_pemohon','class'=>'form-control',
                                'value'=>$email_kontak_perusahaan_pemohon,'maxlength'=>'50','size'=>'30'));?> 
                    </div>
                </div>
            </div

            <div class="row">
                <div class="form-group">
        	       <div class="col-xs-12"><hr>
                    
                   </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Jenis Sertifikasi * </label>
                    <div class="col-sm-6"><?=form_error('kd_sertifikasi_jenis')?> 
                            <?=form_dropdown('kd_sertifikasi_jenis',$this->mTarif->GetJenisSertifikasiList4DropDown(),
                                $kd_sertifikasi_jenis,
                                'class="form-control" onChange="showTarifSertifikasi()" id="kd_sertifikasi_jenis"');?> 
                                
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Jenis Tarif Sertifikasi * </label>
                    <div class="col-sm-6"><?=form_error('kd_sertifikasi_jenistarif')?> 
                            <select name="kd_sertifikasi_jenistarif" class="form-control" id="kd_sertifikasi_jenistarif">                   
                            <?php 
                                #model lama tidak bekerja pada xampp terbaru
                                if($kd_sertifikasi_jenis){  
                                    $tarif=$this->mTarif->getTarif('',$kd_sertifikasi_jenis,true);
                                    if($tarif){
                                        echo "<option>Pilihan</option>";
                                        foreach($tarif as $row){ 
                                            echo $row->nama_jenistarif ."<br>";
                                            echo "<option value='".$row->kd_sertifikasi_jenistarif."' ";
                                            //if($row->kd_sertifikasi_jenistarif==$kd_sertifikasi_jenistarif){ 
                                            echo "selected";
                                            echo ">".$row->nama_jenistarif."</option>";
                                            //}
                                        }
                                    }
                                }
                            ?>
                            </select>  <?=form_error('nama_jenistarif')?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Jenis Tahapan sertifikasi</label>
                    <div class="col-sm-6">                          
                            <?=form_dropdown('kd_sertifikasi_tahapan',$this->mOrder->getTahapanList4DropDown(),
                                $kd_sertifikasi_tahapan,
                                'class="form-control"  id="kd_sertifikasi_tahapan"');?>                                
                            
                    </div>
                </div>
            </div>
             <div class="col-xs-12"><hr></div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No Registrasi *</label>
                    <div class="col-sm-6">  <?=form_error('noreg_order_sertifikasi')?>                      
                            <?=form_input(array('name'=>'noreg_order_sertifikasi','class'=>'form-control',
                                'value'=>$noreg_order_sertifikasi,'maxlength'=>'100','size'=>'20'));?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Registrasi</label>
                    <div class="col-sm-6">                        
                             
                             <?=form_input(array('name'=>'tglreg_order_sertifikasi','value'=>$tglreg_order_sertifikasi,
                                'id'=>'tglreg_order_sertifikasi',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group">
        			<label   class="col-sm-6 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-12"> 
        				<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
		  				<!--<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url()."/order";?>'">Kembali</button>-->
        		</div>
        	</div>
        	 
            
            
    </div>     
</div>
<?=form_close();?>


<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
	
<script language="JavaScript" type="text/JavaScript"> 
	function showTarifSertifikasi(){
    <?php
	   $arr=$this->mTarif->GetJenisSertifikasiList4DropDown();
	 	foreach($arr as  $key=>$value){
			echo "if (document.getElementById('kd_sertifikasi_jenis').value == \"".$key."\"){document.getElementById('kd_sertifikasi_jenistarif').innerHTML = \"";
			$tarif=$this->mTarif->getTarif('',$key,true);
			if($tarif){
				//echo "<option value=''></option>";
				foreach($tarif as $row){
					echo "<option value='".$row->kd_sertifikasi_jenistarif ."'>".$row->nama_jenistarif."</option>";
				}
			}
		echo "\"}\n\r";		
		}
      ?>
 	}

	$('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0
    });

    function viewImportir(nilai){
        if(nilai) {     
            document.getElementById('importir1').style.visibility="hidden";
            document.getElementById('importir2').style.visibility="hidden";
            document.getElementById('importir3').style.visibility="hidden";
            document.getElementById('importir4').style.visibility="hidden";
            document.getElementById('importir5').style.visibility="hidden";
            document.getElementById('importir6').style.visibility="hidden";
            document.getElementById('importir7').style.visibility="hidden";
            //document.getElementById('input-ppn').value='10';                
            
        } else {
            document.getElementById('importir1').style.visibility="visible";
            document.getElementById('importir2').style.visibility="visible";
            document.getElementById('importir3').style.visibility="visible";
            document.getElementById('importir4').style.visibility="visible";
            document.getElementById('importir5').style.visibility="visible";
            document.getElementById('importir6').style.visibility="visible";
            document.getElementById('importir7').style.visibility="visible";
            //document.getElementById('input-ppn').value='10';            
            
        }
    }

</script>


<? $this->load->view('view_footer');?>