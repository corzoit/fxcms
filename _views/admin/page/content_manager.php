<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/page/manager')?>"><?=$_LANG[LANG_SYS]['cnt_mng_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-fw fa-table"></i> <?=$_LANG[LANG_SYS]['cnt_mng_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>	
</div>
<div id="msg"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="form-group search_page">
			        <label for="search_keyword" class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['cnt_mng_lbl_keyword']?>:</label>
			        <div class="col-xs-6">
			        	<input type="input" id="content_manager_keyword" name="search_keyword" class="form-control">
			        </div>
				    <!-- <div class="col-xs-3"> -->
				    	<!-- <input type="hidden" name="action" value="search_keyword"> -->
				     	<button class="btn btn-primary btn-search" id="btn-search-content"><?=$_LANG[LANG_SYS]['cnt_mng_keyword_btn']?></button>
				    <!-- </div>   -->
			 	</div>
			</div>
			<div class="form-horizontal">
				<div class="form-group">
					<label for="search_by_section" class="control-label col-xs-3"><?=$_LANG[LANG_SYS]['cnt_mng_lbl_section']?>:</label>
					<div class="col-xs-6" id="select_section">
						<select class="selectpicker form-control" id="content_manager_section" name="section_search" data-live-search="true">
						<?php
						$i = count($menu);
						$cont = 0; 
						if($menu)
						{
							foreach ($menu as $key_menu => $value_menu)
							{ 
								$cont=$cont+1;
							?>
								<optgroup label="<?=$value_menu['key_menu']?>">
								<?php	
								$data = array('fx_menu_id' => $value_menu['fx_menu_id'], 'deleted' => 0);
								$section = $fx_section->getByFilter($data, '', false);
								//$section = $fx_section->getSectionByMenuId($value_menu['fx_menu_id']);	
								if($section)
								{
									foreach($section as $key_section => $value_section)
									{	
										$data_sub_section = $fx_section->getSectionByOwnerld($value_section['fx_section_id'], true);
									?>
										<option value="<?=$value_section['fx_section_id']?>">* <?=$value_section['title']?></option>
										<?php
										foreach ($data_sub_section as $key_data_sub_section => $value_data_sub_section)
										{
											$space=25;
												?>
												<option style="margin-left:<?=$space?>px;" value="<?=$value_data_sub_section['fx_section_id']?>">* <?=$value_data_sub_section['title']?></option>
												<?
												if(is_array($value_data_sub_section))
												{
													$space = $space + 25;
													CC_FileHandler::nSubSections($value_data_sub_section, $space, '');
												}
										}					
									}
								}
								else
								{
								?>
									<option disabled="disabled">No sections to this menu.</option>
								<?
								}
								?>
								</optgroup>
								<?php if ($cont < $i): ?>
								<option data-divider="true"></option>	
								<?php endif ?>
							<?php
							}
						}
							?>
						</select>
					</div>
					<!-- <div class="col-xs-3"> -->
			        	<!-- <input type="hidden" name="action" value="search_section"> -->
			        	<button type="submit" class="btn btn-primary btn-search" id="btn-search-content-by-section"><?=$_LANG[LANG_SYS]['cnt_mng_btn_section']?></button>
			        <!-- </div> --> 
				</div>
			</div>
			<form class="form-horizontal" action="<?=FX_System::url("admin/page/add")?>" method="POST">
				<div class="form-group">
				    <div class="col-xs-12" align="center">
				    	<!-- <input type="hidden" name="action" value="new_page"> -->
				     	<button type="submit" class="btn btn-primary add-page"><?=$_LANG[LANG_SYS]['cnt_mng_btn_new_page']?></button>
				    </div>
			 	</div>
			</form>
		</div>
	</div>
</div>
<!-- <div id="content-manager" class="row"></div> -->
<div id="contentDiv" class="row"></div>	

<style type="text/css">
.dropdown-header {
	color: #5CB85C;
	font-weight: bold;
	font-size: 16px;
}
.divider {
    background-color: #3071A9 !important;
    height: 3px !important;
    margin: 0px 0px !important;
}

a:hover{
text-decoration: none;
}

</style>
