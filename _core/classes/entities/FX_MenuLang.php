<?php

class FX_MenuLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_menu_lang", "fx_menu_lang_id");
	}

	public function __destruct(){}
	
	public function getMenuLangById($fx_menu_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_menu_lang WHERE fx_menu_lang_id = ?", array($fx_menu_lang_id));
		return $data;
	}
	public function insert($data)
	{
		$this->conn->insert('fx_menu_lang',$data);
		$new_id = $this->conn->lastInsertId();
	}
}