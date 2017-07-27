<script language="javascript">
$(function(){
	$('#formdelete').submit(function(){
		checked=$('.chkall:checked').length
		if(checked>0){
			tanya=confirm('Hapus '+checked+' user?')
			if(tanya){
				return true;
			}
		}
		return false;
	});
});

function setLimit(v){
	window.location.href='<?=base_url().$this->config->slash_item('index_page').$limiturl;?>'+v;
}

$(function(){
	$('#addbutton').click(function(){
		window.location.href='<?=site_url('mst_jenis_tarif/edit');?>';
	});
});
</script>