
<style>
    .a-main-container
    {
        border: 4px solid red;
        width: 100%;
        min-height: 100px;
    }
    .a-container-v
    {
        border: 2px solid blue;
        background-color: pink;
        min-height: 100px;
        width: 100%;
    }    
    .a-container-h
    {        
        border: 2px solid blue;
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
                    var eleId = 'wid_' + Date.now() + '_' + (Math.random() * 1000);
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
                        $(this).css('width', per + '%');
                    });
                }
            });
        }
    });
 
  });    

</script>