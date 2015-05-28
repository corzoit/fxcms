<?php

class FX_AuthorLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_author_lang", "fx_author_lang_id");
	}

	public function __destruct(){}
	
	public function getAuthorLangById($fx_author_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_author_lang WHERE fx_author_lang_id = ?", array($fx_author_lang_id));
		return $data;
	}
}