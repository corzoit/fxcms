 /* CLIENT */
$(function(){	
    var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/,''));

    url.indexOf("section") >= 0 ? $( ".sectionMenu:eq( 0 )" ).addClass('active'):"";
    
    $('.sectionList li a').each(function(){                        
        if(urlRegExp.test(this.href)){
            $(this).parents(".sectionMenu").addClass('active');            
        }
    });
    
    $("img").addClass('img-responsive');
    $('.sectionMenu').click( function() {        
        $(this).addClass('active').siblings().removeClass('active');
    });    
});
/* END CLIENT */