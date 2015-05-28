<?php

class FX_Section extends FX_BasicCRUD{

	private $conn;

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();
		parent::__construct();
		$this->setTableInfo("fx_section", "fx_section_id");
	}

	public function __destruct(){}
	
	public function getSectionById($fx_section_id)
	{
		$data = $this->conn->fetchAssoc("SELECT * FROM fx_section WHERE fx_section_id = ?", array($fx_section_id));
		return $data;
	}
	
	public function getSectionByOwnerld($owner_id, $all_levels = false)
	{
		$response = array();
		
		$data_section = $this->conn->fetchAll("SELECT * FROM fx_section WHERE owner_id = ? AND deleted = 0 ORDER BY position", array($owner_id));						
		if($data_section && count($data_section)>0)
		{
			if($all_levels)
			{											
				foreach ($data_section as $key_data_section => $value_data_section)
				{
					$return_sub_sec = $this->getSectionByOwnerld($value_data_section['fx_section_id'],$all_levels);
					$value_data_section['fx_sub_section'] = $return_sub_sec;
					array_push($response,$value_data_section);
				}					
			}
			else
			{
				$response = $data_section;
			}
		}				
		return $response;
	}

	/*public function insert($data)
	{
		$this->conn->insert('fx_section', $data);
	}*/

	/*public function update($data, $fx_section_id)
	{
		$data = $this->conn->update('fx_section',$data,array('fx_section_id'=> $fx_section_id));
		return $data;
	}

	public function delete($data, $fx_section_id)
	{
		$data = $this->conn->update('fx_section',$data,array('fx_section_id'=> $fx_section_id));
		return $data;
	}*/

	/*public function getSectionAll()
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_section");
		return $data;
	}*/

	public function getSectionByMenuId($fx_menu_id)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_section WHERE fx_menu_id = ? AND deleted = 0", array($fx_menu_id));
		return $data;
	}

	public function getNumSectionByMenuId($fx_menu_id)
	{
		$data = $this->conn->fetchColumn("SELECT COUNT(*) AS num_section FROM fx_section WHERE fx_menu_id = ? AND deleted = 0", array($fx_menu_id));
		return $data;
	}	

	public function getNumSectionBySectionId($owner_id)
	{
		$data = $this->conn->fetchColumn("SELECT COUNT(*) AS num_section FROM fx_section WHERE owner_id = ? AND deleted = 0", array($owner_id));
		return $data;
	}		

	public function getNsubSectionBySection($fx_section_id)
	{
		$data = $this->conn->fetchAll("SELECT * FROM fx_section WHERE owner_id = ?", array($fx_section_id));		
		return $data;
	}

	public function getAllSectionByMenuId($fx_menu_id)
	{
		$data = $this->conn->fetchAll("SELECT * FROM 
			fx_menu m INNER JOIN fx_section s 
			ON m.fx_menu_id = s.fx_menu_id
			WHERE 
				m.fx_menu_id = ? 
				AND s.deleted = 0 
			ORDER BY s.position", array($fx_menu_id));
		return $data;
	}

	public function getSectionByKeyMenu($key_menu)
	{	
		$response = array();
		$sql = "SELECT * FROM fx_section s INNER JOIN fx_menu m ON s.fx_menu_id = m.fx_menu_id 
				WHERE m.key_menu = ? AND  s.deleted = 0 AND  m.deleted = 0 ORDER BY s.position asc";
		$data = $this->conn->fetchAll($sql, array($key_menu));		
		foreach ($data as $key => $value) {	
			$data[$key]['fx_sub_section']= array();
			array_push($data[$key]['fx_sub_section'], $this->getSectionByOwnerld($value['fx_section_id'],true));
		
		}		
		
		return $data;
	}

	public function getPathImageBySectionId($fx_section_id)
	{
		$data = $this->conn->fetchColumn("SELECT icon  FROM fx_section WHERE fx_section_id = ?", array($fx_section_id));
		return $data;
	}

}

