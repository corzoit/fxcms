<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/contact/manager')?>"><?=$_LANG[LANG_SYS]['contact_mng_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-earphone"></i> <?=$_LANG[LANG_SYS]['contact_mng_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>	
</div>

<div class="row">
	<div class="col-sm-12">		
		<div class="search_contact form-group">
	    	<label for="search_contact" class="col-sm-2 control-label"><?=$_LANG[LANG_SYS]['contact_mng_lbl_search_contact']?></label>
	    	<div class="col-sm-7">
	      		<input type="text" class="form-control" id="search_contact" placeholder="<?=$_LANG[LANG_SYS]['contact_mng_lbl_help_contact']?>" name="search_contact">		      		
	    	</div>	    	
	    	<button id="btn-search-contact" class="btn btn-primary"><?=$_LANG[LANG_SYS]['contact_mng_btn_go']?></button>
	  	</div>				
		<div class="search_message form-group">
	    	<label for="search_message" class="col-sm-2 control-label"><?=$_LANG[LANG_SYS]['contact_mng_lbl_search_message']?></label>
	    	<div class="col-sm-7">
	      		<input type="text" class="form-control" id="search_message" placeholder="<?=$_LANG[LANG_SYS]['contact_mng_lbl_help_message']?>" name="search_message">		      		
	    	</div>
	    	<button id="btn-search-message" class="btn btn-primary"><?=$_LANG[LANG_SYS]['contact_mng_btn_go']?></button>
	  	</div>				
	  	<div class="search_post form-group">
	    	<label for="search_post" class="col-sm-2 control-label"><?=$_LANG[LANG_SYS]['contact_mng_lbl_search_post']?></label>
	    	<div class="col-sm-7">
	      		<input type="text" class="form-control" id="search_post" placeholder="<?=$_LANG[LANG_SYS]['contact_mng_lbl_help_post']?>" name="search_post">		      		
	    	</div>
	    	<button id="btn-search-post" class="btn btn-primary"><?=$_LANG[LANG_SYS]['contact_mng_btn_go']?></button>
	  	</div>		
	  	<?php if ($msg): ?>
	  		<div class="alert alert-danger" role="alert">
			  	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>				  	
			  	Fill in at least one field to search
			</div>				
		<?php endif ?>		
	</div>		
</div>

<!-- START SEARCH CONTACT -->
	
<div id="content-search" class="row">		
	
</div>


<style type="text/css">
a:hover{
text-decoration: none;
}
</style>