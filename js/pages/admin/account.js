$( function(){

	$('#change').change(function(){
	    var c = this.value == '1' ? 'yes' : 'no';

	    if(c == 'yes') {
	    	$("#div_password").css("display","block");
            $("input[name=password]").prop('value', '');
            $("input[name=password]").prop('disabled', false);
	    }
	    else {
            $("#div_password").css("display","none");
            $("input[name=password]").prop('disabled', true);
	    	
	    }
	});
	
    search('', 'user_log', '#content-userlog');
});



function change_account(data)
{
	$.ajax({
        url : "",
        type: 'POST',
        dataType:"json",
        data: {
            action : 'change_account',
            data : data,
        },
        success: function(response)
        {             
        	if(response.error) {
        		$('#view_error').html('<div class="alert alert-danger">'+response.error+'</div>').hide().fadeIn(1000);	
        	}
        	else if(response.success) {
        		$('#view_error').html('<div class="alert alert-success">'+response.success+'</div>').hide().fadeIn(1000);		                   	
        		if(response.username.length > 0) {
            		$('#usename').fadeOut(1000, function(){
            			$('#usename').html('<i class="fa fa-user"></i> '+response.username+' <b class="caret"></b>').fadeIn(1000);
            		});
        		}
        	}   
        },
        error:function(response)
        {
            console.log(response)     
        }
    });
}
