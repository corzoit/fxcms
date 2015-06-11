$(function(){	
	/* PAGE GALERY */
        var $selectFolder = $("#btnSelectFolder");
        if($selectFolder.length)
        {               
            $("#btnSelectFolder").fancybox({
            	scrolling   : 'no',	                   
	            fitToView   : true,
	            width       : '50%',	            
	            autoSize    : false,
            	'hideOnContentClick' :   false,
            	'showCloseButton' : true, 
            	'modal': true
            }).trigger("click");  

            $selectFolder.click(function(){ 
                //$(".list_images").html();               
                $selectFolder.hide();
            })
            $(".folderId, .btnCloseDefault").click(function(){
                var folder_name = $(this).attr("data-id");
                
                $("#language").val(folder_name);
                $.ajax({
                    type  : "POST",
                    cache : false,
                    data  : {
                        action : "showImages",
                        lang   : folder_name
                    },
                    success: function(response){
                        console.log(response);
                        $(".list_images").html(response);
                    }
                });

                $.fancybox.close();
                $selectFolder.show();
            });    
        }
    /* END PAGE GALERY */

	/* FILEUPLOAD PLUGIN */
        var url = ''; 
        $('.fileupload').fileupload({               
            url :   url,    
            dataType: 'json',
            formData: [
                { name : 'action' , value : "uploadImage" }                 
            ],
            add : function(e, data){                        
                var uploadErrors = [];                               
                var acceptFileTypes =  /(\.|\/)(gif|jpe?g|png|pdf|docx?|xlsx?|rar|zip)$/i;                
                var $idCallType = $("#idCallType");
                var folder_extra = $("#language").length? $("#language").val() : "";
                acceptFileTypes = ($idCallType.val() == "page" || $idCallType.val() == "tiny") ? /(\.|\/)(gif|jpe?g|png)$/i : acceptFileTypes; 
                
                if(data.originalFiles[0]['name'].length && !acceptFileTypes.test(data.originalFiles[0]['name'])) {
                    uploadErrors.push('Not an accepted file type');
                }
                if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                    uploadErrors.push('Filesize is too big');
                }
                if(uploadErrors.length > 0) {
                    alert(uploadErrors.join("\n"));
                } else {                	
                    var name_file = data.originalFiles[0]['name'];
                    var file_type = name_file.split(".");
                    data.formData = { 'action' : 'uploadImage' , 'file_type' : file_type[1], 'folder_extra':folder_extra , 'name': data.originalFiles[0]['name'] };
                    data.submit();                                                       
                }
            },     
            done: function (e, data) {              
                $.each(data.result.files, function (index, file) {
                    if(file.error) {
                        $("#files").removeClass('alert-success').addClass('alert-danger').html(file.error).css({'display':'block'});
                        $("#progress").css({'display':'none'});
                    }
                    else //success
                    {                                           
                        $(".files").html('').css({'display':'none'});
                        $(".files").removeClass('alert-danger').addClass('alert-success').html('The image was uploaded correctly').css({'display':'block'});
                        $('.list_images').prepend($.parseHTML(file.html));
                        $(".progress").css({'display':'block'});
                    } 
                    getValueSrc(); // Get Val src                               
                });                	
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('.progress .progress-bar').css(
                    'width',
                    progress + '%'
                );

            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    /* END FILEUPLOAD  */
    
    getValueSrc(); // Get Val src

    /* SHOW VALUE IN INPUT TINYMCE*/
    function getValueSrc()
    {        
    	$('.img').click(function(event){			
	        var selectedImage   = $(this).attr('src');
	        var win                 = tinyMCEPopup.getWindowArg("window");
	        var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedImage;
	        tinyMCE.activeEditor.windowManager.close();
	    });
    }
    	
    /**/
});