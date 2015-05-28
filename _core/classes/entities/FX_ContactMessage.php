<?php

class FX_ContactMessage extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_contact_message", "fx_contact_message_id");
	}

	public function __destruct(){}
	
	public function getContactMessageById($fx_contact_message_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_contact_message WHERE fx_contact_message_id = ?", array($fx_contact_message_id));
		return $data;
	}

	public function getNewestContactMessages($limit = 5)
	{
		$query = "SELECT * FROM `fx_contact_message` cm INNER JOIN fx_contact c ON cm.fx_contact_id = c.fx_contact_id				
					ORDER BY cm.creation_dt DESC
					LIMIT $limit ";			
		$data = $this->conn->fetchAll($query);
		return $data;
	}

	public function getContactMessageByOwnerld($owner_id, $all_levels = false)
	{
		$response = array();
		$data_contact_message = $this->conn->fetchAll("SELECT * FROM fx_contact_message WHERE owner_id = ? AND deleted = 0", array($owner_id));						
		if($data_contact_message && count($data_contact_message)>0)
		{
			if($all_levels)
			{											
				foreach ($data_contact_message as $key_contact_message => $value_contact_message)
				{
					$return_sub_contact_msg = $this->getContactMessageByOwnerld($value_contact_message['fx_contact_message_id'],$all_levels);
					$value_contact_message['fx_sub_contact_message'] = $return_sub_contact_msg;
					array_push($response,$value_contact_message);
				}					
			}
			else
			{
				$response = $data_contact_message;
			}
		}				
		return $response;
	}

	public function getContactMessageAll($search = "" , $limit = 15)
	{
		$where = " ";		
		if(strlen(trim($search)))
		{
			$where = " AND cm.subject LIKE :q OR cm.message LIKE :q ";	
		}
		
		$query = "SELECT cm.fx_contact_message_id, CONCAT(c.last_name,', ', c.first_name) AS name, cm.creation_dt, cm.subject, cm.message FROM fx_contact_message cm 
					INNER JOIN fx_contact c on cm.fx_contact_id = c.fx_contact_id WHERE cm.deleted =0 ". $where ." ORDER BY cm.creation_dt DESC ". $limit;
		$params = array('q' => '%'.$search.'%');				
		$data = $this->conn->fetchAll($query, $params);
		return $data;
	}

	public function contactMessageCount()
	{
		$data = $this->conn->fetchColumn("SELECT COUNT(*) AS total FROM fx_contact_message");
		return $data;
	}

	public function updateContactMessage($fx_contact_message_id, $data)// Update column delete = 1 
	{
		$data = $this->conn->update("fx_contact_message", $data ,array("fx_contact_message_id"=>$fx_contact_message_id));
		return $data;
	}


}