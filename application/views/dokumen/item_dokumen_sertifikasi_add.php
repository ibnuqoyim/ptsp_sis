<? $this->load->view('view_header');?>
<div>
        <ul class="nav nav-tabs" class="tabs">
            <li><a href="<?=base_url();?>index.php/tarif/JenisSertifikasi">Tarif</a></li>
            <li><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li  class="active"><a href="<?=base_url();?>index.php/dokumen/itemDokumen">Dokumen</a></li>
            <li><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <li><a href="<?=base_url();?>index.php/auditor">Auditor</a></li>
        </ul>
</div>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/";?>">Dokumen</a></li>
    <li class="active">Add</li>
</ul>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
    <fieldset><legend><b><?=$this->judul;?></b></legend>
    <input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
    <input type="hidden" name="kd_sertifikasi_dokumen" value="<?=$kd_sertifikasi_dokumen;?>" id="kd_sertifikasi_dokumen" />
    <input type="hidden" name="kd_sertifikasi_jenistarif" value="<?=$kd_sertifikasi_jenistarif;?>" id="kd_sertifikasi_jenistarif" />
    <input type="hidden" name="kd_sertifikasi_jenis" value="<?=$kd_sertifikasi_jenis;?>" id="kd_sertifikasi_jenis" />
    <input type="hidden" name="save" value="1" />
                        
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Nama Item Dokumen</label>
                    <div class="col-sm-10">                         
                            <?=form_input(array('name'=>'nama_sertifikasi_dokumen','class'=>'form-control',
                                'value'=>$nama_sertifikasi_dokumen));?>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Jenis Dokumen</label>
                    <div class="col-sm-10">                         
                            
                                <?php
                                    $options= array('',
                                     'Pemohon'  => 'Pemohon',
                                     'Importir'    => 'Importir',
                                     'Manufaktur'    => 'Manufaktur'
                                     );
                                    echo form_dropdown('jenis_dokumen', $options, $jenis_dokumen,'class="form-control"');
                                ?>
                    </div>
                </div>
            </div> 
            <div class="col-xs-12"><hr></div>
            <div class="row">
                <div class="form-group">
                    <label   class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div lass="col-sm-10"> 
                            <button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                            <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
                     class="button">Kembali</button>
                    </div>
                </div>
            </div>


    
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>