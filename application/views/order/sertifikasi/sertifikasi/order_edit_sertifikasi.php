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
    </div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>

<p><?=@$this->errormsg;?></p>
<?php
    
	$dat=$this->mUser->getDetail($this->session->userdata('userid'));
	
?>
  	
        	
             <div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Perusahaan Pemohon</label>        			
                    <div class="col-sm-6"><?=$nama_perusahaan_pemohon;?> </div>
        		</div>
        	</div>            
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Alamat Perusahaan Pemohon</label>
        			<div class="col-sm-6"><?=$alamat_perusahaan_pemohon;?></div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Telpon Perusahaan Pemohon</label>
        			<div class="col-sm-6"> <?=$telpon_perusahaan_pemohon;?></div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Fax Perusahaan Pemohon</label>
        			<div class="col-sm-6"><?=$fax_perusahaan_pemohon;?>
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
                    <label  class="col-sm-3 control-label">Nama Importir</label>
                    <div class="col-sm-6"><?=$nama_perusahaan_importir;?>  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Alamat Importir</label>
                    <div class="col-sm-6"><?=$alamat_perusahaan_importir;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Telpon </label>
                    <div class="col-sm-6"><?=$telpon_perusahaan_importir;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Fax </label>
                    <div class="col-sm-6"><?=$fax_perusahaan_importir;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. API</label>
                    <div class="col-sm-6"><?$no_api_perusahaan_importir;?>
                    </div>
                </div>
            </div>
            <?php }?>
            
        	 <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Kontak Perusahaan Pemohon * </label>
        			<div class="col-sm-6">  <?=$nm_kontak_perusahaan_pemohon;?></div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No. Hp Kontak Perusahaan Pemohon </label>
        			<div class="col-sm-6"><?=$nohp_kontak_perusahaan_pemohon;?> 
					</div>
        		</div>
        	</div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Email Kontak Perusahaan Pemohon *</label>
                    <div class="col-sm-6"><?=$email_kontak_perusahaan_pemohon;?> 
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
                                $kd_sertifikasi_jenis,'class="form-control" onChange="showTarifSertifikasi()" id="kd_sertifikasi_jenis"');?> 
                                
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
                    <div class="col-sm-6"><?=$noreg_order_sertifikasi;?> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Registrasi</label>
                    <div class="col-sm-6"><?=$tglreg_order_sertifikasi;?> </div>       
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