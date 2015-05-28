$( function(){      
    $("#add-new-image").click(function(){
        //alert();
        fx_slideshow_id = $(this).attr("data");
        //alert(fx_slideshow_id);
        $("#add-new-image").fancybox({                        
            'width'  : 400,       
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
                    action          : "new-image",   
                    fx_slideshow_id : fx_slideshow_id
                },            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
    });

    $(".delete-slide-show-image").click(function(){
        fx_slideshow_image_id = $(this).attr("data");
        warning = $(this).attr("warning");
        success = $(this).attr("success");

        if(confirm(warning))
        {
            $.ajax({
                type: 'POST',
                data: {
                    action                    : 'delete-slide-image',
                    fx_slideshow_image_id     : fx_slideshow_image_id,
                },
                success: function(response)
                {
                    //if(confirm(warning))
                    location.reload();
                },
                error:function(response){
                    //console.log(response)     
                }
           });
        }
    });     

    $(".edit-slide-show-image").click(function(){
        fx_slideshow_image_id = $(this).attr("data");

        $(".edit-slide-show-image").fancybox({                        
            'width'  : 400,       
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
                    action                : "edit-slide-show-image", 
                    fx_slideshow_image_id : fx_slideshow_image_id
                },            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
    });   

    $("#preview-slideshow").click(function(){
        fx_slideshow_id = $(this).attr("data");

        $("#preview-slideshow").fancybox({                        
            'width'  : 'auto',       
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
                    action                : "preview-slideshow", 
                    fx_slideshow_id       : fx_slideshow_id
                },            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
    });     

    $(".save-position").click(function(){
        
        serialize = $(".dd").nestable('serialize');
        success = $(this).attr("success");
        //alert(success);
        $.ajax({
            type: 'POST',
            data: {
                action                    : 'save-position',
                serialize                 : serialize,
            },
            success: function(response)
            {
                html = "<div class = 'alert alert-success' style = 'margin-bottom: 0px !important'>";
                html += success;
                html += "</div>";
                $(".content-error").html(html);

                $(".content-error").fadeTo(2000, 500).slideUp(500, function(){});
            },
            error:function(response){
                //console.log(response)     
            }
       });
    }); 

    $('.dd').nestable({ maxDepth : 1 });
});