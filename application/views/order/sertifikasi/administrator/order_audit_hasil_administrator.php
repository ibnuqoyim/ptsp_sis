<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
    <div class="steptitle">Step 8</div>
    
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
        $tombol1='<span style="float:left">
                        <img src="images/printer.gif" border="0" height="40"><br />
                  <span class="textkolom"><b>Cetak</span></b></span>';
        $tombol2='<span style="float:right">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/email3.png" border="0" height="40"><br />
                  <span class="textkolom"><b>Kirim Ke Step Berikutnya</b></span></span>';

        //echo anchor('order/cetak/'.base64_encode(current_url()),
         //       $tombol1,'target="_blank" border="0" height ="40" style="text-decoration:none"');
        if($step_status=='Audit'){
        echo anchor('order/kirimDataOrderStepBerikutnya/'.$kd_order_sertifikasi.'/Evaluasi/orderEvaluasi/?TB_iframe=true&height=500&width=900',
                $tombol2,'border="0" height ="40" style="text-decoration:none"');
        }
        ?>
        
    </P>    
    
<p>&nbsp;</P>
	<div>
		<ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>">Hasil Audit</a></li>         
    		<li><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>"><font color="red">Hasil Audit Per Temuan</font></a></li>
            <li><a href="<?=base_url();?>index.php/order/orderAuditSHU/<?=$kd_order_sertifikasi;?>">laporan Hasil Uji</a></li>
		</ul>
	</div>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="status_temuan_audithasil" value="diterima" id="status_temuan_audithasil" />
    <input type="hidden" name="kd_order_audit" value="<?=$kd_order_audit;?>" id="kd_order_audit" />
    <input type="hidden" name="tambah" id="tambah" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Temuan (Akhir Audit)</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_temuan_audithasil','value'=>$tgl_temuan_audithasil,
                                'id'=>'tgl_temuan_audithasil',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Hasil Audit Diterima dari Auditor </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_diterima_audithasil','value'=>$tgl_diterima_audithasil,
                                'id'=>'tgl_diterima_audithasil',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            
            <div class="row">          
            
          
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambah" value="1" class="btn btn-primary" >Simpan</button>
                            <a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>/-/addPerbaikan" class="btn btn-primary">Tambah Tindakan Perbaikan</a>
                	</div>
        		</div>
        	</div>

        	<div class="col-xs-12"><hr></div>



        	<div class="row">
        		<div class="form-group">
        	<? 
			if($resultOrderAuditHasilPerbaikan)	
				$this->load->view('order/sertifikasi/administrator/view_order_audit_hasil_perbaikan_administrator.php');
			?>
				</div>
        	</div>

        	

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>