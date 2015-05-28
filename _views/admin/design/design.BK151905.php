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

<div>
    <button>guardar</button>
</div>
<?php echo("<pre>"); ?>
<div id="mostrar">
</div>
<?php echo("</pre>"); ?>

<?php 
$data = $obj_page->getAll();


?>

<script type="text/javascript">
$(function(){

    $(".a-icon").draggable({
        helper:'clone',
        revert: 'invalid',
    });
    
    $(".a-main-container").droppable({
        accept: ".a-icon[data-type=a-container-v],.a-icon[data-type=a-container-h],.a-icon[data-type=a-widget]",
        activeClass: 'droppable-active',
        hoverClass: 'droppable-hover',
        drop: function(ev, ui) {                                    
            var cloned = ui.draggable.clone();
            var eleId = 'cont_' + Date.now();// + '_' //+ (Math.random() * 1000);
            cloned.removeClass('a-icon');
            cloned.addClass(cloned.attr('data-type'));
            cloned.html('');
            cloned.attr('id', eleId); 
            cloned.addClass("CtxMenuH");
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
                    cloned.addClass("CtxMenuW");

                    var html = $('<div>').append(cloned).html();            
                    $(this).append(html);

                    $widgets = $(this).find('> div');
                    var totalWidgets = $widgets.length;
                    var per = (100/totalWidgets).toFixed(2);
                    $.each($widgets, function(i, v){
                        $(this).css({ 'width': per + '%' });
                    });
                    $widgets.resizable();  
                }
            });
        }
    });      

    $.contextMenu({    
        selector  : ".CtxMenuW",
        className   : "divW",        
        callback  : function(key, options) { 
            /*console.log(key);
            console.log(options);*/
            var m = "<h3 class='widget-title'>" + options.items[key].name + "</h3>" ;
            var $objWid = options.$trigger.find("h3");            
            if(key!="quit")
            {                      
                if(key =="delete" )                        
                {
                    options.$trigger.remove();                                 
                }
                else
                {                                    
                    $objWid.length > 0 ? $objWid.remove()  : "";
                    key =="clearC" || key =="blank" ? m="" : m ;
                    options.$trigger.append(m)
                    options.$trigger.css({
                        'text-align':'center'
                    });
                }
            }
        },
        items     : {
            "blank"     : {name: "Blank", icon: "edit"},
            "header"    : {name: "Header", icon: "edit"},
            "menuL"     : {name: "Menu Left", icon: "edit"},
            "menuR"     : {name: "Menu Right", icon: "cut"},
            "menuC"     : {name: "Menu Center", icon: "copy"},
            "logo"      : {name: "Logo", icon: "copy"},
            "navbar"    : {name: "Nav Bar", icon: "copy"},
            "banner"    : {name: "Banner", icon: "copy"},
            "content"   : {name: "Content", icon: "copy"}, 
            "footer"    : {name: "Footer", icon: "edit"},
            "clearC"    : {name: "Clear Content", icon: "delete"},
            "delete"    : {name: "Delete", icon: "delete"},
            "sep1"      : "---------",
            "quit"      : {name: "Quit", icon: "quit"}
        }
        /*items: {
            "edit": {"name": "Edit", "icon": "edit"},
            "cut": {"name": "Cut", "icon": "cut"},
            "sep1": "---------",
            "quit": {"name": "Quit", "icon": "quit"},
            "sep2": "---------",
            "fold1": {
                "name": "Sub group", 
                "items": {
                    "fold1-key1": {"name": "Foo bar"},
                    "fold2": {
                        "name": "Sub group 2", 
                        "items": {
                            "fold2-key1": {"name": "alpha"},
                            "fold2-key2": {"name": "bravo"},
                            "fold2-key3": {"name": "charlie"}
                        }
                    },
                    "fold1-key3": {"name": "delta"}
                }
            },
            "fold1a": {
                "name": "Other group", 
                "items": {
                    "fold1a-key1": {"name": "echo"},
                    "fold1a-key2": {"name": "foxtrot"},
                    "fold1a-key3": {"name": "golf"}
                }
            }
        }*/
    });
    
    $.contextMenu({    
        selector    : ".CtxMenuH",
        className   : "divH",
        callback    : function(keyH, optionsH) {            
            if(keyH == "delete")
            {
                optionsH.$trigger.remove();
            }
        },
        items       : {            
            "delete"    : {name: "Delete", icon: "delete"},
            "sep1"      : "---------",
            "quit"      : {name: "Quit", icon: "quit"}
        }
    });
    
    
    $("button").click(function(){
        var jsonObj = [];
        var jsonObjW = [];
        var $objMainContainer = $(".a-main-container");
        if($objMainContainer.length)
        {   
            var $divsH = $objMainContainer.children("div");          
            if($divsH.length) 
            {
                $divsH.each(function(index, element){                    
                    var $objContainerH = $(this);
                    var $divsW = $objContainerH.children("div");
                    jsonObjW = [];
                    if($divsW.length)
                    {                        
                        $divsW.each(function(i, ele){                            
                            //var htmlString = $(this).children("div").html();
                            console.dir($(this).children("div"));
                            //console.log(htmlString);
                            //$("#mostrar").text(htmlString);
                            itemW = {
                                "widget_id"            : $(this).attr("id"),
                                "html_content"         : $(this).text()
                            }
                            jsonObjW.push(itemW);
                        }); 
                    }                   

                    response = {}
                    response['response'] = { 
                        "type"          : $(this).attr("data-type") == "a-container-h" ? "horizontal":"widget",
                        "element_type"  : $(this).prop('tagName'),
                        "id"            : $(this).attr("id"),
                        "name_class"    : $(this).attr("class"),
                        "data_type"     : $(this).attr("data-type"),
                        "children"      : jsonObjW
                    }
                    
                    jsonObj.push(response);                    
                });
            }
            $("#mostrar").html(JSON.stringify(jsonObj, undefined, 2));
        }
    });

}); 

</script>
<style type="text/css">
#mostrar{
    white-space: pre;
    color: green;
}
</style>