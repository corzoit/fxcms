<?php

class FX_Design extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_design", "fx_design_id");
	}

	public function __destruct(){}
	
	public function getDesignById($fx_design_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_design WHERE fx_design_id = ?", array($fx_design_id));
		return $data;
	}	
}