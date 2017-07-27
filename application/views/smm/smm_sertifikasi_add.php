<? $this->load->view('view_header');?>
<div>
		<ul class="nav nav-tabs" class="tabs">
    		<li><a href="<?=base_url();?>index.php/tarif/JenisSertifikasi">Tarif</a></li>
    		<li ><a href="<?=base_url();?>index.php/komoditi">Komoditi</a></li>
            <li><a href="<?=base_url();?>index.php/dokumen/ItemDokumen">Dokumen</a></li> 
            <li class="active"><a href="<?=base_url();?>index.php/smm">SMM</a></li>
            <li><a href="<?=base_url();?>index.php/auditor">Auditor</a></li>
		</ul>
<ul class="breadcrumb">
    <li><a href="<?=site_url()."/".$this->uri->segment(1)."/";?>">SMM</a></li>
    <li class="active">Tambah</li>
</ul>
<p><?=$this->errormsg;?></p>
<?=form_open(current_url());?>
	<fieldset><legend><b><?=$this->judul;?></b></legend>
	<input type="hidden" name="tambahlagi" value="0" id="tambahlagi" />
	<input type="hidden" name="save" value="1" />
	 		<div class="row">
        		<div class="form-group">
        			<label  class="col-sm-2 control-label">Nama Jenis Panduan Mutu</label>        			
                    <div class="col-sm-10"><?=form_error('nama_sertifikasi_smm')?>      
                            <input type="text" id="nama_sertifikasi_smm" name="nama_sertifikasi_smm" 
                            value="<?=$nama_sertifikasi_smm;?>" class="form-control" >                             
                    </div>
        		</div>
        	</div> 
        	<div class="col-xs-12"><hr></div>
        	<div class="row">
        		<div class="form-group">
        			<label   class="col-sm-2 control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
        			<div lass="col-sm-10"> 
        					<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
		  					<!--<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?="SMM/index";?>'" 
                     class="button">Kembali</button>-->
                            <button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?=site_url($this->session->userdata('returnurl'));?>'" 
                     class="button">Kembali</button>
                	</div>
        		</div>
        	</div>


	
    </fieldset>
<?=form_close();?>
<?=$this->javascript;?>
<? $this->load->view('view_footer');?>