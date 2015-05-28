<?php

	class FX_DBConnection
	{
		private static $_instance;
		private $_pdo;

		private function __construct()
		{
			/*$options = array(
      			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    		);*/
		    //$this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, $options);
			$this->_pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		    $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		public static function getConnection()
		{
		    if (self::$_instance === null)//don't check connection, check instance
		    {
		        self::$_instance = new FX_DBConnection();
		    }
		    return self::$_instance;
		}

		public function fetchAll($sql, $keys = array())
		{
			$result = $this->_pdo->prepare($sql);		
			$result->execute($keys);
			$all = $result->fetchAll(PDO::FETCH_ASSOC);
			return $all;
		}

		public function fetchAssoc($sql, $keys = array())
		{
			$result = $this->_pdo->prepare($sql);								
			$result->execute($keys);

			$all = $result->fetch(PDO::FETCH_ASSOC);
			return $all;
		}

		public function fetchColumn($sql, $keys = array(), $column = 0)
		{
			$result = $this->_pdo->prepare($sql);								
			$result->execute($keys);

			$all = $result->fetchColumn();
			return $all;
		}

		public function lastInsertId()
		{
			return $this->_pdo->lastInsertId();
		}

		public function insert($table, $values, $debug = FALSE)
		{
			$ins = array();
			
			foreach ($values as $field => $v)
			{
				$ins[] = ':' . $field;
			}

			$ins = implode(',', $ins);
			$fields = implode(',', array_keys($values));
			$sql = "INSERT INTO `".$table."` ($fields) VALUES ($ins)";
			//echo($sql);

			$sth = $this->_pdo->prepare($sql);

			foreach ($values as $f => $v)
			{
				$sth->bindValue(':' . $f, $v);
			}
			//exit();
			$sth->execute();

			//rbn
			if($debug)
			{
				echo("<p>$sql</p>");
				echo("<pre>");
				print_r($values);
				echo("</pre>");
			}
		}

		public function update($table, $values, $ids, $debug = FALSE)
		{
			$set = "";
			foreach ($values as $field => $v)
			{
				$set .= ", `".$field."` = :".$field;
			}
			$set = strlen($set) > 0 ? " SET ".substr($set, 1):$set;

			$where = "";
			foreach ($ids as $field => $v)
			{
				$where .= " AND `".$field."` = :".$field;
			}
			$where = strlen($where) > 0 ? " WHERE ".substr($where, 4):$where;

			if(strlen($set) > 0)
			{
				$sql = "UPDATE `".$table."` ".$set." ".$where;

				$sth = $this->_pdo->prepare($sql);
				foreach ($values as $f => $v)
				{
					$sth->bindValue(':' . $f, $v);
				}

				foreach ($ids as $f => $v)
				{
					$sth->bindValue(':' . $f, $v);
				}				
				$sth->execute();

				if($debug)
				{
					echo("<p>$sql</p>");
					echo("<pre>values");
					print_r($values);
					echo("</pre>");
					echo("<pre>ids");
					print_r($ids);
					echo("</pre>");					
				}

				return TRUE;
			}
			else
			{

				if($debug)
				{
					echo("<p>$sql</p>");
					echo("<pre>values");
					print_r($values);
					echo("</pre>");
					echo("<pre>ids");
					print_r($values);
					echo("</pre>");	
				}

				return FALSE;
			}
		}

		public function delete($table, $ids, $debug = FALSE)
		{
			$where = "";
			foreach ($ids as $field => $v)
			{
				$where .= " AND `".$field."` = :".$field;
			}
			$where = strlen($where) > 0 ? " WHERE ".substr($where, 4):$where;

			$sql = "DELETE FROM `".$table."` ".$where;
			$sth = $this->_pdo->prepare($sql);

			foreach ($ids as $f => $v)
			{
				$sth->bindValue(':' . $f, $v);
			}
			$sth->execute();

			if($debug)
			{
				echo("<p>$sql</p>");
				echo("<pre>");
				print_r($ids);
				echo("</pre>");
			}			
		}

		public function executeUpdate($sql, $values, $debug = FALSE)
		{
			$sth = $this->_pdo->prepare($sql);
			foreach ($values as $f => $v)
			{
				$key = $f + 1;
				$sth->bindValue($key, $v);
			}
			$sth->execute();

			if($debug)
			{
				echo("<p>$sql</p>");
				echo("<pre>values");
				print_r($values);
				echo("</pre>");
				echo("<pre>ids");
				print_r($ids);
				echo("</pre>");					
			}

			return TRUE;			
		}
		
		//to TRULY ensure there is only 1 instance, you'll have to disable object cloning
		public function __clone()
		{
		    return false;
		}
		public function __wakeup()
		{
		    return false;
		}
	}