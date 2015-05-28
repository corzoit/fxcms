<?php
define ("FX_TEMPLATE","admin.php"); 
$fx_section = new FX_Section();
$fx_page = new FX_Page();
$fx_page_lang = new FX_PageLang();
$fx_menu = new FX_Menu();
$fx_form = new FX_Form();
$fx_form_lang = new FX_FormLang();
$fx_page = new FX_Page();
$fx_form_page = new FX_FormPage();
$obj_fxSysLang = new FX_SysLang();


if($_POST['save-form'] == "save-form")
{
	
	$all_language = $obj_fxSysLang->getAllLanguage();
	$is_update_main_form = false;
	
	foreach ($all_language as $key => $language) 
	{
		$form_id = $_POST['form_id'][$language];//Id form_id
		$creation_dt = date("Y-m-d H:i:s");
		$title  = $_POST['title'][$language];
		$intro  = $_POST['intro'][$language];
		$target_email  = $_POST['target_email'][$language];
		
		if(!$is_update_main_form)
		{
			
			$data_form = array(
				'creation_dt' => $creation_dt, 
				'title' => $title, 
				'intro' => $intro,
				'target_email' => $target_email,
				'deleted' => 0, 
			);
			
			$fx_form->update($data_form, $form_id);
			$is_update_main_form = true;
		}
		else
		{
			$get_id_form_lang = $fx_form_lang->getFormLangByFormIdAndLang($form_id, $language);
			
			//IF EXIST DATA LANGUAGE
			if(!empty($get_id_form_lang))
			{
				$data_form_lang = array(
					'fx_form_id' => $form_id,
					'lang' 		 => $get_id_form_lang['lang'],
					'title' 	 => $title, 
					'intro' 	 => $intro, 
				);
				$fx_form_lang->update($data_form_lang, $get_id_form_lang['fx_form_lang_id']);	
			}
			else
			{
				//IF NO EXIST DATA FORM LANGUAGE
				$data_form_lang = array(
					'fx_form_id' => $form_id,
					'lang' 		 => $language,
					'title' 	 => $title, 
					'intro' 	 => $intro, 
				);
				$fx_form_lang->insert($data_form_lang);		
			}
		}
	}
	//exit();
}

if($_POST['action'] == "search-page")
{
	$name = $_POST['namePage'];
	$all_data = $fx_page->getPageByName($name);
	//var_dump($all_data);
	echo(json_encode($all_data));
	exit();
}

if($_POST['action'] == "add-page")
{
	$page_id = $_POST['page_id'];
	$form_id = $_POST['form_id'];

	$exist_page = $fx_form_page->getFormPageByFormIdByPageId($form_id, $page_id);
	/*var_dump($exist_page);
	exit();*/
	if(empty($exist_page))
	{
		$data_form = $fx_form->getById($form_id);
		$data_page = $fx_page->getById($page_id);
		
		$data = array(
			'fx_form_id' => $form_id,
			'fx_page_id' => $page_id, 
			'title' => $data_form['title'],
			'intro' => $data_form['intro'],
			'target_email' => $data_form['target_email'],
		);

		$fx_form_page_id = $fx_form_page->insert($data);
		/*var_dump($data_page);
		exit();*/
		$response = array(
			'fx_form_page_id' 	=> $fx_form_page_id,
			'page_title' 		=> utf8_encode($data_page['title'])
		);
	}
	else
	{
		$response = array('error' => "Ya existe el registro ");
	}
	echo(json_encode($response));	
	exit();
}

if($_POST['action'] == "delete-page")
{
	//$data_form = $fx_form_page->getFormPageByFormIdByPageId($_POST['form_id'], $_POST['page_id']);
	$data = $fx_form_page->delete($_POST['form_page_id']);
	$response = array('response' => $data);
	//echo('DELETED DESDE SCRIPT');
	echo(json_encode($response));	
	exit();
}