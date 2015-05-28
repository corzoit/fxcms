<?php
define ("FX_TEMPLATE","admin.php"); 

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
//$upload_handler = new UploadHandler();

// $options = array(
//     'delete_type' => 'POST',
//     'db_host' => 'localhost',
//     'db_user' => 'root',
//     'db_pass' => '',
//     'db_name' => 'example',
//     'db_table' => 'files'
// );

class CustomUploadHandler extends UploadHandler {


    // protected function initialize() {
    //     $this->db = new mysqli(
    //         $this->options['db_host'],
    //         $this->options['db_user'],
    //         $this->options['db_pass'],
    //         $this->options['db_name']
    //     );
    //     parent::initialize();
    //     $this->db->close();
    // }

    // protected function handle_form_data($file, $index) {
    //     $file->title = @$_REQUEST['title'][$index];
    //     $file->description = @$_REQUEST['description'][$index];
    // }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = parent::handle_file_upload(
            $uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {
            $obj_media = new FX_Media();
            // $sql = 'INSERT INTO `'.$this->options['db_table']
            //     .'` (`name`, `size`, `type`, `title`, `description`)'
            //     .' VALUES (?, ?, ?, ?, ?)';
            // $query = $this->db->prepare($sql);
            // $query->bind_param(
            //     'sisss',
            //     $file->name,
            //     $file->size,
            //     $file->type,
            //     $file->title,
            //     $file->description
            // );
            // $query->execute();
            // $file->id = $this->db->insert_id;
            //echo $file->size;
            $data = array('fx_folder_id' => 1,
                          'title' => $file->name,
                          'file' => $file->name,
                          'file_type' => $file->type,
                          'size_kb' => $file->size/1024
                         );
            $obj_media->insert($data);
        }
        $route_image = FX_System::url('file/img/media/'.$file->name);

        $file->html = "<img style='padding:10px' class='img' width='185px' height='180px' class='img-responsive' src='$route_image'>";
        return $file;
        exit();
        
    }

    // protected function set_additional_file_properties($file) {
    //     parent::set_additional_file_properties($file);
    //     if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //         $sql = 'SELECT `id`, `type`, `title`, `description` FROM `'
    //             .$this->options['db_table'].'` WHERE `name`=?';
    //         $query = $this->db->prepare($sql);
    //         $query->bind_param('s', $file->name);
    //         $query->execute();
    //         $query->bind_result(
    //             $id,
    //             $type,
    //             $title,
    //             $description
    //         );
    //         while ($query->fetch()) {
    //             $file->id = $id;
    //             $file->type = $type;
    //             $file->title = $title;
    //             $file->description = $description;
    //         }
    //     }
    // }

    // public function delete($print_response = true) {
    //     $response = parent::delete(false);
    //     foreach ($response as $name => $deleted) {
    //         if ($deleted) {
    //             $sql = 'DELETE FROM `'
    //                 .$this->options['db_table'].'` WHERE `name`=?';
    //             $query = $this->db->prepare($sql);
    //             $query->bind_param('s', $name);
    //             $query->execute();
    //         }
    //     } 
    //     return $this->generate_response($response, $print_response);
    // }

}

$upload_handler = new CustomUploadHandler();


exit();