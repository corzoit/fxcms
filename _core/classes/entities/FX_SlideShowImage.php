<?php

class FX_SlideShowImage extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_slideshow_image", "fx_slideshow_image_id");
	}

	public function __destruct(){}
	
	/*public function getSlideShowById($fx_slideshow_image)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow_image WHERE fx_slideshow_image_id = ?", array($fx_slideshow_image));
		return $data;
	}*/
	public function getSlideShowImageBySlideShowId($fx_slideshow_id)
	{
		$data = $this->conn->fetchAll("SELECT 
			*FROM fx_slideshow s 
			INNER JOIN fx_slideshow_image si
			on s.fx_slideshow_id = si.fx_slideshow_id
			WHERE si.fx_slideshow_id = ? AND si.deleted = 0 ORDER BY position", array($fx_slideshow_id));
		return $data;
	}
	public function getSlideShowImageBySlideShowImageId($fx_slideshow_image_id)
	{
		$data = $this->conn->fetchAssoc("SELECT *FROM fx_slideshow_image WHERE fx_slideshow_image_id = ?", array($fx_slideshow_image_id));
		return $data;
	}
	public function getPathImageBySlideShowImageId($fx_slideshow_image_id)
	{
		$data = $this->conn->fetchColumn("SELECT image FROM fx_slideshow_image WHERE fx_slideshow_image_id = ?", array($fx_slideshow_image_id));
		return $data;
	}

	public function getPositionBySsId($fx_slideshow_id)
	{
		$data = $this->conn->fetchColumn("SELECT count(*) FROM fx_slideshow_image ssi 
		INNER JOIN fx_slideshow ss on ssi.fx_slideshow_id =  ss.fx_slideshow_id
		 WHERE ss.fx_slideshow_id = ?", array($fx_slideshow_id));
		return $data;
	}

	public function getByCode($code)
	{
		$data = $this->conn->fetchAll("SELECT 
			*FROM fx_slideshow s 
			INNER JOIN fx_slideshow_image si
			on s.fx_slideshow_id = si.fx_slideshow_id
			WHERE s.code = ? AND si.deleted = 0 ORDER BY position", array($code));
		return $data;
	}

	/*public function getSlideShowImageBySectionId($section_id)
	{
		$data_slideshow = $this->conn->fetchAssoc("SELECT * FROM fx_slideshow WHERE fx_section_id = ?", array($section_id));
		$data = $this->conn->fetchAll("SELECT * FROM fx_slideshow_image WHERE fx_slideshow_id = ?", array($data_slideshow['fx_slideshow_id']));
		return $data;


	}*/
	/*public function getBySectionId($section_id)
	{
		$data = $this->conn->fetchAll("SELECT 
			*FROM fx_slideshow s 
			INNER JOIN fx_slideshow_image si
			on s.fx_slideshow_id = si.fx_slideshow_id
			WHERE s.code = ? AND si.deleted = 0 ORDER BY position", array($code));
		return $data;
	}*/
}