
<style>
    .a-main-container
    {
        border: 1px solid red;
        width: 100%;
        min-height: 100px;                  
    }
    .a-container-v
    {
        border: 1px solid yellow;
        background-color: pink;
        min-height: 100px;
        width: 100%;
    }    
    .a-container-h
    {        
        border: 1px solid blue;
        background-color: yellow;
        min-height: 100px;
        width: 100%;
        overflow: hidden;
    }
    .a-container-h > div
    {
        float: left;
    }
    .a-widget
    {
        border: 1px solid #000000;
        background-color: #f0f0f0;
        min-height: 100px;
    }

    .a-icon
    {
        width: 100px;
        border: 1px solid green;
        cursor: move;
    }

    .droppable-hover
    {
        border: 3px solid #cccccc;
    }
</style>


<!-- CONTEXT MENU -->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?=FX_System::url('js/libs/jQuery-contextMenu/src/jquery.contextMenu.js')?>"></script>
<!-- CONTEXT MENU -->



<div class='a-icon' data-type='a-container-h'>
    CONTAINER HORIZONTAL
</div>
<div class='a-icon' data-type='a-container-v'>
    CONTAINER VERTICAL
</div>
<div class='a-icon' data-type='a-widget'>
    WIDGET
</div>


<div class="a-main-container" id="context_"></div>

<!--<div id="context-menu">
  <ul class="dropdown-menu" role="menu">
    <li>
        <a tabindex="-1" href="#">Action</a>        
    </li>    
    <li><a tabindex="-1" href="#">Separated link</a></li>
     <li class="dropdown-submenu">
        <a href="#">Even More..</a>
        <ul class="dropdown-menu">
            <li><a href="#">3rd A level</a></li>
            <li><a href="#">3rd B level</a></li>
        </ul>
      </li>
  </ul>
</div>-->

<!--<button class="btn-html">Ver HTML</button>
<div class="format-html">HTML..</div>-->


<script type="text/javascript">
$(function(){
    $(".a-icon").draggable({
        helper:'clone',
        revert: 'invalid',
    }); 
       
    $(".a-main-container").droppable({
        accept: ".a-icon[data-type=a-container-v],.a-icon[data-type=a-container-h]",
        activeClass: 'droppable-active',
        hoverClass: 'droppable-hover',
        drop: function(ev, ui) {            
            var cloned = ui.draggable.clone();
            var eleId = 'cont_' + Date.now() + '_' + (Math.random() * 1000);
            cloned.removeClass('a-icon');
            cloned.addClass(cloned.attr('data-type'));
            cloned.html('');
            cloned.attr('id', eleId);            
            cloned.appendTo($(this)).droppable({
                accept: ".a-icon[data-type=a-widget]",
                activeClass: 'droppable-active',
                hoverClass: 'droppable-hover',
                greedy: true, 
                drop: function(ev2, ui2) {
                    
                    var cloned = ui2.draggable.clone();
                    var eleId = 'wid_' + Date.now()// + '_' + (Math.random() * 1000);
                    cloned.removeClass('a-icon');
                    cloned.addClass(cloned.attr('data-type'));
                    cloned.html('');
                    cloned.attr('id', eleId);                                

                    var html = $('<div>').append(cloned).html();            
                    $(this).append(html);

                    $widgets = $(this).find('> div');
                    var totalWidgets = $widgets.length;
                    var per = (100/totalWidgets).toFixed(2);
                    $.each($widgets, function(i, v){
                        $(this).css({ 'width': per + '%' });
                    });                                                        
                }
            });                    
        }
    });
    

    $("#context_").bind("click", function(event){        
        var id__ = "#"+ $(event.target).attr('id');  
        console.log(id__);
        $(id__).resizable();
        $.contextMenu({
            selector: id__, 

            callback: function(key, options) {                
                var m = "clicked: " + key;
                window.console && console.log(m) || alert(m); 
                $(id__).html("<h5>"+key+"</h5>");     
            },
            items: {
                "menu": {name: "menu", icon: "menu"},
                "content": {name: "Content", icon: "Content"}
               /* "copy": {name: "Copy", icon: "copy"},
                "paste": {name: "Paste", icon: "paste"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Quit", icon: "quit"}*/
            }
        });                    
    });
    /*
    $widgets.click(function(){
                        $(this).resizable();
                        /*$(this).contextmenu({
                            target: (this).attr("id"),
                            onItem: function (context, e) {
                                $(this).html("11");
                                alert($(e.target).text());
                            }                        
                        });                      
                    });




    $.contextMenu({
        selector: '.context-menu-one', 
        callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m); 
        },
        items: {
            "edit": {name: "Edit", icon: "edit"},
            "cut": {name: "Cut", icon: "cut"},
            "copy": {name: "Copy", icon: "copy"},
            "paste": {name: "Paste", icon: "paste"},
            "delete": {name: "Delete", icon: "delete"},
            "sep1": "---------",
            "quit": {name: "Quit", icon: "quit"}
        }
    });*/
    

    /*$(".btn-html").click(function(){
        var htmlString = $(".a-main-container").html();
        $(".format-html").text(htmlString);
    });*/
 
  }); 
</script>


