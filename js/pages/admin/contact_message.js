function deleteContactMessage(contactMsgId)
{		
	if (confirm("to delete the post ?")) {
		$.ajax({			
			//url : "../_core/interactive/admin/contact_message.php",
			type: 'POST',
			data: {
				action		: 'delete_contact_message',
				fx_contact_message_id  : contactMsgId
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