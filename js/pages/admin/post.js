function deletePost(postId)
{
	if (confirm("to delete the post ?")) {
		$.ajax({			
			//url : "../_core/interactive/admin/post.php",
			type: 'POST',
			data: {
				action		: 'postId',
				fx_post_id  : postId
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