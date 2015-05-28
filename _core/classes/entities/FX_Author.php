<?php

class FX_Author extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_author", "fx_author_id");
	}

	public function __destruct(){}
	
	public function getAuthorById($fx_author_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_author WHERE fx_author_id = ?", array($fx_author_id));
		return $data;
	}
}