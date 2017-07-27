<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
	<div class="steptitle">Step 4</div>
    <?php 
        $this->load->view('order/step_order.php');
    ?>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <p> <? 
        $tombol1='<span style="float:left">
                        <img src="images/printer.gif" border="0" height="40"><br />
                  <span class="textkolom"><b>Cetak</span></b></span>';
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
        if($step_status=='Kontrak'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Penagihan/orderPenagihan/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        $dat=$this->mUser->getDetail($this->session->userdata('userid'));
        ?>
        
    </P>
    <p>&nbsp;</P> 
	<div>
		<ul class="nav nav-tabs" id="myTab">         
    		<li  class="active"><a href="<?=base_url();?>index.php/order/orderKontrak/<?=$kd_order_sertifikasi;?>">Data Kontrak</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="nip_pembuat_kontrak" value="<?=$dat->nip_baru;?>" >
    <input type="hidden" name="nama_pembuat_kontrak" value="<?=$dat->Nama;?>" >
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">No. Kontrak</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'no_kontrak','value'=>$no_kontrak,
                                'id'=>'no_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Kontrak Dibuat (dicetak)</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_cetak_kontrak','value'=>$tgl_cetak_kontrak,
                                'id'=>'tgl_cetak_kontrak',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Kontrak </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_bbk_kontrak','value'=>$nama_penandatangan_bbk_kontrak,
                                'id'=>'nama_penandatangan_bbk_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">NIP Penandatangan Kontrak </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nip_penandatangan_bbk_kontrak','value'=>$nip_penandatangan_bbk_kontrak,
                                'id'=>'nip_penandatangan_bbk_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Jabatan Penandatangan Kontrak  </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'jabatan_penandatangan_bbk_kontrak','value'=>$jabatan_penandatangan_bbk_kontrak,
                                'id'=>'jabatan_penandatangan_bbk_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Sertifikat ditandatangani Pihak </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_penandatangan_bbk_kontrak','value'=>$tgl_penandatangan_bbk_kontrak,
                                'id'=>'tgl_penandatangan_bbk_kontrak',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penandatangan Kontrak Perusahaan </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nama_penandatangan_perusahaan_kontrak','value'=>$nama_penandatangan_perusahaan_kontrak,
                                'id'=>'nama_penandatangan_perusahaan_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">NIP Penandatangan Kontrak Perusahaan </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'nip_penandatangan_perusahaan_kontrak','value'=>$nip_penandatangan_perusahaan_kontrak,
                                'id'=>'nip_penandatangan_perusahaan_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Jabatan Penandatangan Kontrak Perusahaan </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'jabatan_penandatangan_perusahaan_kontrak','value'=>$jabatan_penandatangan_perusahaan_kontrak,
                                'id'=>'jabatan_penandatangan_perusahaan_kontrak','class'=>'form-control'));?> 
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Kontrak ditandatangani Pihak Perusahaan</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_penandatangan_perusahaan_kontrak','value'=>$tgl_penandatangan_perusahaan_kontrak,
                                'id'=>'tgl_penandatangan_perusahaan_kontrak',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Kontrak Lengkap diterima BBK</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_diterima_kontrak','value'=>$tgl_diterima_kontrak,
                                'id'=>'tgl_diterima_kontrak',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <!--<div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Upload Dokumen Kontrak</label>
                    <div class="col-sm-6"> 
                           <input type="file" name="file_kontrak"  id="file_kontrak" class="form-control"/> 
                           
                              
                    </div>
                </div>
            </div>-->
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>
                	</div>
        		</div>
        	</div>

        	<div class="col-xs-12"><hr></div>



        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderKontrak)	
				$this->load->view('order/sertifikasi/administrator/view_order_kontrak_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>