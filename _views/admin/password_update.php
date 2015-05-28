<?php if($error)
{
?>
	<div class="alert alert-danger"><?=$error?></div>
<?php 
}
if($msg)
{
?>
	<div class="alert alert-success"><?=$msg?></div>
<?php 
}
if($expired)
{
?>
	<div class="alert alert-danger"><?=$expired?></div>
<?php
}
else
{
?>
<div class="row" id="form-centre-login">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading" align="center">
				<h3 class="panel-title"><?=$_LANG[LANG_SYS]['pass_upd_lbl_title']?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" name="password" class="form-control" placeholder="<?=$_LANG[LANG_SYS]['pass_upd_lbl_new_pass']?>">
							</div>
						</div>						
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input type="password" name="repeat_password" class="form-control" placeholder="<?=$_LANG[LANG_SYS]['pass_upd_lbl_rep_new_pass']?>">
							</div>
						</div>						
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-10">							
							<input type="hidden" name="action" value="changePassword">
							<input type="submit" class="btn btn-success" value="<?=$_LANG[LANG_SYS]['pass_upd_btn']?>">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?
}
?>
