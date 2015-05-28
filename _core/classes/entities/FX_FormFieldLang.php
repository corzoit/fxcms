<?php

class FX_FormFieldLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_field_lang", "fx_form_field_lang_id");
	}

	public function __destruct(){}
	
	public function getFormFieldLangById($fx_form_field_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_field_lang WHERE fx_form_field_lang_id = ?", array($fx_form_field_lang_id));
		return $data;
	}
}