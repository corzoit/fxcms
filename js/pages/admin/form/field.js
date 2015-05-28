$(function(){
    formId = $("#form_id").val(); 
    search(formId, 'view_field', '#content-field');


	$("#msg-succes").fadeIn(2000);

	$(".add-new-field").click(function(){
		form_id = $(this).attr('data');
		$(".add-new-field").fancybox({  
			'width'  : 700,       
    		'height' : 'auto',                      
            'type': 'ajax',
            'fitToView': false,
            'autoSize': false, 
            'scrolling'   : 'no',  

            helpers     : { 
		        overlay : {closeClick: false} 
		    },   
            ajax : {
                type    : "POST",
                data: {
	                action    : "add-field", 
	                form_id	  :	form_id,       		
    			},            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
	});

});


function edit_field(formID)
{
    $(".edit-field").fancybox({  
        'width'  : 700,       
        'height' : 'auto',                      
        'type': 'ajax',
        'fitToView': false,
        'autoSize': false, 
        'scrolling'   : 'no',  

        helpers     : { 
            overlay : {closeClick: false} 
        },   
        ajax : {
            type    : "POST",
            data: {
                action    : "edit-field", 
                form_field_id     : formID,              
            },            
        },
        onStart     :   function() {                
            $(this).css('border','1px red solid')
        },                    
    });
}

function field_required()
{
	$.ajax({
		        
    	type: 'POST',
        
    	data: {
     		action   : 'field_required',
     		field : $('#send').serializeArray()
    	},
    	success: function(response)
    	{		
            $("#errors").html(response).fadeOut(0).fadeIn(1000);
    	},
    	error:function(response){
     		console.log(response)     
    	}
    });
}

