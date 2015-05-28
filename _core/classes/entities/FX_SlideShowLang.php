<?php

class FX_SlideShowLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_slideshow_lang", "fx_slideshow_lang_id");
	}

	public function __destruct(){}
	
	public function getSlideShowLangById($fx_slideshow_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow_lang WHERE fx_slideshow_lang_id = ?", array($fx_slideshow_lang_id));
		return $data;
	}
	public function getSsLangBySsIdAndLang($fx_slideshow_id, $language)
	{
		$data = $this->conn->fetchAssoc(
			"SELECT * FROM fx_slideshow_lang 
				WHERE fx_slideshow_id = ? and lang = ?",
			array($fx_slideshow_id, $language));
		return $data;
	}

	public function getSslIdByssIdAndLang($fx_slideshow_id, $language)
	{
		
	}
}