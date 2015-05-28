<?php

class FX_FormPage extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_form_page", "fx_form_page_id");
	}

	public function __destruct(){}
	
	public function getFormPageById($fx_form_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_page WHERE fx_form_page_id = ?", array($fx_form_page_id));
		return $data;
	}

	public function getAllPageByFormId($fx_form_id)
	{
		$data = $this->conn->fetchAll("SELECT 
			fp.fx_form_page_id,
			fp.fx_form_id as form_id,
			fp.fx_page_id as form_page_id,
			fp.title as form_title,
			fp.intro as form_intro,
			fp.target_email as form_target_email,
			p.title, 
			p.fx_page_id
			FROM fx_form_page fp
		INNER JOIN fx_page p 
		ON fp.fx_page_id = p.fx_page_id 
		WHERE fx_form_id = ? AND p.deleted = 0", array($fx_form_id));
		
		/*foreach ($data as $key => $value) 
		{
			$data[$key]['title'] = utf8_encode($value['title']);	
		}*/

		return $data;
		/*var_dump($data);
		exit();*/
	}

	public function getFormPageByFormIdByPageId($fx_form_id, $fx_page_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_form_page WHERE fx_form_id = ? AND fx_page_id = ?", array($fx_form_id, $fx_page_id));
		return $data;	
	}


	public function getFormPageCountByPageIdByFormId($fx_form_id, $fx_page_id)
	{
		$where = " WHERE fx_form_id = ".$fx_form_id;
		if(strlen(trim($fx_page_id)))
		{
			$where = " WHERE fx_page_id = ".$fx_page_id;
		}			
		
		$data = $this->conn->fetchColumn("SELECT COUNT(*) AS total FROM fx_form_page ".$where );
		return $data;
	}

	public function getAllPageByPageId($fx_page_id,$limit)
	{
		$query = "SELECT

					fp.fx_form_page_id,
					fp.title AS fp_title,
					fp.intro as fp_intro,
					fp.target_email as fp_target_email,
					f.fx_form_id AS form_id,
					f.title AS form_title,
					p.fx_page_id AS page_id,
        			p.title AS page_title   
				FROM `fx_form_page` fp INNER JOIN
					fx_form f ON fp.fx_form_id = f.fx_form_id INNER JOIN 
					fx_page p ON fp.fx_page_id = p.fx_page_id
					
				WHERE fp.fx_page_id = ? $limit";
				
		$data = $this->conn->fetchAll($query, array($fx_page_id));
		return $data;
	}

	/*public function insert($data)
	{
		$this->conn->insert('fx_form_page', $data);
	}*/
}