<div class="content-wrapper">
	<?=$error_message!=""? '<div class="alert alert-danger text-center">'.$error_message.'</div>':'' ?>	
	<div class="col-lg-6">				
		<h4 class="title-comment">Cont&aacute;cto</h4>
		<form class="form-horizontal form-comment" action="" method="POST">			

			<div class="form-group">			    
			    <div class="col-xs-12 col-sm-12">			    	
			    	<input value="" name="first_name" type="text"  class="form-control comment-input text-error" placeholder="Nombres">
			    	<?=!$firstname_ok?'<p class="text-danger">Este campo es Requerido</p>':''?>
				</div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			      <input value="" name="last_name" type="text" class="form-control comment-input" placeholder="Apellidos">
			      <?=!$lastname_ok?'<p class="text-danger">Este campo es Requerido</p>':''?>
			    </div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			      <input value="" name="email" type="text" class="form-control comment-input" placeholder="Email">
			      <?=!$email_ok?'<p class="text-danger">Este campo es Requerido</p>':''?>
			    </div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			      <input value="" name="phone" type="text" class="form-control comment-input" placeholder="T&eacute;lefono">
			    </div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			      <input value="" name="mobile" type="text" class="form-control comment-input" placeholder="Celular">
			    </div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			      <input value="" name="subject" type="text" class="form-control comment-input" placeholder="Asunto">
			      <?=!$subject_ok?'<p class="text-danger">Este campo es Requerido</p>':''?>
			    </div>
		    </div>
		    <div class="form-group">
		    	<!-- <label class="col xs-12 col-sm-2 control-label">Password</label> -->
			    <div class="col-xs-12 col-sm-12">
			    	<textarea value="" name="message" class="form-control comment-input" rows="7" placeholder="Mensaje.."></textarea>
			    	<?=!$message_ok?'<p class="text-danger">Este campo es Requerido</p>':''?> 
			    </div>
		    </div>
		  <div class="form-group">
			    <div class="col-xs-12  btn-clean-save">
			    	<input type="hidden" name="action" value="comment">
			    	<!--<button type="submit" class="btn btn-primary">Limpiar</button>-->
			    	<br><button type="submit" class="btn btn-primary">Guardar</button>
			    </div>
		  </div>
		</form>
	</div>
</div>