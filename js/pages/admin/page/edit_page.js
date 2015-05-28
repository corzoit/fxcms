function deleteImage(domKeyId, dbField)
{
	var keyIds = domKeyId.split("_")

	$.ajax({
        
    	type: 'POST',
        //url : "edit_page",
    	data: {
     		action   : 'deleteimage',
     		page_id    : keyIds[1],
     		field : dbField
    	},
    	success: function(response)
    	{
            $("#"+domKeyId).fadeOut(800, function () {
                $("#"+domKeyId).remove();
            });
    	},
    	error:function(response){
     		console.log(response)     
    	}
   });
}

$(".images").fancybox({ });

