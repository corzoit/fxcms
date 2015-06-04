<div id="banner">	
	<div class="">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<?php			    			
				if($data_slide)
				{					
					$sli_by_slId = $fx_slideShowImage->getSlideShowImageBySlideShowId($data_slide['fx_slideshow_id']);					
					if(count($sli_by_slId)==0)
					{
						$sli_by_slId = $fx_slideShowImage->getByCode("DEFAULT");
					}						
				}		    
				else{
					$sli_by_slId = $fx_slideShowImage->getByCode("DEFAULT");
				}
		
		    ?>
			<ol class="carousel-indicators">
			<?php foreach ($sli_by_slId as $key => $value) 
			{	
			?>
				<li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=($key == 0)? "active" : ""?>"></li>
			<?php 
			}?>
			</ol> 
			<div class="carousel-inner">
			    <?php
			    foreach ($sli_by_slId as $key_image => $value_sli) 
			    {	
			    ?>
			    <div style = "max-height : <?=$value_sli['height']?>px"  <?= ($key_image == 0) ? "class='item active'" : "class='item'" ?>>
			      	<img width = "100%" src="<?=FX_System::url("file/img/slideshow/").$value_sli['image']?>">
			      	<div class="carousel-caption">
			          	<h3><?= $value_sli['caption']?></h3>
			      	</div>
			    </div>
			    <?
			    }
			    ?>
			</div>
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">&lsaquo;</a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">&rsaquo;</a>
		</div>
	</div>
</div>	