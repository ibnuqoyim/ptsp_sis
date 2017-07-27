<div class="form">
	<?=form_open(current_url(),array('id'=>'frmsearch'));?>
		<fieldset>
			<legend><b>Pencarian</b></legend>
				<div class="form-group">							
					<label  for="nama_sertifikasi_komodit" class="control-label col-sm-2">Nama Komoditi </label>
					<div class="col-sm-10">						
							<?=form_input('nama_sertifikasi_komoditi','','class="form-control" id="nama_sertifikasi_komoditi"');?>
							</div>	
				</div>
				<div class="form-group">
					<div  class="col-sm-offset-10 col-sm-10">
							<a href="javascript:void();"><button type="submit" class="btn btn-primary">Cari</button></a>&nbsp;
							<a href="javascript:void();"><button type="button" class="btn btn-primary" onclick="goReset()">Reset</button></a>	
					</div>				
				</div>					
		</fieldset>
	<?=form_close();?>
</div>