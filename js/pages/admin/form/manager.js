$(function(){
    $("#search_keyword").keyup(function(){
        var title_page = $("#search_keyword").val();
        var autocomp = new Array();
        $.ajax({
            type     : 'POST',
            dataType : 'json',
            data     : {
                'action'     : "fill_search_keyword",
                'title_page' : title_page
            },
            success: function(jsonObj){                
                $.each(jsonObj, function(i, alObj){
                    autocomp.push({ id: alObj.fx_page_id, label : alObj.title })
                });                
                $("#search_keyword").autocomplete({
                    source: autocomp,
                    maxItems: 5,
                    select: function(event, ui) {                             
                        $("#search_keyword").attr("data", ui.item.id);
                    }
                });                
            },
            error:function(){
                console.log("Error");
            }
        });
    });
});

function makeCopy(fx_form_id)
{
    searchKeyword = $("#search_title").val();
    $.ajax({
        url : "",
        type: 'POST',
        data: {
            action : 'makeCopy',
            fx_form_id : fx_form_id,
        },
        success: function(response)
        {
            search(searchKeyword,  'search_title', '#content-form');      
        },
        error:function(response)
        {
            console.log(response)     
        }
   });
}

function deletePage(KeyId)
{
    //alert(KeyId);
    searchKeyword = $("#search_title").val();
    //alert(searchKeyword);
    bootbox.confirm("Realmente desea eliminar el registro?", function(result) {
        if(result){
            $.ajax({
                url : "",
                type: 'POST',
                data: {
                    action  : 'deleteForm',
                    form_id : KeyId,
                },
                success: function(response)
                { 
                    // alert(searchKeyword);
                    //search(searchKeyword, 'search_title', '#content-form');      
                     location.reload(); 
                },
                error:function(response){
                    console.log(response)     
                }
            });
        }
    }); 
}
