<div class="content-wrapper">
	<?php
	if(!$not_found_page)
	{		
		echo($result_page['content']);	
	}
	else
	{
	?>		
		<?php 
			$msg_not_content = $language == "en" ? 'No content for this section': 'No hay contenido para esta seccion';
		?>
		<div class="alert alert-danger"><?=$msg_not_content?>.</div>
	<?php	
	}
	?>
</div>