<?$this->load->view('view_header');?> 
<?=$this->javascript;?>  

<?=form_open(current_url());?>
    <div class="steptitle">Step 1</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>

    <div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="<?=base_url();?>index.php/order/edit/<?=$kd_order_sertifikasi;?>">Permohonan</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderPabrik/<?=$kd_order_sertifikasi;?>">Pabrik</a></li>
    		<li><a href="<?=base_url();?>index.php/order/orderKomoditi/<?=$kd_order_sertifikasi;?>">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>">Cetak Permohonan</a></li>
		</ul>
    </div>>
    <div style="clear:both"></div>
    <p>&nbsp;</P>

<p><?=@$this->errormsg;?></p>
<?php
    
	$dat=$this->mUser->getDetail($this->session->userdata('userid'));
	
?>
    <?// echo $statusbayar_order_sertifikasi."test"; ?>
    <input type="hidden" name="status_order_sertifikasi" value="<?=$status_order_sertifikasi;?>" >
    <input type="hidden" name="statusbayar_order_sertifikasi" value="<?=$statusbayar_order_sertifikasi;?>" >
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
             <div class="col-xs-12"><hr></div>
             <? if($nama_jenistarif !="Dalam Negeri") { ?> 
            <H4>Untuk Produk Impor</H4>
            <div class="row">
                <div class="form-group">
                   <div class="col-xs-12"><hr>
                    
                   </div>
                </div>
            </div>
             <div class="row">
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
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Alamat Importir</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'alamat_perusahaan_importir','class'=>'form-control',
                                'value'=>$alamat_perusahaan_importir,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Telpon </label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'telpon_perusahaan_importir','class'=>'form-control',
                                'value'=>$telpon_perusahaan_importir,
                                'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Fax </label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'fax_perusahaan_importir','class'=>'form-control',
                                'value'=>$fax_perusahaan_importir,
                            'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. API</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'no_api_perusahaan_importir','class'=>'form-control',
                                'value'=>$no_api_perusahaan_importir,
                            'maxlength'=>'50','size'=>'30',));?>
                    </div>
                </div>
            </div>
            <?php }?>
            <!--
        	 <div class="col-xs-12"><hr></div>
            
        	<div class="row">
        		<div class="form-group"> 
        			<label  class="col-sm-3 control-label">Nama Pabrik *</label>
        			<div class="col-sm-6"> <?=form_error('nama_pabrik')?>   					
							<?=form_input(array('name'=>'nama_pabrik','class'=>'form-control','value'=>$nama_pabrik,
						'maxlength'=>'200','size'=>'50','id'=>'pabrik'));?>  
					</div>
        		</div>
        	</div>
            <div class="row">
                <div class="form-group"> 
                    <label  class="col-sm-3 control-label">Jumlah Karyawan</label>
                    <div class="col-sm-6"> <?=form_error('jumlah_karyawan_pabrik')?>                       
                            <?=form_input(array('name'=>'jumlah_karyawan_pabrik','class'=>'form-control','value'=>$jumlah_karyawan_pabrik,
                        'maxlength'=>'200','size'=>'50','id'=>'jumlah_karyawan_pabrik'));?>  
                    </div>
                </div>
            </div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Alamat Pabrik</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'alamat_pabrik','class'=>'form-control',
								'value'=>$alamat_pabrik,'maxlength'=>'250','size'=>'50'));?>
					</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Negara Pabrik</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'negara_pabrik','class'=>'form-control',
								'value'=>$negara_pabrik,'maxlength'=>'50','size'=>'30'));?>
					</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Standar Sistem Mutu</label>
        			<div class="col-sm-6">        					
							<?=form_dropdown('kd_sertifikasi_smm',$this->mOrder->getSmmList4DropDown(),
                                $kd_sertifikasi_smm,
                                'class="form-control"  id="kd_sertifikasi_smm"');?>                                
                            
                   	</div>
        		</div>
        	</div>
            -->
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
                                            if($row->kd_sertifikasi_jenistarif==$kd_sertifikasi_jenistarif){ 
                                                    echo "selected";
                                             }       
                                              echo ">".$row->nama_jenistarif."</option>";
                                           
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
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
		  					<!--<button type="button" class="btn btn-primary" 
                                onclick="javascript:window.location.href='<?=site_url()."/order";?>'"
                                class="button">Kembali</button><!--&nbsp;&nbsp;                        
                            <button type="button" onclick="javascript:window.location.href='<?=site_url()."/order/orderKomoditi/".$kd_order_sertifikasi;?>'"
                            class="btn btn-primary">Next</button>-->
                	</div>
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
</script>


<? $this->load->view('view_footer');?>