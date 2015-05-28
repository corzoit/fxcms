<?php

class FX_FormFieldAnswer extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_field_answer", "fx_form_field_answer_id");
	}

	public function __destruct(){}
	
	public function getFormFieldAnswerById($fx_form_field_answer_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_field_answer WHERE fx_form_field_answer_id = ?", array($fx_form_field_answer_id));
		return $data;
	}
}