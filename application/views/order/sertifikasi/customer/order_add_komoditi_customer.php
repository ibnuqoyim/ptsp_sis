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
            <li><a href="<?=base_url();?>index.php/order/orderPabrik/<?=$kd_order_sertifikasi;?>">Pabrik</a></li>
    		<li class="active"><a href="<?=base_url();?>index.php/order/orderKomoditi/<?=$kd_order_sertifikasi;?>">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/order/view/<?=$kd_order_sertifikasi;?>">Cetak Permohon</a></li>
		</ul>
	</div>

<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi?>" id="kd_order_sertifikasi" />
	<input type="hidden" name="kd_sertifikasi_komoditi" value="<?=$kd_sertifikasi_komoditi?>" id="kd_sertifikasi_komoditi" />
	<input type="hidden" name="save" id="save" value="1" />
			<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">No SNI Komoditi</label>
        			<div class="col-sm-6"> 
                            <input type="text" id="no_sni" autocomplete="off" name="no_sertifikasi_komoditi" 
                            value="<?=$no_sertifikasi_komoditi;?>" class="form-control" placeholder="otomatis">  
                            <?=form_error('no_sertifikasi_komoditi')?>  
					</div>
        		</div>
        	</div>
			<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Nama Komoditi</label> 
                    <div class="col-sm-6">  
                            <?=form_input(array('name'=>'nama_sertifikasi_komoditi','class'=>'form-control',
                                'value'=>$nama_sertifikasi_komoditi,'maxlength'=>'250','size'=>'50',
                                'readonly'=>'1','style'=>'background-color:#e6edf1'));?>   
                    </div>
        		</div>
        	</div>            
        	
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Tipe Sertifikasi</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'tipe_sertifikasi_komoditi','class'=>'form-control',
								'value'=>$tipe_sertifikasi_komoditi,
								'maxlength'=>'50','size'=>'30','readonly'=>'1','style'=>'background-color:#e6edf1'));?>
					</div>
        		</div>
        	</div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Jenis/Tipe Komoditi</label>
                    <div class="col-sm-6">                          
                            <?=form_input(array('name'=>'jenis_produk_komoditi','class'=>'form-control',
                                'value'=>$jenis_produk_komoditi,
                            'maxlength'=>'50','size'=>'30'));?>
                    </div>
                </div>
            </div>
        	<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Merek dagang</label>
        			<div class="col-sm-6">        					
							<?=form_input(array('name'=>'merk_dagang_komoditi','class'=>'form-control',
								'value'=>$merk_dagang_komoditi,
							'maxlength'=>'50','size'=>'30'));?> * <?=form_error('merk_dagang_komoditi')?>
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
				$this->load->view('order/sertifikasi/administrator/view_order_komoditi_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>
