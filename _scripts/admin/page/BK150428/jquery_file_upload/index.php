<?php
define ("FX_TEMPLATE","admin.php"); 

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

    function __construct(){        
        if($_REQUEST)
        {                
            $options = array(            
            "entities" => $_REQUEST['entities'], 
            "fx_page_id" => $_REQUEST['fx_page_id']);
            parent::__construct($_REQUEST['ruta'],$options);
        }    
        else{
            parent::__construct();    
        }            
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );

        $fx_page_id = "";
        $obj_entities = "";
        $path = $this->options['upload_url'];
        if (empty($file->error)) {
            if(array_key_exists("entities", $this->options) )
            {
                $obj_entities = $this->options['entities']?$this->options['entities']:'';
            }            
            if(array_key_exists("fx_page_id", $this->options) )
            {
                $fx_page_id = $this->options['fx_page_id']?$this->options['fx_page_id']:'';
            }            
            
            $this->insertFileToEntiti($file,$fx_page_id,trim($obj_entities),$path);    
        }
        //$route_image = FX_System::url('file/img/media/'.$file->name);

        $file->html = "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='".$path.$file->name."'>";
        return $file;
        exit();
        
    }

     public function insertFileToEntiti($file,$fx_page_id,$obj,$path)
    {
        switch ($obj) {
            case "FX_Page":
                $obj_page_file = new FX_PageFile();                
                $data = array(
                    "fx_page_id" => $fx_page_id,
                    'folder'     => $path,
                    'file'       => $file->name
                    );
                $obj_page_file->insert($data);
               
                break;
            default:
                $obj_media = new FX_Media();
                $data = array('fx_folder_id' => 1,
                          'title' => $file->name,
                          'file' => $file->name,
                          'file_type' => $file->type,
                          'size_kb' => $file->size/1024
                    );
                $a = $obj_media->insert($data);             
        }
    }
}

$upload_handler = new CustomUploadHandler();

exit();