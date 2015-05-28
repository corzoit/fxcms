<div class="row">
	<div class="col-sm-8">
		<h3>Galeria</h3>	
		<div class="alert alert-danger" style="display:none" class="files">
		</div>				
		<span>
			<b>Cargar</b>
		</span>
	    <span class="btn btn-success fileinput-button">
	        <i class="glyphicon glyphicon-plus"></i>
	        <span>Select files...</span>
	        <input class="fileupload" type="file" name="files[]" multiple>
	    </span>
	    <br>
	    <br>
	    <div style="display:none" class="progress">
	        <div id="div_progress" class="progress-bar progress-bar-success"></div>
	 	</div>					
	</div>
</div>

<div class="list_images">
	<?			
	foreach ($data_media as $key_dt_media => $value_dt_media) 
	{
		if(preg_match($exp_1 ,$value_dt_media['file']))
		{
			$fx_folder_id = $sub_folder[0]['fx_folder_id'];
			$folder = "file/repository/".$data_folder['name']."/".$sub_folder[0]['name']."/";			
			$file_img = true;
		}
		elseif(preg_match($exp_2 ,$value_dt_media['file']))
		{			
			$fx_folder_id = $sub_folder[1]['fx_folder_id'];
			$folder = "file/repository/".$data_folder['name']."/".$sub_folder[1]['name']."/";				
			$file_img = false;
		}		
		if(file_exists($folder.$value_dt_media['file']))
		{			
			$path_file = FX_System::url($folder);
			if($file_img )
			{
				$html_img .= "<a href=".$path_file.$value_dt_media['file']." target='_blank'><img style='padding:10px' width='185px' height='180px' class='img-responsive img' src='".$path_file.$value_dt_media['file']."'/></a>";	
			}
			else
			{
				$html_img .= "<p><a href=".$path_file.$value_dt_media['file']." target='_blank'>".$value_dt_media['file']."</a></p>";		
			}
					
		}				
	}
	echo($html_img);

	?>
</div>
