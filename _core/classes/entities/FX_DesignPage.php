<?php

class FX_DesignPage extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_design_page", "fx_design_page_id");
	}

	public function __destruct(){}
	
	public function getDesignPageId($fx_design_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_design_page WHERE fx_design_page_id = ?", array($fx_design_page_id));
		return $data;
	}
}