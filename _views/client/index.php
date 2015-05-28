<?php 
if(!$not_found_page)
{	
?>
<div>
	<h1>PAGE <?=$language?></h1>
	<div>
		<?=$result_page['content']?>
	</div>
</div>
<?php 
}
else
{
?>
<div class="row" style="width:100%; margin:0 auto;">
	<div class="col-xs-12">		
		<?php 
			$msg_not_content = $language == "en" ? 'No content for this section': 'No hay contenido para esta seccion';
		?>
		<div class="alert alert-danger"><?=$msg_not_content?>.</div>
	</div>
</div>
<?php	
}