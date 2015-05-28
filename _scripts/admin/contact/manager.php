<?php
define ("FX_TEMPLATE","admin.php"); 
FX_System::validateAdminLogin();
$obj_contact = new FX_Contact();
$fx_date = new FX_Date();

/* CONTACT */
	if(base64_decode($_GET['download']) == 'contact')
	{
		$obj_report = new FX_Report();
		$search_manager = htmlentities($_GET['search'],ENT_QUOTES, "UTF-8");
		$response = $obj_report->reportContact($search_manager);			
		CC_FileHandler::header_csv($response['path_url'], $response['file']);	
		exit();
	}

	if($_POST['action'] == "search_contact")
	{		
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
		$search_manager = $_POST['search'];
		$page_search_count = $obj_contact->getContactCountBySearch($search_manager);
		$records = 5;
		$page_search_count = $page_search_count['count'];
		$__response = array();
		$pagination = FX_System::getPageNumbering($page_search_count, $num_page, $data, $records); 
		$limit = $pagination['limit'];
		$__response = $obj_contact->getContactAll($search_manager, $limit);
	
		$response ='';
		?>
		
		<?php
		if ($__response)
		{ 
			?>
			<div class="col-sm-12">			
				<a href="#" class="fancyAddContact" onclick="formAddContact();" ><?=$_LANG[LANG_SYS]['contact_srh_contc_link_add_new']?></a>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							<i class="glyphicon glyphicon-phone-alt"></i>
							<?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_title']?>
						</h3>
					</div>
					<div class="panel-body">					
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th><?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_name']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_business']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_email']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_phone']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_contc_lbl_mobile']?></th>
										<th></th>
									</tr>
								</thead>
								<tbody class="tBody">
									<?php foreach ($__response as $key_contact => $value_contact): ?>
									<tr>
										<td><?=$value_contact['first_name'].", ".$value_contact['last_name']?></td>
										<td><?=$value_contact['business']?></td>
										<td><?=$value_contact['email']?></td>
										<td><?=$value_contact['phone']?></td>
										<td><?=$value_contact['mobile']?></td>									
										<td>
											<a href="#" class="fancyEditContact btn btn-primary" onclick="formEditContact(<?=$value_contact['fx_contact_id']?>);" role="button" ><?=$_LANG[LANG_SYS]['contact_srh_contc_btn_edit']?></a>
											<!--<button class="btn-edit-contact" class="btn btn-primary" onclick="edit_contact(<?=$value_contact['fx_contact_id']?>);">Edit</button>-->
											<button class="btn btn-danger" onclick="deleteContact(<?=$value_contact['fx_contact_id']?>);"><?=$_LANG[LANG_SYS]['contact_srh_contc_btn_delete']?></button>
										</td>
									</tr>
									<?php endforeach ?>
									<tr> <td colspan='6'> <?=$pagination['numbering']?></td> </tr>
								</tbody>
							</table>
						</div>				
						<div class="text-right">							
							<a class="btn btn-success" href="?download=<?=base64_encode('contact')?>&search=<?=$search_manager?>" target="_blank">
								<?=$_LANG[LANG_SYS]['contact_srh_contc_btn_download_list']?>
								<i class="fa fa-arrow-circle-right"></i>
							</a>
							<i ></i>
						</div>
					</div>
				</div>
			</div>
		<?php 
		}
		else
		{
			?>
			<div class="col-sm-12">
				<a href="#" class="fancyAddContact" onclick="formAddContact();" ><?=$_LANG[LANG_SYS]['contact_srh_contc_link_add_new']?></a>
			</div>
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?=$_LANG[LANG_SYS]['contact_srh_contc_error_not_found']?>
			</div>
			<?php
		}		
		exit();
	}


	if ($_POST['action'] == 'delete_contact') 
	{
		
		$fx_contact_id = $_POST['fx_contact_id'];
		$data = array(
			'deleted' => 1
		);
		$obj_contact->updateContact($fx_contact_id, $data);
		exit();	
	}

	if($_POST['action'] == "form_edit_contact")
	{		
		$data_contact = $obj_contact->getContactById($_POST['fx_contact_id']);
		?>				
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<div id="form-edit-contact" class="form-horizontal" role="form">			
				<div class="form-group">				        
			        <div class="col-md-12">				          
			        	<h3><p class="text-center"><?=$_LANG[LANG_SYS]['contact_edit_lbl_title']?></p></h3>
			        </div>
			    </div>
			    <div class="form-group">
			    	<div class="msgError alert alert-danger col-md-12" style="display:none;">
			    	</div>
			    	<div class="msgSuccess alert alert-success col-md-12" style="display:none;">
			    	</div>
			    </div>				
				<div class="form-group">
					<input class="form-control" type="hidden" name="fx_contact_id" value="<?=$data_contact['fx_contact_id']?>">
				</div>
			    <div class="form-group">
			        <label for="first_name" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_first_name']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="first_name" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_first_name']?>" value="<?=$data_contact['first_name']?>">
			        </div>
			    </div>				   
			    <div class="form-group">
			        <label for="last_name" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_last_name']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="last_name" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_last_name']?>" value="<?=$data_contact['last_name']?>">	
			        </div>
			    </div>	
			    <div class="form-group">
			        <label for="email" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_email']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="email" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_email']?>" value="<?=$data_contact['email']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="business" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_business']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="business" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_business']?>" value="<?=$data_contact['business']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="phone" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_phone']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="phone" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_phone']?>" value="<?=$data_contact['phone']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="mobile" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_mobile']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="mobile" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_mobile']?>" value="<?=$data_contact['mobile']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="address" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_address']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="address" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_address']?>" value="<?=$data_contact['address']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="suburb" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_suburb']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="suburb" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_suburb']?>" value="<?=$data_contact['suburb']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="postcode" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_postcode']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="postcode" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_postcode']?>" value="<?=$data_contact['postcode']?>">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="country" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_country']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="country" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_country']?>" value="<?=$data_contact['country']?>">
			        </div>
			    </div>
			     <div class="form-group">
			        <label for="action" class="col-md-4 control-label"></label>
			        <div class="col-md-8">				          
						<input class="form-control" type="hidden" name="action" value="edit_contact">
			        </div>
			    </div>
			    <div class="form-group">
					<label  class="col-md-4 control-label"></label>					
					<button class="btn btn-success" onclick="editContact(<?=$data_contact['fx_contact_id']?>)"><?=$_LANG[LANG_SYS]['contact_edit_btn_save']?></button>
					<button class="close-fancy btn btn-danger" onclick="closeFancy();"><?=$_LANG[LANG_SYS]['contact_edit_btn_close']?></button>
				</div>
			</div>
		</div>			
		<?php
		exit();
	}
	
	if($_POST['action'] == "form_add_contact")
	{
		?>	
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<div id="form-add-contact" class="form-horizontal" role="form">				
				<div class="form-group">				        
			        <div class="col-md-12">				          			        	
			        	<h3><p class="text-center"><?=$_LANG[LANG_SYS]['contact_add_lbl_title']?></p></h3>
			        </div>
			    </div>
			    <div class="form-group">
			    	<div class="msgError alert alert-danger col-md-12" style="display:none;">
			    	</div>
			    	<div class="msgSuccess alert alert-success col-md-12" style="display:none;">
			    	</div>
			    </div>				
				<div class="form-group">
					<input class="form-control" type="hidden" name="fx_contact_id" value="<?=$data_contact['fx_contact_id']?>">
				</div>

			    <div class="form-group">
			        <label for="first_name" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_first_name']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="first_name" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_first_name']?>" value="">
			        </div>
			    </div>				   
			    <div class="form-group">
			        <label for="last_name" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_last_name']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="last_name" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_last_name']?>" value="">	
			        </div>
			    </div>	
			    <div class="form-group">
			        <label for="email" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_email']?>:</label>
			        <div class="col-md-8">				          
			          <input class="form-control" type="text" name="email" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_email']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="business" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_business']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="business" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_business']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="phone" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_phone']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="phone" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_phone']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="mobile" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_mobile']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="mobile" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_mobile']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="address" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_address']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="address" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_address']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="suburb" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_suburb']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="suburb" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_suburb']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="postcode" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_postcode']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="postcode" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_postcode']?>" value="">
			        </div>
			    </div>
			    <div class="form-group">
			        <label for="country" class="col-md-4 control-label"><?=$_LANG[LANG_SYS]['contact_add_lbl_country']?>:</label>
			        <div class="col-md-8">				          
						<input class="form-control" type="text" name="country" placeholder="<?=$_LANG[LANG_SYS]['contact_add_lbl_placeholder_country']?>" value="">
			        </div>
			    </div>
			     <div class="form-group">
			        <label for="action" class="col-md-4 control-label"></label>
			        <div class="col-md-8">				          
						<input class="form-control" type="hidden" name="action" value="add_contact">
			        </div>
			    </div>
			    <div class="form-group">
					<label  class="col-md-4 control-label"></label>
					<button class="btn btn-success" onclick="addContact()"><?=$_LANG[LANG_SYS]['contact_add_btn_save']?></button>
					<button class="close-fancy btn btn-danger" onclick="closeFancy();"><?=$_LANG[LANG_SYS]['contact_add_btn_close']?></button>
				</div>
			</div>
		</div>						
		<?php
		exit();
	}
	
	if ($_POST['action'] == 'edit_contact')
	{				
		$data = array(
		"first_name" 	=> $_POST['first_name'],
		"last_name" 	=> $_POST['last_name'],
		"email" 		=> $_POST['email'],
		"business" 		=> $_POST['business'],
		"phone" 		=> $_POST['phone'],
		"mobile" 		=> $_POST['mobile'],
		"address" 		=> $_POST['address'],
		"suburb" 		=> $_POST['suburb'],
		"postcode"	 	=> $_POST['postcode'],
		"country" 		=> $_POST['country']
		);
		$obj_contact->updateContact($_POST['fx_contact_id'],$data);		
	}
	if ($_POST['action'] == 'add_contact')
	{		
		$__response = array();
		$first_name_err = $last_name_err = $email_err = $business_err = $phone_err = $mobile_err = $address_err = $suburb_err = $postcode_err =  $country_err = "";
		strlen(trim($_POST['first_name'])) ? $first_name = $_POST['first_name'] : $first_name_err = "<p class='text-danger'>- First name is required</p>";
		strlen(trim($_POST['last_name'])) ? $last_name = $_POST['last_name'] : $last_name_err = "<p class='text-danger'>- Last Name is required</p>";
		strlen(trim($_POST['email'])) ? $email = $_POST['email'] : $email_err = "<p class='text-danger'>- Email is required</p>";
		strlen(trim($_POST['business'])) ? $business = $_POST['business'] : $business_err = "<p class='text-danger'>- Business is required</p>";
		
		$phone = $_POST['phone'];
		$mobile = $_POST['mobile'];
		$address = $_POST['address'];
		$suburb = $_POST['suburb'];
		$postcode = $_POST['suburb'];
		$country = $_POST['suburb'];
		if($first_name_err != "" || $last_name_err != "" || $email_err != "" || $business_err != "")
		{
			$__response = array(
				"success" => false,
				"msg"	  => $first_name_err. $last_name_err. $email_err . $business_err
				);
		}

		else
		{	
			$data = array(		
				"first_name" 	=> FX_System::saveStrDb($first_name),
				"last_name" 	=> FX_System::saveStrDb($last_name),
				"email" 		=> FX_System::saveStrDb($email),
				"business" 		=> FX_System::saveStrDb($business),
				"phone" 		=> $phone,
				"mobile" 		=> $mobile,
				"address" 		=> FX_System::saveStrDb($address),
				"suburb" 		=> FX_System::saveStrDb($suburb),
				"postcode"	 	=> $postcode,
				"country" 		=> FX_System::saveStrDb($country)
			);
			$response = $obj_contact->insert($data);
			
			if(is_numeric($response))
			{
				$__response = array(
					"success" 	=> true,
					"msg"		=> "<p class='success'>registered successfully</p>"
					);
			}
			else
			{
				$__response = array(
					"success" 	=> false,
					"msg"		=> "<p class='text-danger'>Error, please try again in one moment</p>"
					);
			}
		}
		echo(json_encode($__response));
		exit();
	}


/* END CONTACT */

/* CONTACT MESSAGE */

	if ($_POST['action']=="search_message"){
		$obj_contact_message = new FX_ContactMessage();
		$num_pagina = $_POST['num_pag'];
		$data = $_POST['data'];
		$search_manager = $_POST['search'];
		$total_records = $obj_contact_message->contactMessageCount();
		$__response = array();
		$pagination = FX_System::getPageNumbering($total_records,$num_pagina,$data,3 ); 

		$limit = $pagination['limit'];

		$__response = $obj_contact_message->getContactMessageAll($search_manager, $limit);
		
		$response ='';
		?>
		<?php if ($__response): ?>
			<div class="col-sm-12">		
				<div class="panel panel-green">
					<div class="panel-heading">
						<h3 class="panel-title">
							<i class="glyphicon glyphicon-phone-alt"></i>
							<?=$_LANG[LANG_SYS]['contact_srh_msg_lbl_title']?>
						</h3>
					</div>
					<div class="panel-body">					
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th><?=$_LANG[LANG_SYS]['contact_srh_msg_lbl_name']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_msg_lbl_date_entered']?></th>
										<th><?=$_LANG[LANG_SYS]['contact_srh_msg_lbl_subject']?></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($__response as $key_data_contact_message => $value_data_contact_message): ?>
									<tr>									
										<td><?=$value_data_contact_message['name']?></td>
										<td><?=$fx_date->convertToLocal($value_data_contact_message['creation_dt'])?></td>
										<td>
											<?php if (strlen(trim($search_manager))): ?>
												<?php if (strlen(stristr($value_data_contact_message['subject'], $search_manager))>0): ?>
													<b><?=substr(stristr($value_data_contact_message['subject'], $search_manager),0,40)?></b>
												<?php elseif(strlen(stristr($value_data_contact_message['message'], $search_manager))>0): ?>
													<b><?=substr(stristr($value_data_contact_message['message'], $search_manager),0,40)?></b>
												<?php endif ?>
											<?php else: ?>
												<?=substr($value_data_contact_message['message'],0,40)?>
											<?php endif ?>
											
										</td>																			
										<td>
											<button class="btn btn-primary"><?=$_LANG[LANG_SYS]['contact_srh_msg_btn_view']?></button>
											<button class="btn btn-danger" onclick="deleteContactMessage(<?=$value_data_contact_message['fx_contact_message_id']?>);"><?=$_LANG[LANG_SYS]['contact_srh_msg_btn_delete']?></button>
										</td>
									</tr>
									<?php endforeach ?>	
									<tr> <td colspan='6'> <?=$pagination['numbering']?></td> </tr>
								</tbody>
							</table>
						</div>								
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?=$_LANG[LANG_SYS]['contact_srh_msg_error_not_found']?>
			</div>;
		<?php endif ?>
		<?php
		exit();
	}
		

	if($_POST['action'] == "delete_contact_message")
	{
		$obj_contact_message = new FX_ContactMessage();

		$fx_contact_message_id = $_POST['fx_contact_message_id'];
		$data = array(
			'deleted' => 1
		);
		$obj_contact_message->updateContactMessage($fx_contact_message_id, $data);	
	}
/* END CONTACT MESSAGE */



/* POST */
	if($_POST['action'] == 'search_post')
	{
		$obj_post = new FX_post();
		$num_pagina = $_POST['num_pag'];
		$data = $_POST['data'];
		$search_manager = $_POST['search'];	
		$total_records = $obj_post->postCount();
		$__response = array();
		$pagination = FX_System::getPageNumbering($total_records,$num_pagina,$data,3 ); 

		$limit = $pagination['limit'];

		$__response = $obj_post->getPostAll($search_manager, $limit);

		$response ='';
		if($__response)
		{
		?>
		<div class="col-sm-12">		
			<div class="panel panel-danger">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="glyphicon glyphicon-phone-alt"></i>
						<?=$_LANG[LANG_SYS]['contact_srh_post_lbl_title']?>
					</h3>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['contact_srh_post_lbl_name']?></th>
									<th><?=$_LANG[LANG_SYS]['contact_srh_post_lbl_date_entered']?></th>
									<th><?=$_LANG[LANG_SYS]['contact_srh_post_lbl_cnt_page']?></th>
									<th><?=$_LANG[LANG_SYS]['contact_srh_post_btn_post']?></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($__response as $key_data_post => $value_data_post): ?>
								<tr>									
									<td><?=$value_data_post['name']?></td>
									<td><?=$fx_date->convertToLocal($value_data_post['creation_dt'])?></td>
									<td><?=$value_data_post['title']?></td>
									<td><?=$value_data_post['comments']?></td>																			
									<td>
										<button class="btn btn-primary"><?=$_LANG[LANG_SYS]['contact_srh_post_btn_view']?></button>
										<button class="btn btn-danger" onclick="deletePost(<?=$value_data_post['fx_post_id']?>);"><?=$_LANG[LANG_SYS]['contact_srh_post_btn_delete']?></button>
									</td>
								</tr>
								<?php endforeach ?>	
							</tbody>
						</table>
					</div>								
				</div>
			</div>
		</div>
		<?			
		}
		else
		{
		?>		
			<div class="alert alert-danger" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?=$_LANG[LANG_SYS]['contact_srh_post_error_not_found']?>
			</div>;
		<?php
		}
		exit();    
	}

	if ($_POST['action'] == 'delete_post') 
	{	
		$obj_post = new FX_Post();
		$fx_post_id = $_POST['fx_post_id'];
		$data = array(
			'deleted' => 1
		);
		$obj_post->updatePost($fx_post_id, $data);	
		exit();
	}

/* END POST */


?>



