<?$this->load->view('view_header');?>
<?=form_open(current_url());?>
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
    <fieldset>

            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Dokumen Diterima</label>
                    <div class="col-sm-6"><?=$tgl_dokumen_diterima;?> </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Tanggal Dokumen Lengkap</label>
                    <div class="col-sm-6"><?=$tgl_dokumen_lengkap;?>
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penyerah Dokumen</label>
                    <div class="col-sm-6"><?=$nama_penyerah_dokumen;?></div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-3 control-label">Nama Penerima Dokumen</label>
                    <div class="col-sm-6"><?=$nama_penerima_dokumen;?></div>       
                </div>
            </div>
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
                                if($this->listDokumen1) echo $this->listDokumen1; 
                            ?>
                            
                    </div>       
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-12 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        
                </div>
            </div>
              
</fieldset>
<?=$this->javascript;?>
<?=form_close();?>

<?=$this->load->view('view_footer');?>
