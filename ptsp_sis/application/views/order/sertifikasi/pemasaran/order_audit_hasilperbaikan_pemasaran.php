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
    		<li><a href="<?=base_url();?>index.php/order/orderAuditHasilPerTemuan/<?=$kd_order_sertifikasi;?>">Hasil Audit Per Temuan</a></li>
            <li><a href="<?=base_url();?>index.php/order/orderAuditSHU/<?=$kd_order_sertifikasi;?>">laporan Hasil Uji</a></li>
		</ul>
	</div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/";?>">Audit Hasil</a></li>
    <li class="active">Tambah Tindakan Perbaikan</li>
</ul>
<p><?=@$this->errormsg;?></p>
    <input type="hidden" name="kd_audithasil" value="<?=$kd_audithasil;?>" id="kd_audithasil" />
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="kd_order_sertifikasi" />
    <input type="hidden" name="kd_order_audit" value="<?=$kd_order_audit;?>" id="kd_order_audit" />
    <input type="hidden" name="tambahperbaikan" id="tambahperbaikan" value="1" />
	<input type="hidden" name="save" id="save" value="1" />
             <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Tindakan Perbaikan diterima dari perusahaan </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_diterima_dari_perusahaan','value'=>$tgl_diterima_dari_perusahaan,
                                'id'=>'tgl_diterima_dari_perusahaan',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Tindakan Perbaikan diberikan kepada Auditor</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_diberikan_ke_auditor','value'=>$tgl_diberikan_ke_auditor,
                                'id'=>'tgl_diberikan_ke_auditor',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal hasil review Tindakan Perbaikan dari Auditor </label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_diterima_dari_auditor','value'=>$tgl_diterima_dari_auditor,
                                'id'=>'tgl_diterima_dari_auditor',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal hasil review Tindakan Perbaikan dkembalikan ke  Perusahaan</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_dkembalikan_ke_perusahaan','value'=>$tgl_dkembalikan_ke_perusahaan,
                                'id'=>'tgl_dkembalikan_ke_perusahaan',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Nama Auditor Yang Mereview</label>
                    <div class="col-sm-6">
                        <select name="kd_auditor" id="kd_auditor" class="form-control">
                            <option value=""> </option>
                            <?php foreach($resultOrderAuditor as $row){ ?>
                            <option value="<?=$row->kd_auditor;?>"><?=$row->nama_auditor;?></option> 
                        <?php } ?>
                        </select>
                        
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Status Hasil Review</label>
                    <div class="col-sm-6"> 
                            <input type="text" id="status_perbaikanhasil" name="status_perbaikanhasil" 
                            value="<?=$status_perbaikanhasil;?>" class="form-control" >  
                              
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-6">
                            <textarea  name="keterangan"  rows="5" cols="65" class="tinymce"></textarea>
                    </div>
                </div>
            </div>
            
            
			
            <div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group"> 
        			<label   class="col-sm-4 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-7"> 
        					<button type="submit" name="tambahperbaikan" value="1" class="btn btn-primary" >Simpan</button>
                	</div>
        		</div>
        	</div>

<?=$this->javascript;?>
<?=form_close();?>
<?=$this->load->view('view_footer');?>