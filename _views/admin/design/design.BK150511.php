
<div class='a-icon' data-type='a-container-h'>
    CONTAINER HORIZONTAL
</div>
<div class='a-icon' data-type='a-container-v'>
    CONTAINER VERTICAL
</div>
<div class='a-icon' data-type='a-widget'>
    WIDGET
</div>


<div class="a-main-container" ></div>




<div class="context-menu-one">
    <strong>right click me</strong>
</div>


<script type="text/javascript">


$(function(){
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
    });
    
    $('.context-menu-one').on('click', function(e){
        console.log('clicked', this);
    })
});
    


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
            var eleId = 'cont_' + Date.now();// + '_' //+ (Math.random() * 1000);
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
    
    
    /*$.contextMenu({
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
    });
    
    $('.context-menu-one').on('click', function(e){
        console.log('clicked', this);
    });*/


    $(".a-main-container").bind("click", function(event){        
        var id__ = "."+ $(event.target).attr('id'); 
        console.log(id__);
        //$(id__).contextMenu();

        $.contextMenu({
             // define which elements trigger this menu
            selector: id__,
            // define the elements of the menu
            items: {
                foo: {name: "Foo", callback: function(key, opt){ alert("Foo!"); }},
                bar: {name: "Bar", callback: function(key, opt){ alert("Bar!") }}
            }
            // there's more, have a look at the demos and docs...
        });


        /*$.contextMenu({
            selector: ".a-main-container", 
            callback: function(key, options) {                
                var m = "clicked: " + key;
                console.log(m);
                //window.console && console.log(m) || alert(m); 
                //$(id__).html("<h5>"+key+"</h5>");     
            },
            items: {
                "menu": {name: "menu", icon: "menu"},
                "content": {name: "Content", icon: "Content"}
               /* "copy": {name: "Copy", icon: "copy"},
                "paste": {name: "Paste", icon: "paste"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Quit", icon: "quit"}*/
           /* }
        });
        //$(id__).resizable();
        /*$.contextMenu({
            selector: id__, 
            callback: function(key, options) {                
                var m = "clicked: " + key;
                //window.console && console.log(m) || alert(m); 
                //$(id__).html("<h5>"+key+"</h5>");     
            },
            items: {
                "menu": {name: "menu", icon: "menu"},
                "content": {name: "Content", icon: "Content"}
               /* "copy": {name: "Copy", icon: "copy"},
                "paste": {name: "Paste", icon: "paste"},
                "delete": {name: "Delete", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Quit", icon: "quit"}
            }
        });*/
    });    
  }); 
</script>


