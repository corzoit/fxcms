<?php

class FX_FormAnswer extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_answer", "fx_form_answer_id");
	}

	public function __destruct(){}
	
	public function getFormAnswerById($fx_form_answer_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_answer WHERE fx_form_answer_id = ?", array($fx_form_answer_id));
		return $data;
	}

	public function getFormAnswerAll()
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_answer");
		return $data;	
	}
}