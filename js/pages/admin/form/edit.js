$(function(){

	$('#search-page').keyup(function() 
   	{  
   		var namePage = $('#search-page').val();
		var availableTags = [];
		var availableIdTags = []; 

		$.ajax({            
	        type: 'POST',
	        url: 'edit',
	        dataType: "json",
	        data: {
	            action    : "search-page",
	            namePage : namePage,
	        },            
	        success: function(jsonObj) { 
	            //console.log('SUCESS');
	            //console.log(jsonObj);
                $.each(jsonObj, function(i, alObj) 
	            {                                        
	                availableTags.push({id : alObj.fx_page_id, label : alObj.title});   
	            });
	            console.log(availableTags);

                $("#search-page").autocomplete({ 
	                source: availableTags,
	                select: function(event, ui) {
	                	$(".prueba").val(ui.item.id);
	                	$("#search-page").val(ui.item.label);
	                	$("#page_id").val(ui.item.id);
	                }
	            });            
	        },
	        error:function(){
	            console.log("errpor...");
	        }
	    });
   	});

	$(".add-page").on( "click",  function() {
		var page_id = $('#page_id').val();
		var form_id = $(this).attr("form-id");
		if(page_id != "")
		{
			$.ajax({            
		        type: 'POST',
		        url: 'edit',
		        dataType: "json",
		        data: {
		            action    	: "add-page",
		            page_id 	: page_id,
		            form_id		: form_id,
		        },            
		        success: function(jsonObj) { 
		        	console.log(jsonObj);
		        	if(jsonObj["error"])
		        	{
		        		alert(jsonObj["error"]);
		        	}
		        	else{
		        		//console.log(jsonObj["data_page"]["title"]);	
		        		var html = '<tr>\
		        			<td>'+jsonObj["page_title"]+'</td>\
		        			<td>\
		        				<button data = '+jsonObj["fx_form_page_id"]+' data-target="#delete" data-toggle="modal" data-title="Delete" class="btn btn-danger btn-xs pull-right delete-title"><span class="glyphicon glyphicon-trash"></span></button>\
		        			</td>\
		        		</tr>';

		        		$('#form_table tr:last').after(html);
		        		//$('#form_table > tbody').append(html);
		        	}
		        },
		        error:function(){
		            console.log("errpor...");
		        }
		    });
	    }
	    else
	    {
	    	alert('Debe de seleccionar un título');
	    }
	});

	$("#form_table").on( "click",".delete-title", function() {
		//alert("delete");
		var el = $(this);
		var page_id = $(this).attr('page');
		var form_id = $("#form_table").attr('form');
		var form_page_id = $(this).attr('data');
		//alert(form_page_id);
		/*console.log("page_id="+page_id);
		console.log("form_id="+form_id);*/
		$.ajax({            
	        type: 'POST',
	        url: 'edit',
	        dataType: "json",
	        data: {
	            action    	: "delete-page",
	            page_id 	: page_id,
	            form_id		: form_id,
	            form_page_id: form_page_id,
	        },            
	        success: function(jsonObj) { 
	        	console.log(jsonObj);   
	        	console.log("DELETED");   
	        	//alert(el.attr('page'));    
	        	el.closest('tr').remove();
	        },
	        error:function(){
	            console.log("error...");
	        }
	    });
	});	
});