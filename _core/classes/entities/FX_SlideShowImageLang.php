<?php

class FX_SlideShowImageLang extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_slideshow_image_lang", "fx_slideshow_image_lang_id");
	}

	public function __destruct(){}
	
	/*public function getSlideShowById($fx_slideshow_lang_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow_image WHERE fx_slideshow_lang_id = ?", array($fx_slideshow_lang_id));
		return $data;
	}*/
	public function getSlideShowImageLangBySlideShowImageId($fx_slideshow_image_id, $language)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow_image_lang WHERE fx_slideshow_image_id = ? AND lang = ?", array($fx_slideshow_image_id, $language));
		return $data;
	}	
	/*public function getIdThisBySiIdAndLanguage($fx_)
	{
		$data = $this->conn->fetchAssoc("SELECT  FROM fx_slideshow_image_lang WHERE fx_slideshow_image_id = ? AND lang = ?", array($fx_slideshow_image_id, $language));
		return $data;	
	}*/
}