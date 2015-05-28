<?php 
define ("FX_TEMPLATE","theme.php");

$language = !empty($__FX_PARAMS['language'])? $__FX_PARAMS['language']:"es";
echo("<p>LANG ::: $language</p>");
if($language == "es")
{
	$obj_page = new FX_Page();
	$content_page = $obj_page->getById($__FX_PARAMS['page_id'], false, date("Y-m-d H:i:s"));	

}
elseif($language == "en")
{
	$obj_page_lang = new FX_PageLang();
	$content_page = $obj_page_lang->getPageLangByPageId($__FX_PARAMS['page_id']);	
}
echo("<pre>");
print_r($content_page)	;
echo("</pre>");
echo("<pre>");
print_r($_SESSION);
echo("</pre>");