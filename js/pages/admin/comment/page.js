function delete_comment(id)
{
    $.ajax({
        url : "",
        type: 'POST',
        data: {
            action : 'delete_comment',
            id : id
        },
        success: function(response)
        {
            // $('#msg').html('<div class="alert alert-success">'+response+'</div>').hide().fadeIn(1000);
            // search('', 'content_manager_keyword', '#contentDiv');  
            $("#msg_success").html(response);
            $("#msg_success").css({'display':'block'});
            $("#"+id).remove();
        },
        error:function(response)
        {
            console.log(response)     
        }
   });

}