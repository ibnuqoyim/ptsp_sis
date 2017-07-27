<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 1</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li><a href="<?=base_url();?>index.php/order/edit/<?=$kd_order_sertifikasi;?>">Permohonan</a></li>
            <li class="active"><a href="<?=base_url();?>index.php/order/orderPabrik/<?=$kd_order_sertifikasi;?>">Pabrik</a></li>
    		<li><a href="<?=base_url();?>index.php/order/orderKomoditi/<?=$kd_order_sertifikasi;?>">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>">Cetak Permohon</a></li>
		</ul>
	</div>

<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi?>" id="kd_order_sertifikasi" />
	<!--<input type="hidden" name="kd_order_pabrik" value="<?=$kd_order_pabrik;?>" id="kd_order_pabrik;" />-->
	<input type="hidden" name="save" id="save" value="1" />
			<div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Nama Pabrik&nbsp;*
                        <?=anchor('customer/add/true/',img(array('src'=>'images/tambah.png','border'=>'0','height'=>'20'))." Baru",
                        array('title'=>'Pabrik Baru','alt'=>'Pabrik Baru','class'=>'input-text','id'=>'pemohon' ));?>
                    </label>                    
                    <div class="col-sm-6"><?=form_error('nama_pabrik')?>      
                            <input type="text" id="nm_pabrik" autocomplete="off" name="nama_pabrik" 
                            value="<?=$nama_pabrik;?>" class="form-control" placeholder="otomatis">   
                            
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Alamat pabrik</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'alamat_pabrik','class'=>'form-control',
                                'value'=>$alamat_pabrik,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Negara</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'negara_pabrik','class'=>'form-control',
                                'value'=>$negara_pabrik,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                                <?//=$this->mCustomer->readNegara($negara_pabrik);?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Telpon pabrik</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'telepon_pabrik','class'=>'form-control',
                                'value'=>$telepon_pabrik,
                                'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">No. Fax pabrik</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'fax_pabrik','class'=>'form-control',
                                'value'=>$fax_pabrik,
                            'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group"> 
                    <label  class="col-sm-3 control-label">Jumlah Karyawan</label>
                    <div class="col-sm-6"> <?=form_error('jumlah_karyawan_pabrik')?>                       
                            <?=form_input(array('name'=>'jumlah_karyawan_pabrik','class'=>'form-control',
                                'value'=>$jumlah_karyawan_pabrik,
                        'maxlength'=>'50','size'=>'30'));?>
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
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>&nbsp;&nbsp;                        
                            <!--<button type="button" onclick="javascript:window.location.href='<?=site_url()."/order/view/".$kd_order_sertifikasi;?>'"
                            class="btn btn-primary">Next</button>
		  					<!--<button type="button" class="btn btn-primary" 
                            onclick="javascript:window.location.href='<?//=site_url($this->session->userdata('returnurl'));?>'" 
                     class="button">Kembali</button>-->
                	</div>
        		</div>
        	</div>

        	<div class="col-xs-12"><hr></div>



        	<div class="row">
        		<div class="form-group">
        	<? 
			if($result)	
				$this->load->view('order/sertifikasi/customer/view_order_pabrik_customer.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>
