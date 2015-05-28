$( function(){      
    //style select -- bootstrap select
    $('.selectpicker').selectpicker({style: 'btn-primary'});
    //placeholder search in combo section
    $('.input-block-level').attr('placeholder','Search section...');    
});

function makeCopy(pageId, msg)
{
    bootbox.confirm(msg, function(result) {
        if(result) {
            var keyId = pageId.split("_");
            $.ajax({
                url : "",
                type: 'POST',
                data: {
                    action : 'makeCopy',
                    pageId : keyId[1],
                },
                success: function(response)
                {
                    $('#msg').html('<div class="alert alert-success">'+response+'</div>').hide().fadeIn(1000);
                    search('', 'content_manager_keyword', '#contentDiv');  
                },
                error:function(response)
                {
                    console.log(response)     
                }
           });
        }
    });
}
