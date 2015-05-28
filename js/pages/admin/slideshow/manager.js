$( function(){      
    $(".add-new-slideShow").click(function(){
        $(".add-new-slideShow").fancybox({                        
            'width'  : 300,       
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
                    action    : "add-slide-show",            
                },            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
    }); 
    
    $(".preview-slideshow").click(function(){
        fx_slideshow_id = $(this).attr("data");

        $(".preview-slideshow").fancybox({                        
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
                    action          : "preview-slideshow",    
                    fx_slideshow_id :  fx_slideshow_id
                },            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
    }); 

    $(".delete-slide-show").click(function(){
        fx_slideshow_id = $(this).attr("data");
        msg = $(this).attr("msg");

        if(confirm(msg))
        {
            $.ajax({
                type: 'POST',
                data: {
                    action              : 'delete-slide',
                    fx_slideshow_id     : fx_slideshow_id,
                },
                success: function(response)
                {
                    location.reload();
                },
                error:function(response){
                    //console.log(response)     
                }
           });
        }
    });
});