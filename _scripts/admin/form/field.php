<?php
define ("FX_TEMPLATE","admin.php"); 
$fx_syslang = new FX_SysLang();
$fx_form = new FX_Form();
$fx_form_field = new FX_FormField();
$fx_form_field_lang = new FX_FormFieldLang();	

if(isset($__FX_PARAMS['id']) and is_numeric($__FX_PARAMS['id']))
{
	$form_data = $fx_form->getById($__FX_PARAMS['id']);

	$filter = array('fx_form_id' => $__FX_PARAMS['id']);
	$field_data = $fx_form_field->getByFilter($filter, "", false);
}
else
{
	FX_System::redirect(FX_System::url("admin/form/edit"), true); 
}


if($_POST['action'] == 'view_field')
{
	$fx_form_field = new FX_FormField();
	$num_page = '';
	if(isset($_POST['num_pag']) and $_POST['num_pag'] != '')
	{
		$num_page = $_POST['num_pag'];
	}
	$data = '';
	if(isset($_POST['data']) and is_numeric($_POST['data']))
	{
		$data = $_POST['data'];
	}
	$records = 5;
	$search_field = $_POST['search'];
	$field_count = $fx_form_field->getFieldCount($search_field);
	$field_count = $field_count['count'];
	$__response = array();
	$pagination = FX_System::getPageNumbering($field_count, $num_page, $data, $records); 
	$limit = $pagination['limit'];
	$__response = $fx_form_field->getFieldAllbyForm($search_field, $limit);
	$response ='';
	?>
		<div class="col-sm-12">
			<div class="panel panel-primary" id='exist_content'>
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class=" glyphicon glyphicon-book"></i>
						<?=$_LANG[LANG_SYS]['field_tbl_lbl_title']?>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<?php 
							if($__response)
							{
							?>	
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['field_tbl_lbl_col1']?></th>
									<th><?=$_LANG[LANG_SYS]['field_tbl_lbl_col2']?></th>
									<th><?=$_LANG[LANG_SYS]['field_tbl_lbl_col3']?></th>
									<th><?=$_LANG[LANG_SYS]['field_tbl_lbl_col4']?></th>
									<th><?=$_LANG[LANG_SYS]['field_tbl_lbl_col5']?></th>
									<th></th>
								</tr>
							</thead>
							<tbody class="tBody">
								<?php
									foreach($__response as $key_response => $value_response)
									{
									?>
										<?php $delete_field_id = 'fxdeletefield_'.$value_response['fx_form_field_id']; ?>
										<tr id="<?=$delete_field_id?>" class="view_record">
											<td><?=$value_response['title']?></td>
											<td><?=$value_response['note']?></td>
											<td><?=$value_response['field_behaviour']?></td>
											<td><?=$value_response['field_type']?></td>
											<?php $a =$value_response['options']; ?>
											<!--<td><?=preg_replace("[\s+]", "<br>", $value_response['options'])?></td>-->
											<td><?=preg_replace("[\n+]", "<br>", $value_response['options'])?></td>
											<td align="center">
									        	<button onclick="edit_field(<?=$value_response['fx_form_field_id']?>)" href="<?=FX_System::url("admin/form/field/".$__FX_PARAMS['id']."")?>" data = "<?=$value_response['fx_form_field_id']?>" class="btn btn-default active edit-field"><?=$_LANG[LANG_SYS]['field_tbl_btn_edit']?></button>
												<a href="javascript:void(0)" onclick="deleteRecord('<?php echo($delete_field_id)?>', '', 'delete_field', '<?=$_LANG[LANG_SYS]['field_tbl_msg_del_field']?>', '<?=$search_field?>', 'view_field', '#content-field', '#msg-succes')" class="btn btn-danger"><?=$_LANG[LANG_SYS]['field_tbl_btn_delete']?></a>
											
											</td>
										</tr>
									<?php
									}
									?>
									<?
									if(isset($pagination['numbering']) and $pagination['numbering'])
									{
									?>
										<tr align="center"> <td colspan='6'> <?=$pagination['numbering']?></td></tr>
									<?
									}							
								?>
							</tbody>
							<?php 
							}
							else
							{
							?>
								<div class="col-sm-12">
									<div class="alert alert-danger" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
										<?=$_LANG[LANG_SYS]['field_msg_error']?>
									</div>
								</div>
							<?
							}
							?>
						</table>
					</div>				
				</div>
			</div>
		</div>
<?
	exit();   
}

if($_POST['action'] == "add-field")
{
	$all_language = $fx_syslang->getAllLanguage();
?>
	<div class="row">
		<div class="col-sm-12" id="errors">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class = "tabbable tabs-left">
			    <ul class="nav nav-tabs">
			    	<?php foreach ($all_language as $key => $language): ?>
			        	<li <?=(LANG_SYS == $language)?'class="active"':''?> ><a data-toggle="tab" href="<?='#'.$language?>"><?=strtoupper($language)?></a></li>	
			        <?php endforeach ?>
			    </ul>
			</div>
			<form method="POST" enctype="multipart/form-data" class = "form" id="send">
				<div class="tab-content">
					<?php
					foreach ($all_language as $key => $language)
					{
					?>
						<div id="<?=$language?>" <?=(LANG_SYS == $language)?'class="tab-pane active"':'class="tab-pane fade"' ?> >
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title" style="margin-left:8px"><?=$_LANG[LANG_SYS]['field_add_title']?></h3>
								</div>
								<div class="panel-body">
									<div class="form-horizontal">
									    <div class="form-group">
									        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_add_lbl_title']?>(*):</label>
									        <div class="col-xs-9">
									            <input type="text" name="<?=$language?>[title]" class="form-control">
									        </div>
									    </div>
									    <?php
									    if(LANG_SYS == $language)
									    {
									    ?>
									    <div class="form-group">
									        <div class="col-xs-offset-2 col-xs-10">
									            <label class="checkbox-inline">
									                <input type="checkbox" name="<?=$language?>[compulsory]"><?=$_LANG[LANG_SYS]['field_add_lbl_computsory']?>
									            </label>
									        </div>
									    </div>
									    <?php
									    }
									    ?>
										    <div class="form-group">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_add_lbl_note']?>:</label>
										        <div class="col-xs-9">
										            <input type="text" name="<?=$language?>[note]" class="form-control">
										        </div>
										    </div>
										    <?php 
										    if(LANG_SYS == $language)
									    	{
										    ?>
										    <div class="form-group">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_add_lbl_behaviour']?>:</label>
										        <div class="col-xs-9">
										        	<select class="selectpicker form-control" id="select_behaviour" name="<?=$language?>[field_behaviour]">
										        		<option value = "none">none</option>
										        		<option value = "first_name">first_name</option>
										        		<option value = "last_name">last_name</option>
										        		<option value = "email">email</option>
										        		<option value = "dob">dob</option>
										        		<option value = "business">business</option>
										        		<option value = "phone">phone</option>
										        		<option value = "mobile">mobile</option>
										        		<option value = "address">address</option>
										        		<option value = "suburb">suburb</option>
										        		<option value = "postcode">postcode</option>
										        		<option value = "country">country</option>
													</select>
										        </div>
										    </div>
										    <div class="form-group" id="select_field_type">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_add_lbl_field_type']?>:</label>
										        <div class="col-xs-9">
										        	<select class="selectpicker form-control" id="field_type" name="<?=$language?>[field_type]">
										        		<option value = "text">text</option>
										        		<option value = "long-text">long-text</option>
										        		<option value = "radio">radio</option>
										        		<option value = "combo">combo</option>
										        		<option value = "checkbox">checkbox</option>
										        		<option value = "unique-code">unique-code</option>
										        		<option value = "reusable-code">reusable-code</option>
													</select>
										        </div>
										    </div>
										    <div class="form-group" id="options">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_add_lbl_options']?>:</label>
										        <div class="col-xs-9">
										            <textarea rows="5" class="form-control" name="<?=$language?>[options]"></textarea>
										        </div>
										    </div>
										    <?php 
										    }
										    ?>
									</div>
								</div>
							</div>

							<div class="form-group" align="center">
							    <div class="col-xs-12">
							    	<?php 
							    	if(LANG_SYS == $language)
							    	{
							    	?>
								    	<input type="hidden" name="<?=$language?>[form_id]" value="<?=$__FX_PARAMS['id']?>">
								    <?php 
							    	}
							    	?>
								    <input type="hidden" name="action" value="add_field">
							    	<button type="button" class="btn btn-primary" onclick="field_required()"><?=$_LANG[LANG_SYS]['field_add_lbl_btn_save']?></button>
							    	<button onclick="closeFancy()" style="margin-left:30px;" type="button" class="btn btn-danger"><?=$_LANG[LANG_SYS]['field_add_lbl_btn_close']?></button>
							    </div>
							</div>
						</div>
					<?php 
					}
					?>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
	$("#select_behaviour").change(function(){
		var value = $("select#select_behaviour option:selected").text();
		if(value != 'none')
		{
			$("#select_field_type").css("display", "none");
			$("#options").css("display", "none");
		}
		else
		{
			$("#select_field_type").css("display", "block");
			$("#options").css("display", "block");	
		}
	});
	</script>
<?
exit();
}

if($_POST['action'] == "field_required")
{
	$language_data = array();
	foreach ($_POST['field'] as $key => $value)
	{
		$lang_and_field = $_POST['field'][$key]['name'];
		$lang_and_field_val = $_POST['field'][$key]['value'];	
		$position = strpos($lang_and_field, '[');
		$field =substr($lang_and_field, $position+1, -1);
		if($field == 'title')
		{
			if(strlen(trim($lang_and_field_val)) == '')
			{
				array_push($language_data, substr($lang_and_field, 0, $position));
			}
		}
	}
?>
	<div class="alert alert-danger">
			<?php
			if(count($language_data))
			{
				foreach ($language_data as $key => $value)
				{
				?>
					<?=$_LANG[LANG_SYS]['field_add_msg_error_required']?><?= strtoupper($value)?><br>
				<? 
				}
			}
			else
			{
			?>
				<script type="text/javascript">
					$("#errors").remove();
					$('form#send').submit();
				</script>
			<?
			}
			?>
	</div>
<?
exit();
}

if($_POST['action'] =='add_field')
{
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	echo($_POST['en']['options']);
	echo "<br>";
	echo preg_replace("[\n+]", "<br>", $_POST['en']['options']);
	exit();*/
	$d[LANG_SYS] = $_POST[LANG_SYS];
	$_POST = $d + $_POST; 
	unset($_POST['action']);

	foreach ($_POST as $key => $value)
	{	
		$title = trim($_POST[$key]['title']);
		$note = trim($_POST[$key]['note']);
		if(LANG_SYS == $key)
    	{
    		$form_id = trim($_POST[$key]['form_id']);
    		$compulsory = trim($_POST[$key]['compulsory']) == 'on' ? 1 : 0;

			$field_behaviour = trim($_POST[$key]['field_behaviour']);
			$field_type = '';
			$options = '';
			if($field_behaviour == 'none')
			{	
				$field_type = trim($_POST[$key]['field_type']);
		   		$options = trim($_POST[$key]['options']);
			}	
	    	$data_field = array('fx_form_id' => $form_id,
		    				    'title' => FX_System::saveStrDb($title),
		    				    'note' => FX_System::saveStrDb($note),
		    				    'field_behaviour' => FX_System::saveStrDb($field_behaviour),
		    				    'field_type' => FX_System::saveStrDb($field_type),
		    				    'options' => FX_System::saveStrDb($options),
		    				    'compulsory' => $compulsory,
		    				    'position' => ''
	    				 	   );
	    	$new_id = $fx_form_field->insert($data_field);
    	}
    	else
    	{
    		$data_form_field_lang = array('fx_form_field_id' => $new_id,
			    				    'lang' => FX_System::saveStrDb($key),
			    				    'title' => FX_System::saveStrDb($title),
			    				    'note' => FX_System::saveStrDb($note)
	    				 		   );
	    	$fx_form_field_lang->insert($data_form_field_lang);
    	}
	}
	$message = $_LANG[LANG_SYS]['field_add_msg_success'];
	$filter = array('fx_form_id' => $__FX_PARAMS['id']);
	$field_data = $fx_form_field->getByFilter($filter, "", false);
	unset($_POST);	
}

if($_POST['action'] == "edit-field")
{
	$all_language = $fx_syslang->getAllLanguage();
	$data_form_field = $fx_form_field->getById($_POST['form_field_id']); 
?>
	<div class="row">
		<div class="col-sm-12" id="errors">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">	
			<div class = "tabbable tabs-left">
			    <ul class="nav nav-tabs">
			    	<?php foreach ($all_language as $key => $language): ?>
			        	<li <?=(LANG_SYS == $language)?'class="active"':''?> ><a data-toggle="tab" href="<?='#'.$language?>"><?=strtoupper($language)?></a></li>	
			        <?php endforeach ?>
			    </ul>
			</div>
			<form method="POST" enctype="multipart/form-data" class = "form" id="send">
				<div class="tab-content">
					<?php
					foreach ($all_language as $key => $language)
					{
						if(LANG_SYS == $language)
						{
							$data_field = $data_form_field;
						}
						else
						{
							$filter = array('fx_form_field_id' => $_POST['form_field_id'], 'lang' => $language);
							$data_field = $fx_form_field_lang->getByFilter($filter, '', 1);
						}		
					?>
						<div id="<?=$language?>" <?=(LANG_SYS == $language)?'class="tab-pane active"':'class="tab-pane fade"' ?> >
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title" style="margin-left:8px"><?=$_LANG[LANG_SYS]['field_edit_title']?></h3>
								</div>
								<div class="panel-body">
									<div class="form-horizontal">
									    <div class="form-group">
									        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_edit_lbl_title']?>(*):</label>
									        <div class="col-xs-9">
									            <input type="text" name="<?=$language?>[title]" value="<?=$data_field['title']?>" class="form-control">
									        </div>
									    </div>
									    <?php
									    if(LANG_SYS == $language)
									    {
									    ?>
									    <div class="form-group">
									        <div class="col-xs-offset-2 col-xs-9">
									            <label class="checkbox-inline">
									            	<?php $chk = $data_field['compulsory'] ? "checked='checked'" : ''; ?>
									                <input type="checkbox" <?=$chk?> name="<?=$language?>[compulsory]"><?=$_LANG[LANG_SYS]['field_edit_lbl_computsory']?>
									            </label>
									        </div>
									    </div>
									    <?php
									    }
									    ?>
										    <div class="form-group">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_edit_lbl_note']?>:</label>
										        <div class="col-xs-9">
										            <input type="text" name="<?=$language?>[note]" value="<?=$data_field['note']?>" class="form-control">
										        </div>
										    </div>
										    <?php 
										    if(LANG_SYS == $language)
									    	{
										    ?>
										    <div class="form-group">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_edit_lbl_behaviour']?>:</label>
										        <div class="col-xs-9">
										        	<select class="selectpicker form-control" id="select_behaviour" name="<?=$language?>[field_behaviour]">
										        		<option value = "none">none</option>
										        		<option value = "first_name">first_name</option>
										        		<option value = "last_name">last_name</option>
										        		<option value = "email">email</option>
										        		<option value = "dob">dob</option>
										        		<option value = "business">business</option>
										        		<option value = "phone">phone</option>
										        		<option value = "mobile">mobile</option>
										        		<option value = "address">address</option>
										        		<option value = "suburb">suburb</option>
										        		<option value = "postcode">postcode</option>
										        		<option value = "country">country</option>
													</select>
										        </div>
										    </div>
										    <div class="form-group" id="select_field_type">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_edit_lbl_field_type']?>:</label>
										        <div class="col-xs-9">
										        	<select class="selectpicker form-control" id="field_type" name="<?=$language?>[field_type]">
										        		<option value = "text">text</option>
										        		<option value = "long-text">long-text</option>
										        		<option value = "radio">radio</option>
										        		<option value = "combo">combo</option>
										        		<option value = "checkbox">checkbox</option>
										        		<option value = "unique-code">unique-code</option>
										        		<option value = "reusable-code">reusable-code</option>
													</select>
										        </div>
										    </div>
										    <div class="form-group" id="options">
										        <label class="control-label col-xs-2"><?=$_LANG[LANG_SYS]['field_edit_lbl_options']?>:</label>
										        <div class="col-xs-9">
										            <!-- <textarea rows="5" class="form-control" name="<?=$language?>[options]"><?=preg_replace("[\s+]", "\n", $data_field['options'])?></textarea> -->
										            <textarea rows="5" class="form-control" name="<?=$language?>[options]"><?=preg_replace("[\n+]", "\n", $data_field['options'])?></textarea>
										        </div>
										    </div>
										    <?php 
										    }
										    ?>
									</div>
								</div>
							</div>

							<div class="form-group" align="center">
							    <div class="col-xs-12">
							    	<?php 
							    	if(LANG_SYS == $language)
							    	{
							    	?>
								    	<input type="hidden" name="<?=$language?>[form_id]" value="<?=$__FX_PARAMS['id']?>">
								    	<input type="hidden" name="<?=$language?>[form_field_id]" value="<?=$data_field['fx_form_field_id']?>">
								    <?php 
							    	}
							    	else
							    	{
							    	?>
							    		<input type="hidden" name="<?=$language?>[fx_form_field_lang_id]" value="<?=$data_field['fx_form_field_lang_id']?>">
							    		<input type="hidden" name="<?=$language?>[form_field_id]" value="<?=$data_field['fx_form_field_id']?>">
							    	<?
							    	}
							    	?>
								    <input type="hidden" name="action" value="edit_field">
							    	<button type="button" class="btn btn-primary" onclick="field_required()"><?=$_LANG[LANG_SYS]['field_edit_lbl_btn_save']?></button>
							    	<button onclick="closeFancy()" style="margin-left:30px;" type="button" class="btn btn-danger"><?=$_LANG[LANG_SYS]['field_edit_lbl_btn_close']?></button>
							    </div>
							</div>
						</div>
					<?php 
					}
					?>
				</div>
			</form>
		</div>
	</div>	
	<script type="text/javascript">
	<?
	if($data_form_field['field_behaviour'])
	{
	?>
		$('#select_behaviour option[value="<?=$data_form_field["field_behaviour"]?>"]').attr("selected", "selected");
		<?
		if($data_form_field['field_behaviour'] != 'none')
		{
		?>
			$("#select_field_type").css("display", "none");
			$("#options").css("display", "none");
		<?
		}
	}
	if($data_form_field['field_type'])
	{
	?>
		$('#field_type option[value="<?=$data_form_field["field_type"]?>"]').attr("selected", "selected");
	<?
	}
	?>
	$("#select_behaviour").change(function(){
		var value = $("select#select_behaviour option:selected").text();
		if(value != 'none')
		{
			$("#select_field_type").css("display", "none");
			$("#options").css("display", "none");
		}
		else
		{
			$("#select_field_type").css("display", "block");
			$("#options").css("display", "block");	
			
		}
	});
	</script>
<?
exit();
}

if($_POST['action'] =='edit_field')
{
	$d[LANG_SYS] = $_POST[LANG_SYS];
	$_POST = $d + $_POST; 
	unset($_POST['action']);
	foreach ($_POST as $key => $value)
	{	
		$title = trim($_POST[$key]['title']);
		$note = trim($_POST[$key]['note']);
		if(LANG_SYS == $key)
    	{
    		$form_id = trim($_POST[$key]['form_id']);
    		$form_field_id = trim($_POST[$key]['form_field_id']);
    		$compulsory = trim($_POST[$key]['compulsory']) == 'on' ? 1 : 0;

			$field_behaviour = trim($_POST[$key]['field_behaviour']);
			$field_type = '';
			$options = '';
			if($field_behaviour == 'none')
			{	
				$field_type = trim($_POST[$key]['field_type']);
		   		$options = trim($_POST[$key]['options']);
			}	
	    	$data_field = array(
		    				    'title' => FX_System::saveStrDb($title),
		    				    'note' => FX_System::saveStrDb($note),
		    				    'field_behaviour' => FX_System::saveStrDb($field_behaviour),
		    				    'field_type' => FX_System::saveStrDb($field_type),
		    				    'options' => FX_System::saveStrDb($options),
		    				    'compulsory' => $compulsory,
		    				    'position' => ''
	    				 	   );
	    	$filter = array('fx_form_field_id' => $_POST[$key]['form_field_id'], 'fx_form_id' => $__FX_PARAMS['id']);
	    	$fx_form_field->updateByFilfer($data_field, $filter);
    	}
    	else
    	{
    		if($_POST[$key]['page_lang_id'] == '')
    		{
    			$data_field_lang = array('fx_form_field_id' => $_POST[$key]['form_field_id'],
				    					'lang' => FX_System::saveStrDb($key),
	    							    'title' => FX_System::saveStrDb($title),
				    				    'note' => FX_System::saveStrDb($note)
		    				 		   );
				$fx_form_field_lang->insert($data_field_lang);
    		}
    		else
    		{
    			$data_form_field_lang = array('title' => FX_System::saveStrDb($title), 'note' => FX_System::saveStrDb($note));

	    		$filter = array('fx_form_field_lang_id' => $_POST[$key]['fx_form_field_lang_id'], 'fx_form_field_id' => $_POST[$key]['form_field_id']);
		    	$fx_form_field_lang->updateByFilfer($data_form_field_lang, $filter);
    		}		
    	}
	}
	$message = $_LANG[LANG_SYS]['field_edit_msg_success'];
	$filter = array('fx_form_id' => $__FX_PARAMS['id']);
	$field_data = $fx_form_field->getByFilter($filter, "", false);
	unset($_POST);	
}

if($_POST['action'] == "delete_field")
	{
		if(is_numeric($_POST['id']))
		{		
			$fx_form_field->delete($_POST['id']);
			$filter = array('fx_form_field_id' => $_POST['id']);
			$fx_form_field_lang->deleteByFilfer($filter);
			echo $_LANG[LANG_SYS]['field_tbl_msg_success_del_field'];
		}
		exit();
	}
?>
