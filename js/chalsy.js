<!--
$(function(){
	$('#image0').hover(
		function (){$(this).attr('src','<?=base_url();?>images/logout-tombol-1_02.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/logout-tombol-1_01.jpg');}
	);
	$('#image1').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_01.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_01.jpg');}
	);
	$('#image2').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_02.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_02.jpg');}
	);
	$('#image3').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_03.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_03.jpg');}
	);
	$('#image4').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_04.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_04.jpg');}
	);
	$('#image5').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_05.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_05.jpg');}
	);
	$('#image6').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_06.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_06.jpg');}
	);
	$('#image7').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_07.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_07.jpg');}
	);
	$('#image8').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_08.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_08.jpg');}
	);
	$('#td_dropdownmenu').hover(
		function (){
			$('#dropdownmenu').show();
		},
		function (){
			$('#dropdownmenu').hide();
		}
	);
	$('#image5').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_hvr_05.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_login_05.jpg');}
	);
	$('#imagetlh').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_tlh_hvr.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_tlh.jpg');}
	);
	$('#kepatuhan_01').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_hvr_01.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_01.jpg');}
	);
	$('#kepatuhan_02').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_hvr_02.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_02.jpg');}
	);
	$('#kepatuhan_03').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_hvr_03.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_03.jpg');}
	);
	$('#kepatuhan_04').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_hvr_04.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_04.jpg');}
	);
	$('#kepatuhan_05').hover(
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_hvr_05.jpg');},
		function (){$(this).attr('src','<?=base_url();?>images/topmenu_kepatuhan_05.jpg');}
	);

	$('#chkall').click(function(){
		checked=this.checked;
		$('.chkall').each(function(){
			this.checked=checked;
		});
	});
	
	$('input').focus(function(){
		this.select()
	});
	$('textarea').focus(function(){
		this.select()
	});
	
});

function goReset(){
	$('#frmsearch input:text').each(function(){
		this.value='';
	});
	$('#frmsearch select').each(function(){
		this.selectedIndex=0;
	});
}
