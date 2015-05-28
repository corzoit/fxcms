<?php
define ("FX_TEMPLATE","admin.php"); 
FX_System::validateAdminLogin();

$obj_order = new FX_Order();
$obj_post = new FX_Post();
$obj_contact_message = new FX_ContactMessage();
$obj_form_ans = new FX_FormAnswer();

$data_order = $obj_order->getLatestOrders();
$data_post = $obj_post->getLatestPost();
$data_contact_message = $obj_contact_message->getNewestContactMessages();

$data_form_answ = $obj_form_ans->getAll();




/*
	$ObjSection = new FX_Section();
	$data_section = $ObjSection->getSectionByOwnerld(18, true);

	echo("<pre>");
	print_r($data_section);
	echo("</pre>");
	exit();
*/

