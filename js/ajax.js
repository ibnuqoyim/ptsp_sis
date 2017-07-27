$(function() {
  $( "#tabs" ).tabs({
	  ajaxOptions: {
		  error: function( xhr, status, index, anchor ) {
			  $( anchor.hash ).html(
				  "Tunggu Sebentar Kayaknya ada error.... ");
		  }
	  }
  });
});
