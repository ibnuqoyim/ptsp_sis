<?$this->load->view('view_header');?>
<p></p>
<?=form_open(current_url());?>
    <div class="steptitle">Step 6</div>
    <div class="wizard-steps">
<?
$order_status=$this->mOrder->getOrderSertifikasiStatus($kd_order_sertifikasi);
//echo $kd_order_sertifikasi;

if($order_status){
        $no=0;
        foreach($order_status as $row){
                $no++;  
                $step_status=$row->kd_step_status;
        }
}
?>
    <?php if($step_status=='Teregistrasi'  || $step_status=='Closed') { ?>
        <div class="active-step"><a href="index.php/order/Edit"><span>1</span> Permohonan</a></div>
        <div><a href="Step 2" onclick="return false"><span>2</span> Dokumen</a></div>
        <div><a href="Step 3" onclick="return false"><span>3</span> Penawaran</a></div>
        <div><a href="Step 3" onclick="return false"><span>4</span> Penagihan</a></div>
        <div><a href="Step 4" onclick="return false"><span>5</span> Pembayaran</a></div>
        <div><a href="Step 5" onclick="return false"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Dokumen'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="active-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div><a href="Step 3" onclick="return false"><span>3</span> Penawaran</a></div>
        <div><a href="Step 3" onclick="return false"><span>4</span> Penagihan</a></div>
        <div><a href="Step 4" onclick="return false"><span>5</span> Pembayaran</a></div>
        <div><a href="Step 5" onclick="return false"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Penawaran'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="active-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div><a href="Step 3" onclick="return false"><span>4</span> Penagihan</a></div>
        <div><a href="Step 4" onclick="return false"><span>5</span> Pembayaran</a></div>
        <div><a href="Step 5" onclick="return false"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Penagihan'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="active-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div><a href="Step 4" onclick="return false"><span>5</span> Pembayaran</a></div>
        <div><a href="Step 5" onclick="return false"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Pembayaran'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="active-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div><a href="Step 5" onclick="return false"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Jadwal'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="active-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Audit'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div class="active-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>7</span> Audit</a></div>
        <div><a href="Step 5" onclick="return false"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Evaluasi'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>7</span> Audit</a></div>
        <div class="active-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div><a href="Step 5" onclick="return false"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Sertifikat'  || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>7</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div class="active-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>9</span> Sertifikat</a></div>
        <div><a href="Step 5" onclick="return false"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='SerahTerima' || $step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>7</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div class="completed-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>9</span> Sertifikat</a></div>
        <div class="active-step"><a href="index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }elseif($step_status=='Closed') { ?>
        <div class="completed-step"><a href="index.php/order/Edit/<?=$kd_order_sertifikasi;?>"><span>1</span> Permohonan</a></div>
        <div class="completed-step"><a href="index.php/order/orderDokumen/<?=$kd_order_sertifikasi;?>"><span>2</span> Dokumen</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenawaran/<?=$kd_order_sertifikasi;?>"><span>3</span> Penawaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderPenagihan/<?=$kd_order_sertifikasi;?>"><span>4</span> Penagihan</a></div>
        <div class="completed-step"><a href="index.php/order/orderPembayaran/<?=$kd_order_sertifikasi;?>"><span>5</span> Pembayaran</a></div>
        <div class="completed-step"><a href="index.php/order/orderJadwal/<?=$kd_order_sertifikasi;?>"><span>6</span> Jadwal Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderAuditHasil/<?=$kd_order_sertifikasi;?>"><span>7</span> Audit</a></div>
        <div class="completed-step"><a href="index.php/order/orderEvaluasi/<?=$kd_order_sertifikasi;?>"><span>8</span> Tim Evaluasi/Teknis</a></div>
        <div class="completed-step"><a href="index.php/order/orderSertifikat/<?=$kd_order_sertifikasi;?>"><span>9</span> Sertifikat</a></div>
        <div class="completed-step"><a href="index.php/order/orderSerahTerima/<?=$kd_order_sertifikasi;?>"><span>10</span> Penyerahan Sertifikat</a></div>
    <?php }?>
    </div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>
    <div>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="<?=base_url();?>index.php/order/orderJadwalEdit/<?=$kd_order_sertifikasi;?>">Jadwal</a></li>
            <li ><a href="<?=base_url();?>index.php/order/orderAuditor/<?=$kd_order_sertifikasi;?>">Auditor</a></li>
            <li><a href="<?=base_url();?>index.php/order/viewOrderJadwal/<?=$kd_order_sertifikasi;?>">Cetak Jdawal</a></li>         
        </ul>
    </div>
    <div style="clear:both"></div>
    <p>&nbsp;</P>

<p><?=@$this->errormsg;?></p>
<?php
    
    $dat=$this->mUser->getDetail($this->session->userdata('userid'));
    
?><?=$dat->nip_baru;?><?=$dat->Nama;?>
    <input type="hidden" name="nip_penunjukanauditor_audit" value="<?=$dat->nip_baru;?>" >
    <input type="hidden" name="nama_penunjukanauditor_audit" value="<?=$dat->Nama;?>" >
    <input type="hidden" name="kd_order_sertifikasi" value="<?=$kd_order_sertifikasi;?>" id="<?=$kd_order_sertifikasi;?>" />
    <input type="hidden" name="save" value="1" />
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Mulai Audit</label>
                    <div class="col-sm-6">  
                             <?=form_input(array('name'=>'tgl_awal_audit','value'=>$tgl_awal_audit,
                                'id'=>'tgl_awal_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Akhir Audit</label>
                    <div class="col-sm-6">   
                             <?=form_input(array('name'=>'tgl_ahir_audit','value'=>$tgl_ahir_audit,
                                'id'=>'tgl_ahir_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Penunjukan Auditor</label>
                    <div class="col-sm-6">   
                             <?=form_input(array('name'=>'tgl_penunjukanauditor_audit','value'=>$tgl_penunjukanauditor_audit,
                                'id'=>'tgl_penunjukanauditor_audit',
                            'class'=>'input-text','size'=>'10','maxlength'=>'10'));?> 
                        <style type="text/css">.embed + img { position: relative; left: -21px; top: -1px; }</style>
                    </div>       
                </div>
            </div>
            <div class="col-xs-12"><hr></div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-6 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div lass="col-sm-12"> 
                        <button type="submit" class="btn btn-primary">Simpan</button>&nbsp;&nbsp;
                        <!--<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url()."/order";?>'">Kembali</button>-->
                </div>
            </div>
             
            
            
    </div>     
</div>
<?=$this->javascript;?>  
<?=form_close();?>

    



<? $this->load->view('view_footer');?>