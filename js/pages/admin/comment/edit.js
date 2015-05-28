function permission_comment(id, value)
{

    $.ajax({
        url : "",
        type: 'POST',
        data: {
            action : 'permission_comment',
            id : id,
            value : value
        },
        success: function(response)
        {
            // $('#msg').html('<div class="alert alert-success">'+response+'</div>').hide().fadeIn(1000);
            // search('', 'content_manager_keyword', '#contentDiv');  
        },
        error:function(response)
        {
            console.log(response)     
        }
   });

}