<?php

class FX_PageFile extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_page_file", "fx_page_file_id");
	}

	public function __destruct(){}
	
}