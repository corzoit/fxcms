<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/form/manager')?>"><?=$_LANG[LANG_SYS]['field_lbl_title_form']?></a> >
            <a href="<?=FX_System::url("admin/form/edit/".$__FX_PARAMS['id']."")?>"><?php echo $form_data['title'] ?></a> >
       		<a href="<?=FX_System::url("admin/form/field/".$__FX_PARAMS['id']."")?>"><?=$_LANG[LANG_SYS]['field_lbl_title_field']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-picture"></i> <?=$_LANG[LANG_SYS]['field_lbl_subtitle_field']?>
	        </li>
	    </ol>
	</div>	
</div>
<?php if(isset($message))
{
?>
	<div id="msg-succes" class="alert alert-success" style="display:none;">
		<?php echo $message; ?>
	</div>
<?
}
?>
<div id="msg"></div>
<div class="row">
	<div class="form-group">
	    <div class="col-xs-12" align="center">
	    	<input type="hidden" name="action" value="new_page">
	    	<input type="hidden" id="form_id" name="form_id" value="<?=$__FX_PARAMS['id']?>">
	     	<button href="<?=FX_System::url("admin/form/field/".$__FX_PARAMS['id']."")?>" data = "<?=$__FX_PARAMS['id']?>" class="btn btn-primary active add-new-field"><?=$_LANG[LANG_SYS]['field_add_new_btn']?></button>
	    </div>
 	</div>
</div>
<br>
<div id="content-field" class="row">		
</div>

<style type="text/css">
a:hover{text-decoration: none}
</style>



