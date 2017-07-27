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
<fieldset></legend>
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
            <? 
            if($result) 
                $this->load->view('order/sertifikasi/customer/view_order_penawaran_customer.php');
            ?>
                </div>
            </div>   
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>