//JQUERY CODE
$(function() { 	
    /* Change Language */
    $(".btn-language").click(function(){        
        var fx_sys_id = $(this).attr("data-id");
        console.log("fx_sys_id::"  + fx_sys_id);
        $.ajax({
            method : "POST",
            data   : {
                action      : "changeLanguage",
                fx_sys_id   : fx_sys_id
            },
            success: function(response){
                location.reload();
            }
        });
    });

	$("#button-reset").click(function(){
		$(".text-input").each(function(){
			console.log(this);
			$(this).val('');
		});
	});
	$(".menu-home").mouseover(function() {
		$('#image-home').attr("src", window.FX_BASE_DOMAIN + '/themes/images/homeover.png')
	});

	$(".menu-home").mouseout(function() {
		$('#image-home').attr("src", window.FX_BASE_DOMAIN + '/themes/images/home.png')
	});

  
    $(".btn-search").click(function(){        
        var $objDiv = $(this).parent();
        searchValue = $objDiv.find('select') && $objDiv.find('select').val() != undefined ? $objDiv.find('select').val() : $objDiv.find("input").length && $objDiv.find("input").attr("data") !== undefined ? $objDiv.find("input").attr("data"): $objDiv.find("input").val();
        actionSearch = $objDiv.find('select') && $objDiv.find('select').attr("id") != undefined ? $objDiv.find('select').attr('id') : $objDiv.find("input").length && $objDiv.find("input").attr("id") !== undefined ? $objDiv.find("input").attr("id"): '';    
        var fillDiv = "#contentDiv"                
        search(searchValue, actionSearch, fillDiv); 
        $objDiv.find("input").removeAttr("data", "");
    });


    // This is a maxItem response AUTOCOMPLETE    
    $.widget( "ui.autocomplete", $.ui.autocomplete, {
        options: {
            maxItems: 9999
        },
        _renderMenu: function( ul, items ) {
            var that = this,
                count = 0;
            $.each( items, function( index, item ) {
                if ( count < that.options.maxItems ) {
                    that._renderItemData( ul, item );
                }
                count++;
            });
        } 
    });

    // Not allowed to write to input (DateTime)
    $("#datetime_show").keydown(function(event) {
        event.preventDefault();
    });
    $("#datetime_hide").keydown(function(event) {
        event.preventDefault();
    });
    
    //Validating start and end date
    $("#datetime_show").on("dp.change",function (e) {
        $('#datetime_hide').data("DateTimePicker").minDate(e.date);
    });
    $("#datetime_hide").on("dp.change",function (e) {
        $('#datetime_show').data("DateTimePicker").maxDate(e.date);
    });

    //Formatting numerics inputs
    $("input[id='discount_per']").TouchSpin({
        min: 0,
        max: 100,
        step: 0.01,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%'
    });
     $("input[id='price']").TouchSpin({
        initval : 0,
        min: 0,
        max: 1000000000,
        stepinterval: 50,
        maxboostedstep: 10000000,
        prefix: '$'
    });
     $("input[id='stock']").TouchSpin({
        min: 0,
        max: 1000,
        initval : 0
    });
     $("input[id='discount_val']").TouchSpin({
        min: 0,
        max: 100,   
        initval: 0
    });

    //validate only numbers.
    $('#stock').numeric(false);
    $('#price').numeric();
    $('#discount_per').numeric();
    $('#discount_val').numeric();

    /* TINYMCE */
        tinymce.init({              
                mode : "specific_textareas",
                convert_urls : false,
                selector: "textarea.tinymce_add_page, textarea.tinymce_edit_page",             
                themes  : "modern",
                plugins : "image table code link",
                file_browser_callback : function (field_name, url, type, win) {                                 
                    var cmsURL       = window.FX_BASE_DOMAIN  + "admin/list/"; 
                    var searchString = window.location.search; // possible parameters
                    
                    tinyMCE.activeEditor.windowManager.open({
                        file            : cmsURL,
                        title           : 'Imagenes',
                        width           : 900,
                        height          : 650,
                        resizable       : "yes",
                        inline          : "yes",
                        close_previous  : "no"                   
                    },
                    {
                        window  : win,
                        input   : field_name                     
                    }); 
                    var win     = tinyMCEPopup.getWindowArg("window");

                    var input   = tinyMCEPopup.getWindowArg("input");                   
                    var res     = tinyMCEPopup.getWindowArg("resizable");

                    var inline  = tinyMCEPopup.getWindowArg("inline");          
                    return false;
                } 
            });
    /* END TINYMCE */

    /* PAGE GALERY */
        var $selectFolder = $("#btnSelectFolder");
        if($selectFolder.length)
        {               
            $("#btnSelectFolder").fancybox({'hideOnContentClick' :   false, 'showCloseButton' : true, 'modal': true}).trigger("click");  
            $selectFolder.click(function(){ 
                $(".list_images").html();               
                $selectFolder.hide();
            })
            $(".folderId, .btnCloseDefault").click(function(){
                var folder_name = $(this).attr("data-id");
                
                $(".language").val(folder_name);
                $.ajax({
                    type  : "POST",
                    cache : false,
                    data  : {
                        action : "showImages",
                        lang   : folder_name
                    },
                    success: function(response){
                        $(".list_images").html(response);
                    }
                });

                $.fancybox.close();
                $selectFolder.show();
            });    
        }
    /* END PAGE GALERY */

    /**/

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
                // var acceptFileTypes = /^(image|dfgfdgfdg)\/(gif|jpe?g|png)$/i;          
                //var acceptFileTypes =  /(\.|\/)(gif|jpe?g|png|pdf|vnd.ms-excel|vnd.openxmlformats-officedocument.wordprocessingml.document)$/i;
                var $language = $(".language");                
                var acceptFileTypes =  /(\.|\/)(gif|jpe?g|png|pdf|docx?|xlsx?|rar|zip)$/i;                
                acceptFileTypes = $language.length ? /(\.|\/)(gif|jpe?g|png)$/i : acceptFileTypes;

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
                    data.formData = { 'action' : 'uploadImage' , 'file_type' : file_type[1]};                    
                    var $language = $(".language");
                    if($language.length)
                    {
                        data.formData.folder_extra = $language.val();// Add Extra
                    }
                    
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
    /*   END FILEUPLOAD  */
        
});


/**
*   @Author        : Mario, Daniel, Lizandro
*   @Method        : Search
*   Values : {
*       searchValue : "value the input for search",
*       page        : "URL:PAGE example: tuwebsite.com/page",
*       action      : "Action for process the logic"
*       class       : "Element where the response was loaded "  ID, class, etc.         
*    }
**/

function search(searchValue, action, div)
{     
    $.ajax({            
        type: 'POST',
        data: {
            action : action,             
            search : searchValue                
        },            
        success: function(response) {                
            $(div).html(response);
            pagination_new(action, div, searchValue);
        },
        error:function(){
            console.log("errpor...");
        }
    });
}


function pagination_new(action, div, searchValue)
{
    $('.pagination_links').click(function(e){        
        var pag = $(this).text();
        var data = $(this).data('value');
        $.ajax({           
            type : 'POST',        
            data : {
                action  : action,
                num_pag : pag,
                data    : data,
                search  : searchValue
            },
        })
        .done(function(data) {
            //console.log(data);
            $(div).html(data);
            pagination_new(action, div, searchValue);  
        })
        .fail(function() {
            console.log("error");
        });
        e.preventDefault();                
    });
}

function deleteRecord(KeyId, field, action, msg, keySearch, actionSearch, div_search, otherDivMsg)
{
    bootbox.confirm(msg, function(result) {
        if(result){
            var keyId = KeyId.split("_");
            $.ajax({
                url : "",
                type: 'POST',
                data: {
                    action : action,
                    id     : keyId[1],
                    field  : field,
                },
                success: function(response)
                {
                    $(otherDivMsg).remove();
                    $('#msg').html('<div class="alert alert-success">'+response+'</div>').hide().fadeIn(1000);
                    //search('', 'content_manager_keyword', '#content-manager');    
                    search(keySearch, actionSearch, div_search);    
                    //document.location = "";   
                },
                error:function(response){
                    console.log(response)     
                }
            });
        }
   }); 
}