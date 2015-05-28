<?$form_id = $__FX_PARAMS['id']?>
<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/form/manager')?>"><?=$_LANG[LANG_SYS]['edit_form_lbl_cnt_mng']?></a> >
            <a href="<?=FX_System::url("admin/form/edit/".$form_id)?>"><?=$_LANG[LANG_SYS]['edit_form_lbl_edit_form']?></a> 
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-picture"></i> <?=$_LANG[LANG_SYS]['edit_form_lbl_subtitle_edit_form']?>
	        </li>
	    </ol>
	</div>	
</div>
<div class = "tabbable tabs-left">
    <?$all_language = $obj_fxSysLang->getAllLanguage();?>
    <ul class="nav nav-tabs">
    	<?php foreach ($all_language as $key => $language): ?>
    	<?php if ($key == 0 || true): ?>
        	<li <?=($key == 0)?'class="active"':''?> ><a data-toggle="tab" href="<?='#'.$language?>"><?=$language?></a></li>	
        <?php endif ?>
        <?php endforeach ?>
    </ul>
</div> 
<form class="form-horizontal" style = "margin-top: 20px" role="form" method="POST">
	<div class="tab-content">
		<?php foreach ($all_language as $key => $language): ?>
		<?php 
		if(LANG_SYS == $language)
		{
			$dataForm = $fx_form->getById($form_id);
			/*var_dump($dataForm);
			exit(); */
		}
		else
		{
			$dataForm = $fx_form_lang->getFormLangByFormIdAndLang($form_id, $language);
			/*var_dump($dataForm);
			exit();*/
		}	
		?>
		<?php if (TRUE || LANG_SYS == $language): ?>
		<div id="<?=$language?>" <?=($key == 0)?'class="tab-pane active"':'class="tab-pane"' ?> >
			<input class="form-control" type="hidden" name = "form_id[<?=$language?>]" value = "<?=$form_id?>">	
			<div class="form-group">
				<label class="col-sm-1 control-label"><p class = "text-left"><?=$_LANG[LANG_SYS]['edit_form_lbl_title']?>(*):</p></label>
				<div class="col-sm-10">
					<input class="form-control" type="text" placeholder="Title" name = "title[<?=$language?>]" value = "<?=$dataForm['title']?>" required>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-1 control-label"><p class = "text-left"><?=$_LANG[LANG_SYS]['edit_form_lbl_intro']?></p></label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="3" name = "intro[<?=$language?>]"><?=$dataForm['intro']?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-1 control-label"><p class = "text-left"><?=$_LANG[LANG_SYS]['edit_form_lbl_email']?>(*)</p></label>
				<div class="col-sm-10">
					<input class="form-control" type = "text" placeholder="Email" name = "target_email[<?=$language?>]" value = "<?=$dataForm['target_email']?>">
				</div>
			</div>
		</div>
		<?php endif ?>	
		<?php endforeach ?>
	</div>
	<div class="form-group form-group-lg" style = "margin-top: 30px">
		<label class="col-sm-1 control-label" for="formGroupInputLarge"></label>
		<div class="col-sm-10">
			<button type = "submit" class="btn btn-primary" name = "save-form" value = "save-form"><?=$_LANG[LANG_SYS]['edit_form_btn_save']?></button>
			<a class="btn btn-success" href="<?=FX_System::url("admin/form/field/$form_id")?>"><?=$_LANG[LANG_SYS]['edit_form_btn_view_form']?></a>
		</div>
	</div>
</form>

<hr> 

<form class="form-horizontal">
	<div class="form-group form-group-lg">	
		<label class="col-sm-12 control-label">
			<p class="text-left"><?=$_LANG[LANG_SYS]['edit_form_lbl_add_form_to_page']?></p>
		</label>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label" for="formGroupInputLarge"><p class = "text-left"><?=$_LANG[LANG_SYS]['edit_form_lbl_cont_page']?>(*):</p></label>
		<div class="col-sm-4">
			<input class="form-control" type="text" id= "search-page">
		</div>
		<div class="col-sm-1">
			<button type = "button" class="btn btn-primary add-page" form-id = "<?=$__FX_PARAMS['id']?>"><?=$_LANG[LANG_SYS]['edit_form_btn_add_page']?></button>
		</div>
	</div>
</form>


<input id="page_id" type="hidden" value = "">
<?$all_page_use_form = $fx_form_page->getAllPageByFormId($form_id)?>
<?php if (!empty($all_page_use_form)): ?>
<div class = "col-xs-6" style = "padding-left: 0px !important; padding-top:17px !important">
	<table class="table table-bordred table-striped .col-xs-6 table table-bordered" id="form_table" form = "<?=$form_id?>">
	   <thead>
			<th style = "text-align: left"><?=$_LANG[LANG_SYS]['edit_form_lbl_header_page']?></th>
			<th style = "text-align: right"><?=$_LANG[LANG_SYS]['edit_form_lbl_header_delete']?></th>
		</thead>
	    <tbody class = "body-title-page">
	    <?//var_dump($all_page_use_form)?>
			<?php foreach ($all_page_use_form as $key => $value): ?>
			<tr>
				<td><?=$value['title']?></td>
				<td><button data = "<?=$value['fx_form_page_id']?>" data-target="#delete" data-toggle="modal" data-title="Delete" class="btn btn-danger btn-xs pull-right delete-title"><span class="glyphicon glyphicon-trash"></span></button></td>
			</tr>
			<?php endforeach ?>
	    </tbody>
	</table>
</div>
<?php endif ?>
<style type="text/css">
a:hover{
text-decoration: none;
}
</style>