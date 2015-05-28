<?php 
define ("FX_TEMPLATE","theme.php");

$resp = null;
$error = null;
$firstname_ok = TRUE;
$lastname_ok = TRUE;
$email_ok = TRUE;    
$phone_ok = TRUE;
$mobile_ok = TRUE;
$subject_ok = TRUE;
$message_ok = TRUE;
$error_message = "";

if($_POST['action'] == 'comment')
{
	$obj_contact = new FX_Contact();
	//$obj_contact->insert();	

	if(strlen(trim($_POST['first_name']))==0)
	{
		$firstname_ok = FALSE; 	
		
	}

	if(strlen(trim($_POST['last_name'])) == 0)
	{
		$lastname_ok = FALSE; 			
	}

    if (strlen(trim($_POST['email'])) == 0 || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email']))
    {
        $email_ok = FALSE; 
    }

    /*if(strlen(trim($_POST['phone'])) == 0)
	{
		$phone_ok = FALSE; 	
	}

	if(strlen(trim($_POST['mobile'])) == 0)
	{
		$mobile_ok = FALSE; 
	}*/

	if(strlen(trim($_POST['subject'])) == 0)
	{
		$subject_ok = FALSE; 	
	}

	if(strlen(trim($_POST['message'])) == 0)
	{
		$message_ok = FALSE; 			
	}
  
    if(	$firstname_ok == TRUE && $lastname_ok == TRUE && $phone_ok == TRUE && $mobile_ok == TRUE && $email_ok == TRUE && $subject_ok == TRUE && $message_ok == TRUE && $error_message == "")
    {
    	$email_to = FI_ADMIN_EMAIL;
		$email_subject = $_POST["subject"];
	    $email_message .= "Datos de contacto:";
	    $email_message .= '
				  <table style = "width : 500px" border = 0 cellpading = "5" cellspacing = "0">
				    <tr style = "background-color: #F9F9F9; padding-top:5px;padding-bootom:5px">
				      <td valign= "top">Nombre:</td>
				      <td valign= "top">'.$_POST["first_name"].'</td>
				    </tr>
				    <tr style = "background-color: white; padding-top:5px;padding-bootom:5px">
				      <td valign= "top">Apellido:</td>
				      <td valign= "top">'.$_POST["last_name"].'</td>
				    </tr>
				    <tr style = "background-color: white; padding-top:5px;padding-bootom:5px">
				      <td valign= "top">Email:</td>
				      <td valign= "top">'.$_POST["email"].'</td>
				    </tr>				    
				    <tr style ="background-color: #F9F9F9; padding-top:5px;padding-bootom:5px">
				      <td  valign= "top">Tel&eacute;fono:</td>
				      <td valign= "top"><a>'.$_POST["phone"].'</a></td>
				    </tr>
				    <tr style ="background-color: #F9F9F9; padding-top:5px;padding-bootom:5px">
				      <td  valign= "top">Celular:</td>
				      <td valign= "top"><a>'.$_POST["mobile"].'</a></td>
				    </tr>
				    <tr style ="background-color: white; padding-top:5px;padding-bootom:5px">
				      <td valign= "top">Asunto:</td>
				      <td valign= "top">'.$_POST["subject"].'</td>
				    </tr>
				    <tr style ="background-color: #F9F9F9; padding-top:5px;padding-bootom:5px">
				      <td valign= "top">Mensaje:</td>
				      <td valign= "top">
				      	<div style = "width : 300px; word-wrap: break-word">'.$_POST["message"].'</div>
				      </td>
				    </tr>
				  </table>';

		//insert data pr_user
    	$data = array(
    		'first_name' => $_POST['first_name'], 
			'last_name' => $_POST['last_name'],
			'creation_dt' => date("Y-m-d H:i:s"),
			'email' => $_POST['email'],
			'phone' => $_POST['phone'],
			'mobile' => $_POST['mobile']			
    	);
    	$validate_email = $obj_contact->getContactByEmail($_POST['email']);    	
    	$obj_contact_msg = new FX_ContactMessage();
    	if(!$validate_email)
    	{    		
    		
    		$data_insert_user = $obj_contact->insert($data);
	   		    	    	
	    	$data_contact_msg = array(
	    		'fx_contact_id' => $data_insert_user,
	    		'subject' => $_POST['subject'] ,
	    		'message' => $_POST['message'] 

	    	);
	    	$response_contact_msg = $obj_contact_msg->insert($data_contact_msg);
	    	//sen$headers = FX_d mail
	    	$headers = FX_SimpleMail::getEmailHeaders();
	    	@mail($email_to, $email_subject, $email_message, $headers);
	    		//echo $_POST['email'];
	    	unset($_POST);
	    	$error_message = "<span id = 'errorContact' style='color:#A9A9B1'>Gracias, pronto estaremos en contacto contigo.</span>";	    			    
    	}
    	else
    	{
    		$data_contact_msg = array(
	    		'fx_contact_id' => $validate_email['fx_contact_id'],
	    		'creation_dt' => date("Y-m-d H:i:s"),
	    		'subject' => $_POST['subject'] ,
	    		'message' => $_POST['message'] 

	    	);
	    	$response_contact_msg = $obj_contact_msg->insert($data_contact_msg);
	    	$error_message = "<span id = 'errorContact' style='color:#A9A9B1'>Gracias, pronto estaremos en contacto contigo.</span>";
    	}    	    
    }
    else{
    	$error_message = "Error, intentelo de nuevo";
    }


}

