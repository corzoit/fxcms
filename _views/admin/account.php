<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/account')?>"><?=$_LANG[LANG_SYS]['acc_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-dashboard"></i> <?=$_LANG[LANG_SYS]['acc_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>	
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">					
					<?=$_LANG[LANG_SYS]['acc_lbl_language_title']?>
				</h3>
			</div>
			<div class="panel-body">
				<?php 				
					if(is_array($data_sys))
					{ 						
						foreach ($data_sys as $key_dt_sys => $value_dt_sys) 
						{
				?>		
							<a href="" class="btn-language" data-id="<?=$value_dt_sys['fxsys_id']?>">
								<img src="<?=FX_System::url('themes/common/images/'.$value_dt_sys['lang_sys'].'.png')?>">								
							</a>											
				<?php
						}								
					} 
				?>
			</div>
		</div>
	</div>
</div>
<div id="view_error"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-primary">
		  <!-- Default panel contents -->
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="glyphicon glyphicon-user"></i> <?=$_LANG[LANG_SYS]['acc_lbl_acc_title']?>
				</h3>
			</div>
			<div class="panel-body">
				<div class="form-horizontal">
					<form role="form" method="POST" id="change_account">
						<div class="form-group">
							<label for="first_name" class="control-label col-xs-4"><?=$_LANG[LANG_SYS]['acc_lbl_acc_firstname']?>:</label>
					        <div class="col-xs-5">
					        	<input type="text" name="firstname" value="<?=$data_user['first_name']?>" class="form-control">
					        </div> 
					 	</div>
					 	<div class="form-group">
					 		<label for="last_name" class="control-label col-xs-4"><?=$_LANG[LANG_SYS]['acc_lbl_acc_lastname']?>:</label>
					        <div class="col-xs-5">
					        	<input type="text" name="lastname" value="<?=$data_user['last_name']?>" class="form-control">
					        </div> 
					 	</div>
					 	<div class="form-group">
					 		<label for="email" class="control-label col-xs-4"><?=$_LANG[LANG_SYS]['acc_lbl_acc_email']?>:</label>
					        <div class="col-xs-5">
					        	<input type="email" name="email" value="<?=$data_user['email']?>" class="form-control">
					        </div> 
					 	</div>
					 	<div class="form-group">
					 		<label for="change_pass" class="control-label col-xs-4"><?=$_LANG[LANG_SYS]['acc_lbl_acc_chg_pass']?>:</label>
					        <div class="col-xs-5">
					        	<input data-toggle="checkbox-x" data-three-state="false" value="0" id="change" name="change_pass">
					        </div> 
					 	</div>
					 	<div class="form-group" id="div_password" style="display:none">
					 		<label for="password" class="control-label col-xs-4"><?=$_LANG[LANG_SYS]['acc_lbl_acc_pass']?>:</label>
					        <div class="col-xs-5">
					        	<input type="password" name="password" class="form-control">
					        </div> 
					 	</div>
					 	<div class="form-group">
					 		<label class="ontrol-label col-xs-5"></label>
					        <div class="col-xs-6">
					        	<input type="hidden" value="update_user" name="action" class="form-control" align="center">
					        	<button type="button"  onclick="change_account($('#change_account').serialize())" class="btn btn-primary"><?=$_LANG[LANG_SYS]['acc_lbl_acc_btn']?></button>
					        </div> 
					 	</div>			  	
					</form>
				</div>
			</div>
		</div>
		<div id="content-userlog" class="row">		
		</div>
	</div>
</div>

<style type="text/css">
a:hover{
text-decoration: none;
}
</style>

