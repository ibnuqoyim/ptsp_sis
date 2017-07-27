<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 3</div>
	<?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <? 
        
       
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>'; 
         $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

        if($order_status){
            $no=0;
            foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
            }
        } 
        if($step_status=='Penawaran'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Kontrak/orderKontrak/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?></p>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li class="active"><a href="#">Data Penawaran</a></li>
    		<!--<li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Surat Penawaran</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderLampiranPenawaran/<?=$kd_order_sertifikasi;?>">Cetak Lampiran Penawaran</a></li>-->
		</ul>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
<p><?//=@$this->errormsg;?></p>
<fieldset><legend><b></b></legend>
    <input type="hidden" name="kd_order_sertifikasi" id="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" />
    <input type="hidden" name="kd_sertifikasi_jenistarif" id="kd_sertifikasi_jenistarif" value="<?=$kd_sertifikasi_jenistarif;?>" />
    <input type="hidden" name="kd_sertifikasi_jenis" id="kd_sertifikasi_jenis" value="<?=$kd_sertifikasi_jenis;?>" />
    <input type="hidden" name="totbiayaorder" id="totbiayaorder" value="<?=$totbiayaorder;?>" />
    <input type="hidden" name="harga_total_penawaran" id="harga_total_penawaran" value="<?=$harga_total_penawaran;?>" />
    <input type="hidden" name="save" id="save" value="1" />
    <?
    $cekpenawaran = $this->mOrder->getOrderPenawaranList('','',$kd_order_sertifikasi);
    
   // if($cekpenawaran) {?>  
            <!--<input type="hidden" name="edit" value="true" id="edit" />-->
    <?//}else {?>  
            <!--<input type="hidden" name="edit" value="false" id="edit" />-->
            <input type="hidden" name="tambah" value="1" id="tambah" />
           
    <?//}?>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nomor Surat Permohonan dari Pemohon</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="no_surat_permohonan"  name="no_surat_permohonan" 
                            value="<?=$no_surat_permohonan;?>" class="form-control" >  
                        
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Surat Permohonan dari Pemohon</label>
                    <div class="col-sm-6">                      
                             
                             <?=form_input(array('name'=>'tgl_surat_permohonan','value'=>$tgl_surat_permohonan,
                                'id'=>'tgl_surat_permohonan',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
			<div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nomor Surat Penawaran</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="no_penawaran"  name="no_penawaran" 
                            value="<?=$no_penawaran;?>" class="form-control" >  
                        
                    </div>       
                </div>
            </div>
           
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Surat Penawaran</label>
                    <div class="col-sm-6">                      
                             
                             <?=form_input(array('name'=>'tgl_penawaran','value'=>$tgl_penawaran,
                                'id'=>'tgl_penawaran',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Perihal Surat Penawaran</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="perihal_penawaran"  name="perihal_penawaran" 
                            value="<?=$perihal_penawaran;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Jumlah Lampiran Surat Penawaran</label>
                    <div class="col-sm-6">                      
                             <input type="text" id="jumlah_lampiran_penawaran"  name="jumlah_lampiran_penawaran" 
                            value="<?=$jumlah_lampiran_penawaran;?>" class="form-control" >  
                    </div>       
                </div>
            </div>
            <!--
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Isi Paragraf 1 Surat Penawaran</label>
                    <div class="col-sm-6">                      
                             <textarea  id="isi_surat_penawaran"  name="isi_surat_penawaran" class="form-control"  rows="10"> </textarea>
                    </div>       
                </div>
            </div>
            -->
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nip Pembuat Penawaran</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="nip_pembuat_penawaran"  name="nip_pembuat_penawaran" 
                            value="<?=$nip_pembuat_penawaran;?>" class="form-control" >  
                            
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Pembuat Penawaran</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="nama_pembuat_penawaran"  name="nama_pembuat_penawaran" 
                            value="<?=$nama_pembuat_penawaran;?>" class="form-control" >  
                            
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nip Penandatangan Penawaran</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="nip_penandatangan_penawaran"  name="nip_penandatangan_penawaran" 
                            value="<?=$nip_penandatangan_penawaran;?>" class="form-control" >  
                            
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Penawaran</label>
                    <div class="col-sm-6">                        
                              <input type="text" id="nama_penandatangan_penawaran"  name="nama_penandatangan_penawaran" 
                            value="<?=$nama_penandatangan_penawaran;?>" class="form-control" >  
                            
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-12 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-3 control-label">Pilih Jenis Tarif</label>
                    <div class="col-sm-9"> 
                    		<?=$this->listTarifItem;?>							
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                	<label   class="col-sm-12 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        
                </div>
            </div>
			<div class="row">
        		<div class="form-group">
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" class="btn btn-primary">Simpan</button>                           
                	</div>
        		</div>
        	</div>
            <div class="col-xs-12"><hr></div>

            <div class="row">
                <div class="form-group">
            <? 
            if($result) 
                $this->load->view('order/sertifikasi/administrator/view_order_penawaran_administrator.php');
            ?>
                </div>
            </div>   
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>