function deleteContact(contactId)
{
	if (confirm("to delete the contact ?")) {
		$.ajax({			
			//url : "../_core/interactive/admin/contact.php",
			type: 'POST',
			data: {
				action		: 'delete_contact',
				fx_contact_id  : contactId
			},
			success: function()
			{
				location.reload();				
			},
			error:function(response)
			{
				console.log(response)				
			}

		});
	}	
}

function formEditContact(contactId)
{	
	$(".fancyEditContact").fancybox({
		'type': 'ajax',		
        'autoSize': true, 		
		maxWidth: "100%", //				
		autoSize: false,		
		helpers     : { 
	        overlay : {closeClick: false} 
	    },	
        ajax : {
	        type    : "POST",
	        //url 	: "../_core/interactive/admin/contact.php", 
	        data: {
	            action    		: "form_edit_contact", 
	            fx_contact_id 	: contactId      		
			},            
	    }		
	});
		     		
}

function formAddContact()
{	
	$(".fancyAddContact").fancybox({
		'type': 'ajax',		
        'autoSize': true, 		
		maxWidth: "100%", //				
		autoSize: false,		
		helpers     : { 
	        overlay : {closeClick: false} 
	    },	
        ajax : {
	        type    : "POST",
	        //url 	: "../_core/interactive/admin/contact.php", 
	        data: {
	            action    		: "form_add_contact", 	           
			},			
	    }
	});
}


function editContact(contactId)
{		
	var serialize = $("#form-edit-contact input").serialize();	
	console.log(serialize);
	$.ajax({
		type	: "POST",		
		data	: serialize,
		success: function(data){			
			location.reload();
		}
	});	
}

function closeFancy()
{
	$.fancybox.close();
}

function addContact()
{
	var serialize = $("#form-add-contact input").serialize();	
	$.ajax({
		type	: "POST",		
		data	: serialize,
		success: function(response){			
			var json = $.parseJSON(response);			
			if(json.success)
			{
				$(".msgError").hide();
				$(".msgSuccess").show();
				$(".msgSuccess").html(json.msg);				
				setTimeout(function() {
					location.reload();
				},10000);								
			}
			else
			{						
				$(".msgSuccess").hide();
				$(".msgError").show();
				$(".msgError").html(json.msg);				    
			}
		}
	});	
}