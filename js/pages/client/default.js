 /* CLIENT */
$(function(){	
    var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/,''));

    var $menuUl = $(".menu-left");
    $menuUl.find(".dropdown:eq(0)").addClass("sectionMenu");
    console.log(url.indexOf("es/section"));
    url.indexOf("es/section") >= 0 ? $( ".sectionMenu:eq( 0 )" ).addClass('active'):"";
    
    $('.dropdown li a').each(function(){                        
        if(urlRegExp.test(this.href)){
            $(this).parents(".sectionMenu").addClass('active');            
        }
    });
    
    $("img").addClass('img-responsive');
    $menuUl.find(".dropdown").click( function() {
        alert("11");
        $(this).addClass('active').siblings().removeClass('active');
    });    
});
/* END CLIENT */

