<script language="javascript">
function groupChk(){
	t=parseInt($('#groupid').val());
	switch(t){
	case 0://blank
		$('#ijin_tulis').attr({checked:false,disabled:true});
		$('#ijin_hapus').attr({checked:false,disabled:true});
		$('#tulis_perda').attr({checked:false,disabled:true});
		$('#lihat_tlh').attr({checked:false,disabled:true});
		break;
	case 1://super user
		$('#ijin_tulis').attr({checked:true,disabled:true});
		$('#ijin_hapus').attr({checked:true,disabled:true});
		$('#tulis_perda').attr({checked:true,disabled:true});
		$('#lihat_tlh').attr({checked:true,disabled:true});
		break;
	case 2://tlh
		$('#ijin_tulis').attr({checked:false,disabled:false});
		$('#ijin_hapus').attr({checked:false,disabled:false});
		$('#tulis_perda').attr({checked:true,disabled:true});
		$('#lihat_tlh').attr({checked:true,disabled:true});
		break;
	case 5://admin data
		$('#ijin_tulis').attr({checked:true,disabled:true});
		$('#ijin_hapus').attr({checked:false,disabled:false});
		$('#tulis_perda').attr({checked:false,disabled:true});
		$('#lihat_tlh').attr({checked:false,disabled:true});
		break;
	case 6://admin user
		$('#ijin_tulis').attr({checked:true,disabled:true});
		$('#ijin_hapus').attr({checked:false,disabled:false});
		$('#tulis_perda').attr({checked:false,disabled:true});
		$('#lihat_tlh').attr({checked:false,disabled:true});
		break;
	default:
		$('#ijin_tulis').attr({checked:false,disabled:false});
		$('#ijin_hapus').attr({checked:false,disabled:false});
		$('#tulis_perda').attr({checked:false,disabled:false});
		$('#lihat_tlh').attr({checked:false,disabled:false});
		break;
	}
}

$(function(){
	$('#groupid').change(function(){
		groupChk()
	});
	
	groupChk()
});
</script>