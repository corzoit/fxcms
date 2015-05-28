<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
			<a href="<?=FX_System::url('admin/form/manager')?>"><?=$_LANG[LANG_SYS]['form_mng_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="glyphicon glyphicon-picture"></i> <?=$_LANG[LANG_SYS]['form_mng_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>	
</div>

<div class="row">
	<div class="col-sm-12">		
	  	<div class="search_form form-group">
	    	<label for="search_form_title" class="col-sm-2 control-label"><?=$_LANG[LANG_SYS]['form_mng_lbl_sch_keyword']?></label>
	    	<div class="col-sm-7">
	      		<input id="search_title" name="search_title" type="text" class="form-control" placeholder="Title">		      		
	    	</div>	    		    	
	    	<button class="btn-search btn btn-primary"><?=$_LANG[LANG_SYS]['form_mng_btn_go']?></button>
	  	</div>

	  	<div class="search_form form-group">
	    	<label for="search_form_keyword" class="col-sm-2 control-label"><?=$_LANG[LANG_SYS]['form_mng_lbl_sch_content']?></label>
	    	<div class="col-sm-7">
	      		<input id="search_keyword" name="search_keyword" type="text" class="form-control" placeholder="Title">		      		
	    	</div>	    	
	    	<button class="btn-search btn btn-primary"><?=$_LANG[LANG_SYS]['form_mng_btn_go']?></button>
	  	</div>
	</div>		
</div>
<!-- ** START SEARCH ** -->
<div id="contentDiv" class="row">		
	
</div>

<style type="text/css">
a:hover{
text-decoration: none;
}
</style>