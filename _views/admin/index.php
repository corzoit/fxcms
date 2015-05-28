<?php 
	$fx_date = new FX_Date();
?>
<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">
            <a href="<?=FX_System::url('admin/')?>"><?=$_LANG[LANG_SYS]['dash_lbl_title']?></a>
        </h1>
		<ol class="breadcrumb">
	        <li class="active">
	            <i class="fa fa-dashboard"></i> <?=$_LANG[LANG_SYS]['dash_lbl_sub_title']?>
	        </li>
	    </ol>
	</div>	
</div>


<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-green">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-clock-o fa-fw"></i>
					<?=$_LANG[LANG_SYS]['dash_lbl_tbl_order_title']?>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_order_contact']?></th>
								<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_order_comment']?></th>
								<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_order_date']?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data_order as $key_order => $value_order): ?>
							<tr>
								<td><?=$value_order['first_name']?></td>
								<td><?=$value_order['comments']?></td>
								<td><?=$fx_date->convertToLocal($value_order['creation_dt'], true)?></td>
							</tr>
							<?php endforeach ?>								
						</tbody>
					</table>
				</div>
				<!--<div class="text-right">
					<a href="#"><?=$_LANG[LANG_SYS]['dash_link_tbl_all_activity']?></a>
					<i class="fa fa-arrow-circle-right"></i>
				</div>-->
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-clock-o fa-fw"></i>
					<?=$_LANG[LANG_SYS]['dash_lbl_tbl_post_title']?>
				</h3>
			</div>
			<div class="panel-body">				
				<?php if (count($data_post)>0): ?>
					<div class="list-group">
						<?php foreach ($data_post as $key_post => $value_post): ?>
							<a href="" class="list-group-item">
								<span class="badge"> <?=$_LANG[LANG_SYS]['dash_lbl_tbl_post_created']?> <?=$fx_date->convertToLocal($value_post['creation_dt'])?> </span>
								<i class="fa fa-fw fa-calendar"></i>
									<?=$value_post['comments']?>
							</a>
						<?php endforeach ?>										
						<!--<div class="text-right">
							<a href="#"><?=$_LANG[LANG_SYS]['dash_link_tbl_all_activity']?></a>
							<i class="fa fa-arrow-circle-right"></i>
						</div>-->
					</div>
				<?php else: ?>
					<div class="list-group">
						<span class="badge"><?=$_LANG[LANG_SYS]['dash_tbl_msg_error_not_found']?></span>					
					</div>
				<?php endif ?>
			</div>

		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-clock-o fa-fw"></i>
					<?=$_LANG[LANG_SYS]['dash_lbl_tbl_contact_messages_title']?>
				</h3>
			</div>
			<div class="panel-body">

				<?php if (count($data_contact_message)>0): ?>
					<div class="table-responsive">					
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_contact_messages_contact']?></th>
									<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_contact_messages_subject']?></th>
									<th><?=$_LANG[LANG_SYS]['dash_lbl_tbl_contact_messages_date']?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data_contact_message as $key_contact_message => $value_contact_message): ?>
								<tr>
									<td><?=$value_contact_message['first_name']?></td>
									<td><?=$value_contact_message['subject']?></td>
									<td><?=$fx_date->convertToLocal($value_contact_message['creation_dt'])?></td>
								</tr>
								<?php endforeach ?>								
							</tbody>
						</table>
					</div>
					<!--<div class="text-right">
						<a href="#"><?=$_LANG[LANG_SYS]['dash_link_tbl_all_activity']?></a>
						<i class="fa fa-arrow-circle-right"></i>
					</div>-->											
				<?php else: ?>
					<div class="list-group">
						<span class="badge"><?=$_LANG[LANG_SYS]['dash_tbl_msg_error_not_found']?></span>					
					</div>
				<?php endif ?>
			</div>				
			
		</div>
	</div>
</div>



	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-clock-o fa-fw"></i>
						<?=$_LANG[LANG_SYS]['dash_lbl_tbl_form_filled_title']?>
					</h3>
				</div>
				<div class="panel-body">
					<?php if (count($data_form_answ)>0): ?>
						<div class="table-responsive">					
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th><?=$_LANG['en']['dash_lbl_tbl_form_filled_titlehr']?></th>
										<th><?=$_LANG['en']['dash_lbl_tbl_form_filled_Answer']?></th>
										<th><?=$_LANG['en']['dash_lbl_tbl_form_filled_position']?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data_form_answ as $key_form_answ => $value_form_answ): ?>
									<tr>
										<td><?=$form_answ['title']?></td>
										<td><?=$form_answ['answer']?></td>
										<td><?=$form_answ['position']?></td>
									</tr>
									<?php endforeach ?>								
								</tbody>
							</table>
						</div>
						<!--<div class="text-right">
							<a href="#"><?=$_LANG['en']['link_view_all']?></a>
							<i class="fa fa-arrow-circle-right"></i>
						</div>	-->										
					<?php else: ?>
						<div class="list-group">
							<span class="badge"><?=$_LANG[LANG_SYS]['dash_tbl_msg_error_not_found']?></span>					
						</div>
					<?php endif ?>
				</div>				
				
			</div>
		</div>
	</div>

<style type="text/css">
a:hover{
text-decoration: none;
}
</style>