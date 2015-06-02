<!DOCTYPE>
<html>
<head>
	<title>Admin - Design</title>
	<!-- CONTEXT MENU -->
        <script type="text/javascript" src="<?=FX_System::url("js/libs/jquery/jquery-1.11.0.min.js")?>"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-contextMenu/src/jquery.ui.position.js")?>"></script>
        <script type="text/javascript" src="<?=FX_System::url("js/libs/jQuery-contextMenu/src/jquery.contextMenu.js")?>"></script>
        <script src="<?=FX_System::url("js/libs/jQuery-contextMenu/prettify/prettify.js")?>" type="text/javascript"></script>
        <script src="<?=FX_System::url("js/libs/jQuery-contextMenu/screen.js")?>" type="text/javascript"></script>
        <link href="<?=FX_System::url("js/libs/jQuery-contextMenu/src/jquery.contextMenu.css")?>" rel="stylesheet" type="text/css" />
        <link href="<?=FX_System::url("js/libs/jQuery-contextMenu/screen.css")?>" rel="stylesheet" type="text/css" />
        <link href="<?=FX_System::url("js/libs/jQuery-contextMenu/prettify/prettify.sunburst.css")?>" rel="stylesheet" type="text/css" />    
    <!-- Sweeat Alert -->
        <script src="<?=FX_System::url('js/libs/sweetalert/lib/sweetalert.min.js')?>"></script>
        <link rel="stylesheet" href="<?=FX_System::url('js/libs/sweetalert/lib/sweetalert.css')?>">        
    <!-- END Sweeat   -->
    <!-- Boostrap -->
       <script type="text/javascript" src="<?=FX_System::url("js/libs/bootstrap/js/bootstrap.js")?>"></script>
        <link rel="stylesheet" type="text/css" href="<?=FX_System::url("js/libs/bootstrap/css/bootstrap.css")?>">
    <!-- End Boostrap -->

	<!-- CONTEXT MENU -->
	<style type="text/css">
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
            /*width: 100px;*/
            /*border: 1px solid green;*/
            border: 1px solid #ddd;
            cursor: move;
        }

        .droppable-hover
        {
            border: 3px solid #cccccc;
        }

        .divH:before, .divW:before {    
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            background: #DDD;
            padding: 2px;
            
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-weight: bold;
        }

        .divW:before {
            content: "Widget.";
        }

        .divH:before{
            content: "Container";
        }

        .divW :first-child, .divH :first-child {
            margin-top: 20px;
        }

        .row{
            width: 100%!important;
            margin: 0 0 0 0;
        }        
	</style>


    <script type="text/javascript">

    $(function(){
        var is_widget = false;
        var accept_ = ".a-icon[data-type=a-container-v],.a-icon[data-type=a-container-h]";
        var $contentMain = $(".a-main-container");
        var $divs = $contentMain.find("div");
        var idsWidget;
        var $objMainContainer = $(".a-main-container");
        var $objFormDesign = $(".formDesign");
        // Util
        $.each($divs, function(i, val){     
            if($(this).hasClass("a-widget"))
            {           
                idsWidget = "#"+$(this).attr("id");                                 
                $(idsWidget).find("div").remove();
                $(idsWidget).resizable();           
            }               
        });     

        $(".a-icon").draggable({
            helper:'clone',
            revert: 'invalid'
        });

        $contentMain.droppable({
            accept: accept_,
            activeClass: 'droppable-active',
            hoverClass: 'droppable-hover',   
            drop: function(ev, ui){          
                var cloned = ui.draggable.clone();   
                var eleId = 'cont_' + Date.now();// + '_' //+ (Math.random() * 1000);
                cloned.removeClass('a-icon panel-body');
                cloned.addClass(cloned.attr('data-type'));
                cloned.html('');
                cloned.attr('id', eleId); 
                cloned.addClass("CtxMenuH");
                cloned.appendTo($(this));
              
                addWidget(cloned);
            }
        });
       
        $contentMain.find('div').mouseover(function(){        
            if($(this).attr('data-type') == "a-container-h" || $(this).attr('data-type') == "a-container-v")
            {
                addWidget($(this));
            }     
        }); 

        /* Context Menu */
            $.contextMenu({    
                selector  : ".CtxMenuW",
                className   : "divW",        
                callback  : function(key, options) {           
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
        /* End Context  */   

        /* Insert / Update */
            $("button").click(function(){                
                var design_id = $objFormDesign.find("#design_id").length == 0 ? "vacioID" : $("#design_id").val();
                var design_name = $objFormDesign.find("#design_name").length == 0 ? "vacioName" : $("#design_name").val(); 
                var action = $objFormDesign.find("#actionFormDesign").length == 0 ? "insertDesign" : $("#actionFormDesign").val(); 
                if($objMainContainer.length)
                {               
                    var $divsH = $objMainContainer.children("div");                      
                    if($divsH.length) 
                    {                    
                        swal({   
                            title: "Save Design?",   
                            text: "Write design name:",   
                            type: "input",                 
                            closeOnConfirm: false,
                            showCancelButton: true,                      
                            animation: "slide-from-top",
                            inputType: "text",
                            inputValue: design_name,                                             
                        },           
                        function(inputValue){
                            if (inputValue === false) return false;
                            if (inputValue === "") 
                            {    
                                swal.showInputError("You need to write the design name!");     
                                return false   
                            }                 
                            $.ajax({
                                method   : "POST",
                                dataType : "json",
                                data     : {
                                    "action"         : action,
                                    "design_id"      : design_id,
                                    "name"           : inputValue.toLowerCase(),
                                    "html_content"   : $objMainContainer.html()
                                },
                                success: function(response)
                                {                       
                                    if(response.success == true)
                                    {
                                        swal("Nice!", "You wrote: " + inputValue, "success");
                                        // inputValue.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); });                               
                                    }
                                    else
                                    {
                                        swal("Oops...", "Something went wrong! \n Try again with other name", "error");
                                    }                        
                                }
                            });
                            
                        });                                                  
                    }           
                }
            });
        /* End */


    });

    /* Function add new Widget */
        function addWidget(fdsfdsf)
        {                
            fdsfdsf.droppable({
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
            })   
        }       
    /* End */

    </script>

</head>
<body>
	<div class="fi-container">
		<?php include("_views/".VIEW_FILE) ;?>
	</div>
</body>
</html>