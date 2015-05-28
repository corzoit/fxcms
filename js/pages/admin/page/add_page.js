$(function(){		
	$('.selectpicker').selectpicker({style: 'btn-primary'});
	$('.input-block-level').attr('placeholder','Search section...');
	$(":file").filestyle({buttonName: "btn-primary", 'buttonText': 'choose image..'});			

	$("#chk_page_type_none").click(function(){
		$("#content_page_gallery").css({'display':'none'});
		$("#content_page_none").css({'display':'block'});				
	});
	$("#chk_page_type_gallery").click(function(){
		$("#content_page_none").css({'display':'none'});		
		$("#content_page_gallery").css({'display':'block'});
	});
	//daniel
	var selected_section_section_type_default = $(".selectpicker option:selected").attr('data');
	if(selected_section_section_type_default == 'Standard') {
		$("#form_product").css({'display' : 'none'});
		$('input[name=section_type]').val(selected_section_section_type_default);
	}
	$('.selectpicker').on('change', function() {
	  var selected_section_section_type = $(".selectpicker option:selected").attr('data');	
		if(selected_section_section_type == 'Standard') {
			$("#form_product").css({'display' : 'none'});
			$('input[name=section_type]').val(selected_section_section_type);
		}	
		else
		{
			$("#form_product").css({'display' : 'block'});
			$('input[name=section_type]').val(selected_section_section_type);
		}
	});		
});


function createDateFormat(format_d)
{	
	$('#datetime_show').datetimepicker({format:format_d});    
	$('#datetime_hide').datetimepicker({format:format_d});
}