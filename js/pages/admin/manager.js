$( function(){  
    var $objInput = $(".search_contact").find("#search_contact");    
    /* CONTACT */
        $("#btn-search-contact").click(function(){
            $( "#content-search" ).empty();         
            var searchValue = $objInput.val()
            search(searchValue, 'contact', 'search_contact', '#content-search');       
        });
        $('#search_contact').keyup(function(e) {        
            var searchValue = $objInput.val()
            if(e.keyCode == 13)
            {
                $( "#content-search" ).empty();
                search(searchValue, 'contact', 'search_contact', '#content-search'); 
            }
        });
    /* END CONTACT */

    /* MESSAGE */
        $("#btn-search-message").click(function(){         
            $( "#content-search" ).empty();
            var $objInput = $(".search_message").find("#search_message");
            var searchValue = $objInput.val();         
            search('', 'contact', 'search_message', '#content-search');        
        });
        $('#search_message').keyup(function(e) {        
            var $objInput = $(".search_message").find("#search_message");
            var searchValue = $objInput.val()
            if(e.keyCode == 13)
            {
                $( "#content-search" ).empty();
                search('', 'contact', 'search_message', '#content-search');  
            }
        });    
    /* END MESSAGE */

    /* POST */
        $("#btn-search-post").click(function(){         
            $( "#content-search" ).empty();
            var $objInput = $(".search_post").find("#search_post");
            var searchValue = $objInput.val();         
            search('', 'contact', 'search_post', '#content-search');          
        });
        $('#search_post').keyup(function(e) {        
            var $objInput = $(".search_post").find("#search_post");
            var searchValue = $objInput.val()
            if(e.keyCode == 13)
            {
                $( "#content-search" ).empty();
                search('', 'contact', 'search_post', '#content-search');  
            }
        });
    /* END POST */

    search('', 'contact', 'search_contact', '#content-search');   
});