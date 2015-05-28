
<style>
    .a-main-container
    {
        border: 4px solid red;
        width: 100%;
        min-height: 100px;
    }
    .a-container-v
    {
        border: 6px solid yellow;
        background-color: pink;
        min-height: 100px;
        width: 100%;
    }    
    .a-container-h
    {        
        border: 6px solid blue;
        background-color: yellow;
        min-height: 100px;
        width: 100%;
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
        width: 100;
        border: 1px solid green;
        cursor: move;
    }

    .droppable-hover
    {
        border: 3px solid #cccccc;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript" src="<?=FX_System::url('js/libs/jQuery-contextMenu/src/jquery.contextMenu.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?=FX_System::url('js/libs/jQuery-contextMenu/src/jquery.contextMenu.css')?>">

<div class="context-menu-one box menu-1">
    <strong>right click me</strong>
</div>

<div id="test" style="width:100px; height:150px; border :1px solid red;">
    Test


</div>

<div class='a-icon' data-type='a-container-h'>
    CONTAINER HORIZONTAL
</div>
<div class='a-icon' data-type='a-container-v'>
    CONTAINER VERTICAL
</div>
<div class='a-icon' data-type='a-widget'>
    WIDGET
</div>


<div class="a-main-container">
    
</div>

<button class="btn-html">Ver HTML</button>
<div class="format-html">HTML..</div>


<script type="text/javascript">
$(function(){
    /**/

     

    /**/


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
                    var eleId = 'wid_' + Date.now();// + '_' + (Math.random() * 1000);
                    cloned.removeClass('a-icon');
                    cloned.addClass(cloned.attr('data-type'));
                    cloned.html('');
                    cloned.attr('id', eleId);
                    
                     $(this).click(function(){
                        $(this).resizable();                    
                    });  
                    

                    var html = $('<div>').append(cloned).html();            
                    $(this).append(html);

                    $widgets = $(this).find('> div');
                    var totalWidgets = $widgets.length;
                    var per = (100/totalWidgets).toFixed(2);
                    $.each($widgets, function(i, v){
                        $(this).css({
                                'width': per + '%',
                                'border-color': "#8AC007"
                            });
                    });
                    $widgets.click(function(){
                        $(this).resizable();                        
                        $.contextMenu({
                            selector: "div", 
                            callback: function(key, options) {  
                                console.log(options);
                                var m = "CLICKED:::::: " + key;
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
                    }); 

                        
                    /*$widgets.on('click', function(e){                            
                        console.log('clicked', this);
                    }); */
                    
                }
            });
        }
    });

    $(".btn-html").click(function(){
        var htmlString = $(".a-main-container").html();
        $(".format-html").text(htmlString);
    });
 
  }); 





</script>

<div id="context" data-toggle="context" data-target="#context-menu">
  ...
</div>

<div id="context-menu">
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
</div>

<!--<script src="http://sydcanem.com/bootstrap-contextmenu/bootstrap-contextmenu.js"></script>-->
<script type="text/javascript" src="<?=FX_System::url('js/libs/jQuery-contextMenu/src/bootstrap-contextmenu.js')?>"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.js"></script>-->
<script type="text/javascript">


    

      // Demo 3
      $('#context').contextmenu({
        target: '#context-menu',
        onItem: function (context, e) {
          alert($(e.target).text());
        }
      });

      /*$('#context-menu').on('show.bs.context', function (e) {
        console.log('before show event');
      });

      $('#context-menu').on('shown.bs.context', function (e) {
        console.log('after show event');
      });

      $('#context-menu').on('hide.bs.context', function (e) {
        console.log('before hide event');
      });

      $('#context-menu').on('hidden.bs.context', function (e) {
        console.log('after hide event');
      });*/
</script>

<style type="text/css">
#context{
    width: 400px;
    height: 300px;
    border: 1px solid red;
}








.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}


</style>