<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 7</div>
    
    <?
    $this->load->view('order/step_order.php');
    $order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);

    if($order_status){
        $no=0;
        foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
        }
    }
    ?>
    
   <div style="clear:both"></div>
     <p>&nbsp;</P>
    <p> <? 
       
        $tombol2='<span style="float:right">
                        &nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

        if($step_status=='Jadwal'){          
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Audit/orderAuditHasil/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>    
    <p>&nbsp;</P>
    <p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
    		<li><a href="<?=base_url();?>index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>">Jadwal Audit</a></li>            
    		<li><a href="<?=base_url();?>index.php/order/orderAuditor/<?=$kd_order_sertifikasi;?>">Auditor</a></li>
            <li  class="active"><a href="<?=base_url();?>index.php/order/orderJadwalDetail/<?=$kd_order_sertifikasi;?>">Audit Plan</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderSuratPenunjukan/<?=$kd_order_sertifikasi;?>">Cetak Surat Penujukan</a></li>
		</ul>
	</div>

<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Pelaksanaan Audit </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_audit_jadwaldetail','value'=>$tgl_audit_jadwaldetail,
                                'id'=>'tgl_audit_jadwaldetail',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Waktu Pelaksanaan Audit (pukul)</label>
                    <div class="col-sm-6"> 
                            <input type="text" id="waktu_audit_detailr" name="waktu_audit_jadwaldetail" 
                            value="<?=$waktu_audit_jadwaldetail;?>" class="form-control" >  
                              
                    </div>
                </div>
            </div>  
			<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-3 control-label">Deskripsi Pelaksanaan Audit</label>
        			<div class="col-sm-6">
                            <textarea  name="eskripsi_audit_jadwaldetail"  rows="5" cols="65" class="tinymce"></textarea>
					</div>
        		</div>
        	</div>			
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Nama Singkat Auditor</label>
                    <div class="col-sm-6">
                        <select name="singkatan_nama_auditor" id="singkatan_nama_auditor" class="form-control">
                            <option value="Tim">Tim</option>
                            <?php foreach($resultOrderAuditor as $row){ ?>
                            <option value="<?=$row->singkatan_nama_auditor;?>"><?=$row->singkatan_nama_auditor;?></option> 
                        <?php } ?>
                        </select>
                        
                    </div>
                </div>
            </div>
        	
             
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
			if($resultOrderJadwalDetail)	
				$this->load->view('order/sertifikasi/administrator/view_jadwal_detail_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>