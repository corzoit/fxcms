<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/comment/manager')?>"><?=$_LANG[LANG_SYS]['comment_page_lbl_title_comm']?></a> > <a href="<?=FX_System::url('admin/comment/page/'.$content_page['fx_page_id'])?>"><?=$content_page['title']?></a> 
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-dashboard"></i> <?=$_LANG[LANG_SYS]['comment_page_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>
	<div class="col-sm-12 text-center">
		<a class="btn btn-success" href="<?=FX_System::url('admin/comment/edit/'.$content_page['fx_page_id'])?>"><?=$_LANG[LANG_SYS]['comment_page_btn_all_comm']?></a><br><br>
	</div>
	<div class="col-sm-12">
		<div id="msg_success" style="display:none" class="alert alert-success"></div>
	</div>
	<div class="col-sm-12">
		<div class="panel panel-primary" id='exist_content'>
			<div class="panel-heading">

				<h3 class="panel-title">
					<i class=" glyphicon glyphicon-book"></i>
					<?=$_LANG[LANG_SYS]['comment_page_lbl_list_comm_approve']?>
				</h3>
			</div>
			<div class="panel-body">					
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?=$_LANG[LANG_SYS]['comment_page_lbl_comm']?></th>
								<th><?=$_LANG[LANG_SYS]['comment_page_lbl_option']?></th>
							</tr>
						</thead>
						<tbody class="tBody">
							<?php 
							if($comments)
							{
								foreach ($comments as $key => $value)
								{
								?>
									<tr id="<?=$value['fx_post_id']?>">
										<td><?=$value['comments']?></td>
										<td><a onclick='delete_comment(<?=$value['fx_post_id']?>)' class="btn btn-danger"><?=$_LANG[LANG_SYS]['comment_page_btn_delete_comm']?></a></td>
									</tr>
								<?
								}
							}
							else
							{
								?>
								<tr><td colspan="2"><div class="alert alert-danger text-center"><?=$_LANG[LANG_SYS]['comment_page_msg_not_found_comm']?></div></td></tr>
								<?
							}
							?>
							
						</tbody>
					</table>
				</div>				
			</div>
		</div>
	</div>	
</div>

