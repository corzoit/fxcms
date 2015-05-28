<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/comment/manager')?>"><?=$_LANG[LANG_SYS]['comment_edit_lbl_title_comm']?></a> > <a href="<?=FX_System::url('admin/comment/page/'.$content_page['fx_page_id'])?>"><?=$content_page['title']?></a> > <a href="<?=FX_System::url('admin/comment/edit/'.$__FX_PARAMS['id'])?>"><?=$_LANG[LANG_SYS]['comment_edit_lbl_title_edit']?></a> 
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-dashboard"></i> <?=$_LANG[LANG_SYS]['comment_edit_lbl_subtitle']?>
	        </li>
	    </ol>
	</div>

	<div class="col-sm-12">
		<div class="panel panel-primary" id='exist_content'>
			<div class="panel-heading">

				<h3 class="panel-title">
					<i class=" glyphicon glyphicon-book"></i>
					<?=$_LANG[LANG_SYS]['comment_edit_lbl_list_comm_approve_disapprove']?>
				</h3>
			</div>
			<div class="panel-body">					
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><?=$_LANG[LANG_SYS]['comment_edit_lbl_comm']?></th>
								<th><?=$_LANG[LANG_SYS]['comment_edit_lbl_option']?></th>
							</tr>
						</thead>
						<tbody class="tBody">
							<?php 
							if($comments)
							{
								foreach ($comments as $key => $value)
								{
								?>
									<tr>
										<td><?=$value['comments']?></td>
										<?php 
										$permission_value = $value['approve'] == 1 ? $_LANG[LANG_SYS]["comment_edit_btn_disapprove"] : $_LANG[LANG_SYS]["comment_edit_btn_approve"];
										$class_permission = $value['approve'] == 1 ? 'btn-danger' : 'btn-success';
										$value_permission_db = $value['approve'] == 1 ? 'approve' : 'disapprove';
										?>
										<td><a onclick='permission_comment(<?=$value['fx_post_id']?>, $(this).attr("value"))' name="permission" value="<?=$value_permission_db?>" class="btn_permission btn <?=$class_permission?>"><?=$permission_value?></a></td>
									</tr>
								<?
								}
							}
							else
							{
								?>
								<tr><td colspan="2"><div class="alert alert-danger text-center"><?=$_LANG[LANG_SYS]['comment_edit_msg_not_found_comm']?></div></td></tr>
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

<script type="text/javascript">
	$(".btn_permission").click(function(){
		if($(this).attr('value') == 'approve')
		{
			$(this).attr('class','btn_permission btn btn-success');
			$(this).attr('value','disapprove');
			$(this).text("Aprobar");
		}
		else
		{
			$(this).attr('class','btn_permission btn btn-danger');
			$(this).attr('value','approve');
			$(this).text("Desaprobar");
		}
	})
</script>
