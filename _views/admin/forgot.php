<?php 
if($error)
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
?>
<div class="row" id="form-centre-login">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading" align="center">
				<h3 class="panel-title"><?=$_LANG[LANG_SYS]['forgot_lbl_title']?></h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="email" name="email" class="form-control" placeholder="<?=$_LANG[LANG_SYS]['forgot_lbl_email']?>">
							</div>														
						</div>
					</div>
					<div class="form-group">
						<!--<label class="col-sm-2 control-label"></label>-->
						<div class="col-sm-12" align="center">							
							<input type="hidden" name="action" value="forgot">
							<input type="submit" class="btn btn-success" value="<?=$_LANG[LANG_SYS]['forgot_btn_submit']?>">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
