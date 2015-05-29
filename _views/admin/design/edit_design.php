<p class="text-danger"><?=count($data_design)?'Not Editable..!': ''?></p>
<input id="design_id" type="hidden" name="design_id" value="<?=$data_design['fx_design_id']?>" >
<input id="design_name" type="hidden" name="design_id" value="<?=$data_design['name']?>" >
<div class="a-main-container" >
    <?php 
    if(count($data_design))
    {
        echo($data_design['html_content']);
    }
    ?>
</div>

<p></p>
<button class="btn btn-primary">Save</button>
<a href="" onclick="window.close();" class="btn btn-warning">Close</a>


<script type="text/javascript">
	var $contentMain = $(".a-main-container");
	var $divs = $contentMain.find("div");
	var idsWidget;
	
	$.each($divs, function(i, val){		
		if($(this).hasClass("a-widget"))
		{			
			idsWidget = "#"+$(this).attr("id");									
			$(idsWidget).find("div").remove();
			$(idsWidget).resizable();			
		}				
	});		



$("button").click(function(){        
    var $objMainContainer = $(".a-main-container");
    var design_id = $("#design_id").length == 0 ? "vacioID" : $("#design_id").val();
    var design_name = $("#design_name").length == 0 ? "vacioName" : $("#design_name").val(); 
    
    if($objMainContainer.length)
    {               
        var $divsH = $objMainContainer.children("div");                      
        if($divsH.length) 
        {     
   
            swal({   
                title: "Save Design?",   
                text: "Write design name:",   
                type: "input",                 
                closeOnConfirm: false,
                showCancelButton: true,                      
                animation: "slide-from-top",
                inputType: "text",
                inputValue: design_name,                                             
            },           
            function(inputValue){
                if (inputValue === false) return false;
                if (inputValue === "") 
                {    
                    swal.showInputError("You need to write the design name!");     
                    return false   
                } 
                console.log($objMainContainer.html());
                $.ajax({
                    method   : "POST",
                    dataType : "json",
                    data     : {
                        "action"         : "saveDesign",
                        "design_id"		 : design_id,
                        "name"           : inputValue.toLowerCase(),
                        "html_content"   : $objMainContainer.html()
                    },
                    success: function(response)
                    {                    	
                        if(response.success == true)
                        {
                            swal("Nice!", "You wrote: " + inputValue, "success");
                            // inputValue.toLowerCase().replace(/\b[a-z]/g, function(letter) { return letter.toUpperCase(); });                               
                        }
                        else
                        {
                            swal("Oops...", "Something went wrong! \n Try again with other name", "error");
                        }                        
                    }
                });
                
            });                                                  
        }           
    }
});        













</script>

