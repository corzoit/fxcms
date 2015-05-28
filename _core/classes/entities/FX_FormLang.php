<?php

class FX_FormLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_lang", "fx_form_lang_id");
	}

	public function __destruct(){}
	
	public function getFormLangById($fx_form_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_lang WHERE fx_form_lang_id = ?", array($fx_form_lang_id));
		return $data;
	}
	public function getFormLangByFormId($fx_form_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_lang WHERE fx_form_id = ?", array($fx_form_id));
		return $data;	
	}
	public function getFormLangByFormIdAndLang($fx_form_id, $lang)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_lang WHERE fx_form_id = ? and lang = ?", array($fx_form_id, $lang));
		return $data;	
	}
}