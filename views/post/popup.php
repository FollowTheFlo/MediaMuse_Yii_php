<script type="text/javascript">

///////////////////Add sequence////////

$(document).ready(function(){
	  
	  
	 // $('#Slider_flo li').css({ 'width': '300px'});
	  
	  $.fx.speeds._default = 500;
		$(function() {
			$( "#dialog_post_result" ).dialog({
				width: "600px",
				autoOpen: true,
				show: "blind",
				title: "Add project",
				
				
				
				
				
			});
			
			

		});

});
</script>

<div id="dialog_post_result">
<?php echo "Message saved"?>
</div>