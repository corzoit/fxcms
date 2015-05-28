<?php

class FX_Order extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_order", "fx_order_id");
	}

	public function __destruct(){}
	
	public function getOrderById($fx_order_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_order WHERE fx_order_id = ?", array($fx_order_id));
		return $data;
	}

	public function getLatestOrders($limit = 5)
	{
		$query = "SELECT o.comments, o.creation_dt, c.first_name
				FROM `fx_order` o
					INNER JOIN fx_contact c ON o.fx_contact_id = c.fx_contact_id
					ORDER BY o.creation_dt DESC
					LIMIT $limit ";
		$data = $this->conn->fetchAll($query);
		return $data;
	}
}