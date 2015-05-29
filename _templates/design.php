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
        width: 100px;
        border: 1px solid green;
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
    
	</style>
</head>
<body>
	<div class="fi-container">
		<?php include("_views/".VIEW_FILE) ;?>
	</div>
</body>
</html>