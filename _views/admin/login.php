<?php if($error)
{
?>
	<div class="alert alert-danger"><?=$error?></div>
<?php
}
?>	
<div class="row" id="form-centre-login">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading" align="center">
				<h3 class="panel-title"><?=$_LANG[LANG_SYS]['login_lbl_title']?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="email" name="username" class="form-control" placeholder="<?=$_LANG[LANG_SYS]['login_lbl_user']?>">
							</div>														
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder="<?=$_LANG[LANG_SYS]['login_lbl_password']?>">
							</div>
						</div>						
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>						
						<div class="col-sm-10">
							<a href="forgot"><?=$_LANG[LANG_SYS]['login_lbl_forgot']?></a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12" align="center">							
							<input type="hidden" name="action" value="login">
							<input type="submit" class="btn btn-success" value="<?=$_LANG[LANG_SYS]['login_lbl_btn']?>">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
