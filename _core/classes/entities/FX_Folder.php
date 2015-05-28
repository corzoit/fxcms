<?php

class FX_Folder extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_folder", "fx_folder_id");
	}

	public function __destruct(){}
	
	public function getFolderById($fx_folder_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_folder WHERE fx_folder_id = ?", array($fx_folder_id));
		return $data;
	}

	public function getFolderByOwnerld($owner_id, $all_levels = true)
	{
		$response = array();
		$data_folder = $this->conn->fetchAll("SELECT * FROM fx_folder WHERE owner_id = ? AND deleted = 0", array($owner_id));						
		if($data_folder && count($data_folder)>0)
		{
			if($all_levels)
			{											
				foreach ($data_folder as $key_data_folder => $value_data_folder)
				{
					$return_sub_file = $this->getFolderByOwnerld($value_data_folder['fx_folder_id'],$all_levels);
					$value_data_folder['fx_sub_file'] = $return_sub_file;
					array_push($response,$value_data_folder);
				}					
			}
			else
			{
				$response = $data_folder;
			}
		}				
		return $response;
	}
}