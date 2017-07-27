<?$this->load->view('view_header');?>
<? if($this->session->userdata('profil')->groupname == 'customer'){ 
		echo form_open_multipart('order/simpanDokumen');
	} else {
		echo form_open('order/verifikasiDokumen');
	}?>
	<div class="steptitle">Step 2</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">List Dokumen</a></li>
    		<li><a href="<?=base_url();?>index.php/order/viewOrderDokumen/<?=$kd_order_sertifikasi;?>">Cetak</a></li>
		</ul>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
<p><?=@$this->errormsg;?></p>
<fieldset><legend><b></b></legend>
	<!--<input type="hidden" name="tambahlagi" value="1" id="tambahlagi" />-->
    <input type="hidden" name="kd_order_sertifikasi" id="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" />
    <input type="hidden" name="kd_sertifikasi_jenistarif" id="kd_sertifikasi_jenistarif" value="<?=$kd_sertifikasi_jenistarif;?>" />
    <input type="hidden" name="kd_sertifikasi_jenis" id="kd_sertifikasi_jenis" value="<?=$kd_sertifikasi_jenis;?>" />
    
    <?
    $cekdokumen = $this->mOrder->getOrderDokumenList('','',$kd_order_sertifikasi);
    
    if ($cekdokumen) {?>  
            <input type="hidden" name="edit" value="true" id="edit" />
            <input type="hidden" name="save" id="save" value="1" />
    <? }else {?>  
            <input type="hidden" name="edit" value="false" id="edit" />
            <input type="hidden" name="tambah" value="1" id="tambah" />
            <input type="hidden" name="save" id="save" value="1" />
    <?}?>
 
	<?php //if ($data){ ?>
		<?php //foreach ($data as $item => $value):?> 
         <?php //echo $item;?>: <?php //echo $value;?>
	<?php //endforeach;?>
	<?php //} ?>
			<div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Dokumen Diterima</label>
                    <div class="col-sm-6">
					<input type="text" id="tgl_dokumen_diterimas"  name="tgl_dokumen_diterima" 
                            value="<? if($tgl_dokumen_diterima != "") echo $tgl_dokumen_diterima; else echo date("Y-m-d");?>" class="form-control" readonly>  
							
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Dokumen Lengkap</label>
                    <div class="col-sm-6">                      
                             <? if($tgl_dokumen_lengkap != "") echo $tgl_dokumen_lengkap; else echo '(Belum Lengkap)';?>
                             
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penyerah Dokumen</label>
                    <div class="col-sm-6">                        
                              <?=$nama_penyerah_dokumen;?>
                        
                    </div>       
                </div>
            </div>
			<!--
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penerima Dokumen</label>
                    <div class="col-sm-6">                        
                             <? //if($nama_penerima_dokumen != "") $nama_penerima_dokumen; else echo 'Diisi oleh petugas';?>
                    </div>       
                </div>
            </div>
			-->
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-12 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-3 control-label">Pilih Dokumen</label>
                    <div class="col-sm-9"> 
                    		<?=$this->listDokumen;?>
                            <?
                                if($this->listDokumen1) echo $this->listDokumen1 ; 
                            ?>
							
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-12 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        
                </div>
            </div>
			<!--
			<div class="row">
        		<div class="form-group">
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<input type="hidden" name="save" id="save" value="1" />
							<button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                	</div>
        		</div>
        	</div>
			-->
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>




<?=$this->load->view('view_footer');?>
