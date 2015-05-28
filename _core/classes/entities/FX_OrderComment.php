<?php

class FX_OrderComment extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_order_comment", "fx_order_comment_id");
	}

	public function __destruct(){}
	
	public function getOrderCommentById($fx_order_comment_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_order_comment WHERE fx_order_comment_id = ?", array($fx_order_comment_id));
		return $data;
	}
}