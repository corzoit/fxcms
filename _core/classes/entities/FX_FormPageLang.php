<?php

class FX_FormPageLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_page_lang", "fx_form_page_lang_id");
	}

	public function __destruct(){}
	
	public function getFormPageLangById($fx_form_page_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_page_lang WHERE fx_form_page_lang_id = ?", array($fx_form_page_lang_id));
		return $data;
	}
}