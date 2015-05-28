<?php

class FX_Product extends FX_BasicCRUD{ 

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_product", "fx_product_id");
	}

	public function __destruct(){}
	
	public function getProductById($fx_product_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_product WHERE fx_product_id = ?", array($fx_product_id));
		return $data;
	}
}