<div class="form">
	<?=form_open('tarif/InputItem/'.$kd_sertifikasi_jenistarif,array('kd_sertifikasi_jenistarif'=>'frmsearch'));?>
		<fieldset>			
			<legend><b>Pencarian</b></legend>				
			<div class="form-group">
				<div>
					<label  for="nama_sertifikasi_jenistarifitem" class="control-label col-xs-2">Nama Jenis Tarif Item </label>
					<div class="col-xs-10">						
						<?=form_input('nama_sertifikasi_jenistarifitem','','class="form-control" id="nama_sertifikasi_jenistarifitem"');?>
					</div>	
				</div>
			</div>
			<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
					<a href="javascript:void();"><button type="submit" class="btn btn-primary">Cari</button></a>&nbsp;
					<a href="javascript:void();"><button type="button" class="btn btn-primary" onclick="goReset()">Reset</button></a>	
					</div>				
			</div>					
		</fieldset>
	<?=form_close();?>
</div>