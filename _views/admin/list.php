
<div class="container">
    <div class="alert alert-danger" style="display:none" class="files"></div>
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
        <input class="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <div style="display:none" id="progress" class="progress">
        <div id="div_progress" class="progress-bar progress-bar-success"></div>
    </div>
</div>

<div class="list_images">
    <?php    
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
                $html_img .= "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='".$path_file.$value_dt_media['file']."'/>";                 
            }                    
        }               
    }
    echo($html_img);

    ?>
</div>

<script type="text/javascript">   
    /* FILEUPLOAD PLUGIN */
        selectImgURL();
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
                        $(".progress").css({'display':'none'});
                    }
                    else //success
                    {                                           
                        $(".files").html('').css({'display':'none'});
                        $(".files").removeClass('alert-danger').addClass('alert-success').html('The image was uploaded correctly').css({'display':'block'});                        
                        var file_src_img = file.url;
                        var html_img = "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='"+file_src_img+"'>";
                        $('.list_images').prepend($.parseHTML(html_img));                        
                        $(".progress").css({'display':'block'});
                    }                               
                });
                selectImgURL();
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
    function selectImgURL()
    {
        $('.img').click(function(event){      
            var selectedImage   = $(this).attr('src');
            var win                 = tinyMCEPopup.getWindowArg("window");
            var dialogueBoxObject   = win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = selectedImage;
            tinyMCE.activeEditor.windowManager.close();
        });
    }
</script>