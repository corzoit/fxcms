<?php

class FX_OrderLine extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_order_line", "fx_order_line_id");
	}

	public function __destruct(){}
	
	public function getOrderLineById($fx_order_line_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_order_line WHERE fx_order_line_id = ?", array($fx_order_line_id));
		return $data;
	}
}