<?php 
class FX_Report{
	
	private $conn;
	private $folder = "../../../file/report";

	public function __construct(){
		$this->conn = FX_DBConnection::getConnection();

		//creating report folder
		if(!is_dir($this->folder))
		{
			@mkdir($this->folder, 0775, true);
			if(!is_dir($this->folder))
			{
				echo("No se pudo crear el directorio de reportes (".$this->folder.")");
			}
		}
	}

	public function __destruct(){}

	public function getFolder()
	{
		return $this->folder;
	}

	public function reportContact($search = "" )
	{				
		
		$where = " ";		
		if(strlen(trim($search)))
		{
			$where = " AND (first_name
					LIKE :q OR last_name LIKE :q OR email LIKE :q OR business LIKE :q 
					OR phone LIKE :q OR mobile LIKE :q OR address LIKE :q OR country LIKE :q) ";	
		}

		$query = "SELECT first_name, last_name, business, phone email FROM fx_contact WHERE deleted = 0 ".$where." ORDER BY creation_dt DESC ";
		$params = array('q' => '%'.$search.'%');
		$data = $this->conn->fetchAll($query, $params);

		$headers_arr = array('Nombres', 'Apellidos', 'Negocio', 'Correo', 'Telefono');
		
		$file = 'contacts.csv';
		
		foreach ($data as $key => $value) {
			$data[$key]['first_name'] = utf8_decode($data[$key]['first_name']);
			$data[$key]['last_name'] = utf8_decode($data[$key]['last_name']);
			$data[$key]['business'] = utf8_decode($data[$key]['business']);
			$data[$key]['address'] = utf8_decode($data[$key]['address']);
			$data[$key]['country'] = utf8_decode($data[$key]['country']);
		}

		    
		
		$success = CC_FileHandler::createCsvFromArray($headers_arr, $data, $file, $this->getFolder().'/');
		
		if($success)
		{
			$response = array(
				"success"  => $success,
				"path_url" => $this->getFolder().'/'.$file ,
				"file"	   => $file 
			);
			return $response;
		}
		else
		{
			$response = array(
				"success"  => $success,
				"path_url" => "" 
			);
			return $response;
		}
		
	}
}