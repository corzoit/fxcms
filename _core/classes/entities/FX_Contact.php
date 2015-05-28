<?php

class FX_Contact extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_contact", "fx_contact_id");
	}

	public function __destruct(){}
	
	public function getContactById($fx_contact_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_contact WHERE fx_contact_id = ?", array($fx_contact_id));
		return $data;
	}

	public function getContactAll($search = "" ,$limit = 15)
	{		
		$where = " ";		
		if(strlen(trim($search)))
		{
			$where = " AND (first_name
					LIKE :q OR last_name LIKE :q OR email LIKE :q OR business LIKE :q 
					OR phone LIKE :q OR mobile LIKE :q OR address LIKE :q OR country LIKE :q) ";	
		}
		$query = "SELECT * FROM fx_contact WHERE deleted = 0 ".$where." ORDER BY creation_dt DESC ".$limit;
		$params = array('q' => '%'.$search.'%');
		$data = $this->conn->fetchAll($query, $params);
		return $data;

	}

	public function getContactCountBySearch($search)
	{		
		$where = " ";		
		if(strlen(trim($search)))
		{
			$where = " AND (first_name
					LIKE :q OR last_name LIKE :q OR email LIKE :q OR business LIKE :q 
					OR phone LIKE :q OR mobile LIKE :q OR address LIKE :q OR country LIKE :q)";	
		}
		$query = "SELECT COUNT(*) AS count FROM fx_contact WHERE deleted = 0 ".$where;
		$params = array('q' => '%'.$search.'%');
		$data = $this->conn->fetchAssoc($query, $params);
		return $data;

	}

	public function updateContact($fx_contact_id, $data)// Update column delete = 1 
	{
		$data = $this->conn->update("fx_contact", $data ,array("fx_contact_id"=>$fx_contact_id));
		return $data;
	}

	
	public function insertContact($data)
	{
		$this->conn->insert('fx_contact', $data);
		$new_id = $this->conn->lastInsertId();
		return $new_id;
	}

	public function getContactByEmail($email)
	{		
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_contact WHERE email = ?", array($email));
		return $data;
	}
	

}
