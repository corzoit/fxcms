<?php

class FX_FormField extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_field", "fx_form_field_id");
	}

	public function __destruct(){}
	
	public function getFormFieldById($fx_form_field_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_field WHERE fx_form_field_id = ?", array($fx_form_field_id));
		return $data;
	}

	public function getFieldCount($form_id)
	{
		$data = $this->conn->fetchAssoc("SELECT COUNT(*) AS count FROM fx_form_field WHERE fx_form_id = ?", array($form_id));
		return $data;
	}

	public function getFieldAllbyForm($form_id, $limit)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_form_field WHERE fx_form_id = ? ORDER BY fx_form_field_id DESC $limit", array($form_id));
		return $data;
	}


}