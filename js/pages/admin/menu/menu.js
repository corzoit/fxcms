$(function(){
	/* Add Menu */
		$(".add-menu").click(function() {
			$(".add-menu").fancybox({                        
	            'type'		: 'ajax',	            
	            'fitToView' : false,
	            'autoSize'	: true,    	            
	            helpers     : { 
			        overlay : {closeClick: false} 
			    },                
	            ajax: {
	                type : "POST",
	                data : {
		                action : "form-menu",
	    			},            
	            },
	            onStart     :   function() {                
	                $(this).css('border','1px red solid')
	            },                    
	        });
		});
	/* End Add Menu */

	/* Save Position Menu */
		$(".save-position").click(function() 
		{	
			//alert();
			success = $(this).attr("success");

			$(".dd").each(function(item) {
				serialize = $(".menu"+item).nestable('serialize');
				var menu_id = $(".menu"+item).attr('menu-id');

				$.ajax({
				    type: 'POST',
				    data: {
		                action    : "save-order-menu",    		
		                serialize : serialize,
		                menu_id   :	menu_id,   			
		    		},  
				    success: function(jsonObj) {
				    	//document.location = ""; 
				    	console.log('success');

				    	html = "<div class = 'alert alert-success' style = 'margin-bottom: 0px !important'>";
		                html += success;
		                html += "</div>";
		                $(".content-error-main").html(html);

		                $(".content-error-main").fadeTo(2000, 500).slideUp(500, function(){});
				    },
				    error:function(){
				        console.log("error...");
				    }
				});
			});
		});
	/* End Position Menu */

	/* Delete Menu */
		$(".delete-menu").click(function() {			
			var menu_id  = $(this).attr("data");			
			if(confirm("realmente desea eliminar toda la clase"))
			{
				$.ajax({
				    type: 'POST',
				    data: {
		                action    : "delete-menu",    		
		                menu_id   :	menu_id,   			
		    		},  
				    success: function(jsonObj) 
				    {
				    	//console.log('success');
				    	location.reload();
				    },
				    error:function(){
				        console.log("error...");
				    }
				});		
			}
		});
	/* End Delete Menu */

	/* Add Section Menu  */
		$(".add-section-menu").click(function() {
			var menu_id = $(this).attr('data');
			$(".add-section-menu").fancybox({                        
	            'width'  : 400,       
		        'height' : 'auto',                      
		        'type': 'ajax',
		        'fitToView': false,
		        'autoSize': false, 
		        'scrolling'   : 'no', 
	            helpers     : { 
			        overlay : {closeClick: false} 
			    },                  
	            ajax : {
	                type    : "POST",
	                data: {
		                action    : "add-section-menu",   
		                menu_id   :	menu_id,     		
	    			},            
	            },
	            onStart     :   function() {                
	                $(this).css('border','1px red solid')
	            },                    
	        });
		});
	/* End Section Menu */

	
	/* Add Section by Section */
		$(".section-add").click(function() {
			var section_id = $(this).attr('data');

			$(".section-add").fancybox({                        
	            'width'  : 400, 
		        'height' : 'auto',                      
		        'type': 'ajax',
		        'fitToView': false,
		        'autoSize': false, 
		        'scrolling'   : 'no',        
	            helpers     : { 
			        overlay : {closeClick: false} 
			    },          
	            ajax : {
	                type    : "POST",
	                data: {
		                action    : "section-add",   
		                section_id:	section_id,     		
	    			},            
	            },
	            onStart     :   function() {                
	                $(this).css('border','1px red solid')
	            },                    
	        });
		});
	/* End */

	$(".edit-section").click(function() {
		//alert();
		var section_id = $(this).attr('data');
		$(".edit-section").fancybox({                        
            'width'  : 400,       
	        'height' : 'auto',                      
	        'type': 'ajax',
	        'fitToView': false,
	        'autoSize': false, 
	        'scrolling'   : 'no',               
            helpers     : { 
		        overlay : {closeClick: false} 
		    },   
            ajax : {
                type    : "POST",
                data: {
	                action    : "edit-section", 
	                section_id:	section_id,       		
    			},            
            },
            onStart     :   function() {                
                $(this).css('border','1px red solid')
            },                    
        });
	});

	$(".delete-section").click(function(e) {
		//e.stopPropagation();
		var section_id = $(this).attr('data');
		//alert('section_id='+section_id);
		
		if (confirm("Realmente desea eliminar")) 
		{
			$.ajax(
			{
				type: 'POST',
				data: {
					action		: 'delete_section',
					section_id  : section_id
				},
				success: function(response)
				{
					document.location = ""; 
					//console.log('SUCESS');
				},
				error:function(response)
				{
					console.log('error');
				}
			});
		}	
	});

	$('.dd').nestable({ maxDepth : 10 });
	//submit 
})
