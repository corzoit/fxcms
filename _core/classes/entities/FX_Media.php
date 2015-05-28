<?php

class FX_Media extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_media", "fx_media_id");
	}

	public function __destruct(){}
	
	public function getMediaById($fx_media_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_media WHERE fx_media_id = ?", array($fx_media_id));
		return $data;
	}
}