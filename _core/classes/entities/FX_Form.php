<?php

class FX_Form extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form", "fx_form_id");
	}

	public function __destruct(){}
	
	public function getFormById($fx_form_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form WHERE fx_form_id = ?", array($fx_form_id));
		return $data;
	}

	/*public function insert($data)
	{
		$this->conn->insert('fx_form', $data);
	}*/

	public function getPageCountBySearch($keyword)
	{
		$data = $this->conn->fetchColumn("SELECT COUNT(*) AS count FROM fx_form WHERE deleted = 0 AND 
			(title LIKE '%$keyword%' OR intro LIKE '%$keyword%')");
		return $data;
	}

	public function getPageByKeyword($keyword, $limit)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_form WHERE deleted = 0 AND 
			(title LIKE '%$keyword%' OR intro LIKE '%$keyword%') $limit");
		return $data;
	}
}