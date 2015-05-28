<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/comment/manager')?>"><?=$_LANG[LANG_SYS]['comment_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-dashboard"></i> <?=$_LANG[LANG_SYS]['comment_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>

	<div class="col-sm-12">
		<div class="panel panel-primary" id='exist_content'>
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class=" glyphicon glyphicon-book"></i>
					<?=$_LANG[LANG_SYS]['comment_lbl_comm_enabled_title']?>
				</h3>
			</div>
			<div class="panel-body">					
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?=$_LANG[LANG_SYS]['comment_lbl_title_page']?></th>
								<th><?=$_LANG[LANG_SYS]['comment_lbl_option']?></th>
							</tr>
						</thead>
						<tbody class="tBody">
							<?php 
							if($page_comments)
							{
								foreach ($page_comments as $key => $value)
								{
								?>
									<tr>
										<td><?=$value['title']?></td>
										<td><a href='<?=FX_System::url('admin/comment/page/'.$value["fx_page_id"])?>'><?=$_LANG[LANG_SYS]['comment_lbl_comm_view']?></a></td>
									</tr>
								<?
								}
							}
							else
							{
								?>
								<tr><td colspan="2"><div class="alert alert-danger text-center"><?=$_LANG[LANG_SYS]['comment_page_msg_not_required_comm']?></div></td></tr>
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

