<?php

class FX_PageLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_page_lang", "fx_page_lang_id");
	}

	public function __destruct(){}
	
	public function getPageLangById($fx_page_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_page_lang WHERE fx_page_lang_id = ?", array($fx_page_lang_id));
		return $data;
	}

	public function getPageLangByPageId($fx_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_page_lang WHERE fx_page_id = ?", array($fx_page_id));
		return $data;
	}
}