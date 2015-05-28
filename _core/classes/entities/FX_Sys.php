<?php

class FX_Sys extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fxsys", "fxsys_id");
	}

	public function __destruct(){}
	
	public function getSysById($fxsys_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fxsys WHERE fxsys_id = ? AND status=1", array($fxsys_id));
		return $data;
	}

	public function getSysAllByStatus()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fxsys WHERE status=1");
		return $data;	
	}
}