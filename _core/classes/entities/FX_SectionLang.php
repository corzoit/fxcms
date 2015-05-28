<?php

class FX_SectionLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_section_lang", "fx_menu_lang_id");
	}

	public function __destruct(){}
	
	public function getSectionLangById($fx_menu_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_section_lang WHERE fx_menu_lang_id = ?", array($fx_menu_lang_id));
		return $data;
	}
	public function getAllSectionLangBySectionId($fx_section_id, $language)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM 
			fx_section_lang WHERE fx_section_id = ? AND lang = ?",
			array($fx_section_id, $language));
		return $data;	
	}

	public function updateSectionBySectionId($data, $fx_section_id)
	{
		$data = $this->conn->update('fx_section_lang',$data,array('fx_section_id'=> $fx_section_id));
		return $data;
	}
}