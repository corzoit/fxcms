 /* CLIENT */
$(function(){	
    var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/,''));

    var cont = 0;
    var $menuUl = $(".menu-left");
            
    
    /*url.indexOf("page") >= 0 ? $menuUl.find( "li:eq( 0 )" ).removeClass('active'): "";
    console.log(url.indexOf("section"));*/

    $menuUl.find("li a").each(function(){         

        if(cont==0)
        {
            if(urlRegExp.test(this.href)){
                $(this).parents("li").addClass('active');                  
                cont+=1;              
            }    
        }       
    });    

    url.indexOf("section") >= 0 && cont == 0? $menuUl.find( "li:eq( 0 )" ).addClass('active'): "";

    $("img").addClass('img-responsive');
    $menuUl.find(".dropdown").click( function() {        
        $(this).addClass('active').siblings().removeClass('active');
    });
});
/* END CLIENT */

