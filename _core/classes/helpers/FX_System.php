<?php
	
	class FX_System
	{
		public static function url($uri="", $force_relative_path = FALSE)
		{
			//getting a clean uri
			//eho BASE_FOLDER;
			$o = "/".BASE_FOLDER.'/'.$uri;
			
			$o = strpos($o, "//") === 0 ? substr($o, 1):$o;
			//echo "ooo****".$o;

			if($force_relative_path === FALSE)
			{
				$domains = array();
				for($i=1; $i<=10; $i++)
				{
					if(defined("FX_DOMAIN".$i))
					{
						eval("\$domains[] = FX_DOMAIN".$i.";");
					}
				}			
				if(count($domains) > 0)
				{
					foreach($domains as $key => $d)
					{
						if("http://".$_SERVER['HTTP_HOST'] == $d)
						{
							return $d.$o;
						}
					}
					return $domains[0].$o;
				}
			}	
			return $o;
		}

		public static function httpUserAgentIsMobile()
		{
			$detect = new Mobile_Detect;
			$device_type = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

			if($device_type == "phone")
			{
				return true;
			}
			
			return false;
		}

		public static function getNavItems()
		{
			//$obj_menu = 
			/*$FX_Section_obj = new FX_Category();
			$value = $FX_Section_obj->getCategorys();
			var_dump($value);
			exit();*/
			$items = array(
					'about' => array(
						'en' => array('page'=>'/about', 'label'=>'About us'),
						'default' => array('page'=>'/nosotros', 'label'=>'nosotros')
						),
					'potafolio' => array(
						'en' => array('page'=>'/servicio', 'label'=>'Servicios'),
						'default' => array('page'=>'/servicio', 'label'=>'servicios')
						),
					'clients' => array(
						'en' => array('page'=>'/notas', 'label'=>'Notes of interest'),
						'default' => array('page'=>'/notas', 'label'=>'notas de interes')
						),
					'developers' => array(
						'en' => array('page'=>'/contacto', 'label'=>'Contact'),
						'default' => array('page'=>'/contacto', 'label'=>'contacto')
						),
					);	

			return $items;
		}

		public static function getNavItemsMobile()
		{
			$items = array(

					'index' => array(
						'en' => array('page'=>'/mobile/home', 'label'=>'0'),
						'default' => array('page'=>'/mobile/index', 'label'=>'0')
						),
					'about' => array(
						'en' => array('page'=>'/mobile/about', 'label'=>'1'),
						'default' => array('page'=>'/mobile/nosotros', 'label'=>'1')
						),
					'potafolio' => array(
						'en' => array('page'=>'/mobile/work', 'label'=>'2'),
						'default' => array('page'=>'/mobile/trabajo', 'label'=>'2')
						),
					'clients' => array(
						'en' => array('page'=>'/mobile/case-study', 'label'=>'3'),
						'default' => array('page'=>'/mobile/case-study', 'label'=>'3')
						),
					'contact' => array(
						'en' => array('page'=>'/mobile/contact', 'label'=>'4'),
						'default' => array('page'=>'/mobile/contacto', 'label'=>'4')
						)
					);	


			return $items;
		}

		public static function getClients()
		{
			if($__LANG == "")
			{
					$clients = array(
			    	'compco'=>array('code' => 'compco', 'title' => 'Compco', 'image_bw' => '0.png', 'image_color' => '0.png', 'description' => '', 'link' => '', 'subcompanies'=> array(

			    		'stockland'=>array('code' => 'stockland', 'title' => 'Stockland', 'image_bw' => '5.jpg', 'image_color' => '5.jpg', 'description' => 'Stockland es el mayor grupo de </br> propiedad diversificada de Australia. </br> Desarrolla y gestiona centros </br>comerciales, residenciales y</br> comunidades.', 'link' => 'www.federationcentres.com.au'),

				'Charterhall'=>array('code' => 'charterhall', 'title' => 'Charterhall', 'image_bw' => '6.jpg', 'image_color' => '6.jpg', 'description' => 'Empresa australiana, propietarios</br> de oficinas, e industrias que sirven </br>de alojamiento para inquilinos.', 'link' => 'www.dexus.com'),				
				
				'dexus' => array('code' => 'dexus', 'title' => 'Dexus', 'image_bw' => '7.jpg', 'image_color' => '7.jpg', 'description' => 'Es uno de los grupos líderes de</br> inmobiliarias en Australia, propietarios </br> institucionales de edificios de</br> oficinas en el centro de Sidney.', 'link' => 'www.charterhall.com.au'),	
					
				'federation centres' => array('code' => 'federation centres', 'title' => 'Federation Centres', 'image_bw' => '8.jpg', 'image_color' => '8.jpg', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),				
				'plaza beach' => array('code' => 'plaza beach', 'title' => 'Plaza beach', 'image_bw' => '9.png', 'image_color' => '9.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				'orana' => array('code' => 'orana', 'title' => 'orana', 'image_bw' => '10.png', 'image_color' => '10.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				
				'outletshop' => array('code' => 'outletshop', 'title' => 'outletshop', 'image_bw' => '11.png', 'image_color' => '11.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				
				'fashionoutlet' => array('code' => 'fashionoutlet', 'title' => 'fashionoutlet', 'image_bw' => '12.png', 'image_color' => '12.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),

	    			)
		    	),  
		        'acorema'=>array('code' => 'acorema', 'title' => 'Acorema', 'image_bw' => '1.png', 'image_color' => '1.png','description' => 'Empresa que se dedica a la investigación</br> y conservación de la biodiversidad marina, promoviendo la participación de la población.', 'link' => 'http://www.acorema.org.pe'),
		        
		        'IngoCasa'=>array('code' => 'IngoCasa', 'title' => 'Ingo Casa', 'image_bw' => '2.png', 'image_color' => '2.png', 'description' => 'Grupo inmobiliario Peruano que nace con la proyeccción de satisfacer el bienestar</br> de sus clientes.', 'link' => 'http://www.ingocasa.com.pe'),
				
				'Bosch'=>array('code' => 'Bosch', 'title' => 'Bosch', 'image_bw' => '3.png', 'image_color' => '3.png', 'description' => 'Compañia Alemana con sede en Perú cuya división de electrodomésticos es de gran prestigio y reconocido por entender los estilos de vida más exigentes.', 'link' => 'http://www.bosh-home.pe'),
		        
		        'Mamacha'=>array('code' => 'Mamacha', 'title' => 'Mamacha Productions', 'image_bw' => '4.png', 'image_color' => '4.png', 'description' => 'Plataforma no convencional para la difusión y revalorización del artista peruano', 'link' => 'http://www.facebook.com/mamachaproductions'),
		        );
			}
			else
			{
				
				$clients = array(
			    	'compco'=>array('code' => 'compco', 'title' => 'Compco', 'image_bw' => '0.png', 'image_color' => '0.png', 'description' => '', 'link' => '', 'subcompanies'=> array(

			    		'stockland'=>array('code' => 'stockland', 'title' => 'Stockland', 'image_bw' => '5.jpg', 'image_color' => '5.jpg', 'description' => 'Stockland es el mayor grupo de </br> propiedad diversificada de Australia. </br> Desarrolla y gestiona centros </br>comerciales, residenciales y</br> comunidades.', 'link' => 'www.federationcentres.com.au'),

				'Charterhall'=>array('code' => 'charterhall', 'title' => 'Charterhall', 'image_bw' => '6.jpg', 'image_color' => '6.jpg', 'description' => 'Empresa australiana, propietarios</br> de oficinas, e industrias que sirven </br>de alojamiento para inquilinos.', 'link' => 'www.dexus.com'),				
				
				'dexus' => array('code' => 'dexus', 'title' => 'Dexus', 'image_bw' => '7.jpg', 'image_color' => '7.jpg', 'description' => 'Es uno de los grupos líderes de</br> inmobiliarias en Australia, propietarios </br> institucionales de edificios de</br> oficinas en el centro de Sidney.', 'link' => 'www.charterhall.com.au'),	
					
				'federation centres' => array('code' => 'federation centres', 'title' => 'Federation Centres', 'image_bw' => '8.jpg', 'image_color' => '8.jpg', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),				
				'plaza beach' => array('code' => 'plaza beach', 'title' => 'Plaza beach', 'image_bw' => '9.png', 'image_color' => '9.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				'orana' => array('code' => 'orana', 'title' => 'orana', 'image_bw' => '10.png', 'image_color' => '10.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				
				'outletshop' => array('code' => 'outletshop', 'title' => 'outletshop', 'image_bw' => '11.png', 'image_color' => '11.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),						
				
				'fashionoutlet' => array('code' => 'fashionoutlet', 'title' => 'fashionoutlet', 'image_bw' => '12.png', 'image_color' => '12.png', 'description' => 'Empresa australiana especializada </br> en la gestión de más de 70 centros</br> comerciales en Australia.', 'link' => 'https://www.stockland.com.au'),

			    		)
		    	),  
		        'acorema'=>array('code' => 'acorema', 'title' => 'Acorema', 'image_bw' => '1.png', 'image_color' => '1.png','description' => 'Company dedicated to research and preserve the marine biodiversity, promoting the participation of the population.', 'link' => 'http://www.acorema.org.pe'),
		        
		        'IngoCasa'=>array('code' => 'IngoCasa', 'title' => 'Ingo Casa', 'image_bw' => '2.png', 'image_color' => '2.png', 'description' => 'Peruvian property group created with the vision to provide their clients with the best products and services in the housing development industry.', 'link' => 'http://www.ingocasa.com.pe'),
				
				'Bosch'=>array('code' => 'Bosch', 'title' => 'Bosch', 'image_bw' => '3.png', 'image_color' => '3.png', 'description' => 'German Company based in Peru whose appliances division is highly regarded</br> and recognized by understanding the demanding life styles.', 'link' => 'http://www.bosh-home.pe'),
		        
		        'Mamacha'=>array('code' => 'Mamacha', 'title' => 'Mamacha Productions', 'image_bw' => '4.png', 'image_color' => '4.png', 'description' => 'Unconventional platform for the dissemination and presentation</br> of the Peruvian artist.', 'link', 'link' => 'http://www.facebook.com/mamachaproductions'),
		        );
			}
			

			return $clients;
		}

		public static function getAbout()
		{
			global $__LANG;
			if($__LANG == "sp")
			{
				$image_popup =array(
					'Box1'=>array('code' => 'Box1', 'frame' => 'frame.png','images_person' => '0.png', 'title' => 'Alex Corzo', 'position' => 'Gerente General', 'description' => 'Ingeniero de Sistemas en Australian Catholic</br> University ACU-Sydney Australia.</br> Post-Grado PADE en Marketing-ESAN Perú.<br> Maestría en Ingeniería de Software en Pontificia Universidad Católica del Perú(PUCP).</br> Experiencia de 10 años en desarrollo de</br> aplicaciones Web CRM para Australia.'),
				 	'Box2'=>array('code' => 'Box2',  'frame' => 'frame.png','images_person' => '1.png','title' => 'Karla Navas', 'position' => 'Gerente de Marketing Estrátegico', 'description' => 'Licenciada en Administración de Empresas en Pontificia Universidad Católica del Perú(PUCP).</br> Post-Grado PADE en Marketing-ESAN-Perú.</br> Master en Marketing Intelligence en ESIC-España.</br> MBA en CENTRUM Graduate Business School- Perú.</br> Experiencia en desarrollo de producto y servicios'),
					'Box3'=>array('code' => 'Box3','frame' => 'frame.png','images_person' => '3.png','title' => '&nbsp &nbsp &nbsp &nbsp &nbsp Equipo de </br>Developers y Creativos', 'position' => '', 'description' => 'Expertos capacitados en nuevas tendencias de programación que sienten pasión por el desarrollo de  soluciones dinámicas y precisas. Líderes creativos que plasman ideas innovadoras y diseños personalizados.')
				);	
				return $image_popup;
			}
			else
			{
				$image_popup =array(
					'Box1'=>array('code' => 'Box1', 'frame' => 'frame.png','images_person' => '0.png', 'title' => 'Alex Corzo', 'position' => 'General Manager', 'description' => 'Systems Engineer at Australian Catholic <br/> University ACU-Sydney Australia. <br /> Graduate in Marketing PADE-ESAN Perú. <br> Master of Software Engineering in the Pontificia Universidad Católica del Perú(PUCP). <Br/> 10 years experience in developing Web CRM applications to Australia.' ),
				 	'Box2'=>array('code' => 'Box2', 'frame' => 'frame.png','images_person' => '1.png','title' => 'Karla Navas','position' => 'Strategic Marketing Manager', 'description' => 'Bachelor of Business Administration Degree in Pontificia Universidad Católica del Perú(PUCP). </ Br>Graduate in Marketing PADE-ESAN Perú. </ Br> Master in Marketing Intelligence in ESIC-Spain. </ Br> MBA in Centrum Graduate Business School-Perú. </ br> Experience in product and services development.'),
					'Box3'=>array('code' => 'Box3', 'frame' => 'frame.png','images_person' => '3.png','title' => '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp TEAM  &nbsp &nbsp   </ br> DEVELOPERS AND CREATIVES', 'position' => '', 'description' => 'Team of Developers and Designers.Experts trained in new programming trends with a passion for developing dynamic and accurate solutions. Leaders who embody creative ideas and innovative custom designs. '));	
				return $image_popup;
			}
		}

		public function getPageLanguageSp() //eliminar
		{
			$replace = array('en/','.php','/');
			$view = str_replace($replace,'',VIEW_FILE);
			$view = $view == "index" ? "":$view;
			
			$arraySp = array(
				array('pageSp' =>'','pageEn' =>''),
				array('pageSp' =>'nosotros','pageEn' =>'about'), 
				array('pageSp' =>'clientes','pageEn' =>'clients'), 
				array('pageSp' =>'trabajo','pageEn' =>'work'), 
				array('pageSp' =>'contacto','pageEn' =>'contact'));
				
				foreach ($arraySp as $key => $value) 
				{ 
					if($view == $value['pageSp'] )
					{
						return $value['pageEn'];						
						break;
					}	
				}			
				return $view;
		}

		function getPageLanguageEn(){ //eliminar
			$replace = array('en/','.php','/');
			$view = str_replace($replace,'',VIEW_FILE);
			$view = $view == "index" ? "":$view;
			
			$arraySp = array(
				array('pageSp' =>'','pageEn' =>''),
				array('pageSp' =>'nosotros','pageEn' =>'about'), 
				array('pageSp' =>'clientes','pageEn' =>'clients'), 
				array('pageSp' =>'trabajo','pageEn' =>'work'), 
				array('pageSp' =>'contacto','pageEn' =>'contact'));
				foreach ($arraySp as $key => $value) 
				{ 
					if($view == $value['pageEn'])
					{
						return $value['pageSp'];
						break;
					}	 	
				}
				return $view;
		}
		
		function getWebsiteLabels()
		{
			global $__LANG;
			
			$labels = array(
				'_block_top' => array(
					
					),
				'_block_bottom' => array(
					'fi-copyright' => "&copy; ".date("Y")." FlexIT S.R.L. - Todos los derechos reservados",
					'fi-fotter-paragraph' => "FORMA PARTE DE NUESTRO DEVELOPER'S CLUB"
					),
				'_block_nav' => array(
					
					),
				'_view' => array(
					)
				);
			
			if(VIEW_FILE == "en/index.php" || VIEW_FILE == "nosotros.php" || VIEW_FILE == "trabajo.php" || VIEW_FILE == "cliente.php" || VIEW_FILE == "contacto.php")
			{
				$labels['_view']['key'] = "";
			}
			if($__LANG == "en")
			{
				$labels['_block_bottom']['fi-copyright'] = "&copy; ".date('Y')." FlexIT S.R.L. - ALL RIGHTS RESERVED";
				$labels['_block_bottom']['fi-fotter-paragraph'] = "WE INVITE YOU TO BE PART OF OUR DEVELOPER'S CLUB";
			}
			return $labels;
		}
		
		function stripslashesDeep($value)
		{
			$value = is_array($value) 
				   ? array_map('FX_System::stripslashesDeep', $value)
				   : stripslashes($value);
			return $value;
		}

		public static function getDomain()
		{
			$url = self::url("");
			$url = str_replace("http://", "", $url);
			$url = strpos($url, "/") !== FALSE ? substr($url, 0, strpos($url, "/")):$url;
			
			return ($url == "localhost") ? "":$url;	
		}

		public static function redirect($uri, $replace = FALSE)
		{
			//exit();
			if($replace === TRUE)
			{
				echo('
				<script type="text/javascript">window.location.replace(\''.$uri.'\');</script>
				');
			}
			else
			{
				echo('
				<script type="text/javascript">window.location.href=\''.$uri.'\';</script>
				');
			}
			exit();
		}
		
		public static function htmlreload($uri, $close=false)
		{
			$output = '
			<!DOCTYPE html>
			<html>
				<head>
					<script type="text/javascript">';
			if($uri === TRUE) //reload
			{
				$output .= 'window.opener.location.reload();';
			}
			else //redirect
			{
				$output .= 'window.opener.location.href = "'.$uri.'";';
			}
			if($close === TRUE)
			{
				$output .= 'window.close();';
			}
			$output .= '
					</script>
				</head>
			</html>';
			return $output;
		}
		
		public static function noValue($data)
		{
			if(strlen(trim($data)) > 0)
			{
				return FALSE;
			}
			return TRUE;
		}


		function getBrowser()
		{
			$u_agent = $_SERVER['HTTP_USER_AGENT'];
			$bname = 'Unknown';
			$platform = 'Unknown';
			$version= "";
			if (preg_match('/linux/i', $u_agent))
			{
				$platform = 'linux';
			}
			elseif (preg_match('/macintosh|mac os x/i', $u_agent))
			{
				$platform = 'mac';
			}
			elseif (preg_match('/windows|win32/i', $u_agent)) 
			{
				$platform = 'windows';
			}
			if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Internet Explorer';
				$ub = "MSIE";
			}
			elseif(preg_match('/Firefox/i',$u_agent))
			{
				$bname = 'Mozilla Firefox';
				$ub = "Firefox";
			}
			elseif(preg_match('/Chrome/i',$u_agent))
			{
				$bname = 'Google Chrome';
				$ub = "Chrome";
			}
			elseif(preg_match('/Safari/i',$u_agent))
			{
				$bname = 'Apple Safari';
				$ub = "Safari";
			}
			elseif(preg_match('/Opera/i',$u_agent))
			{
				$bname = 'Opera';
				$ub = "Opera";
			}
			elseif(preg_match('/Netscape/i',$u_agent))
			{
				$bname = 'Netscape';
				$ub = "Netscape";
			}
			$known = array('Version', $ub, 'other');
			$pattern = '#(?<browser>' . join('|', $known) .
			')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
			if (!preg_match_all($pattern, $u_agent, $matches)) {
			
			}
			$i = count($matches['browser']);
			if ($i != 1) 
			{
				if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				    $version= $matches['version'][0];
				}
				else {
				    $version= $matches['version'][1];
				}
			}
			else 
			{
				$version= $matches['version'][0];
			}
			if ($version==null || $version=="") {$version="?";}
			return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
			);
		}

		function getPageTitle()
		{
			global $__LANG;
			
			$page_title = FX_WEBSITENAME;			
			
			$nav_items = FX_System::getNavItems();
			foreach($nav_items as $ni_key => $ni_data)
			{
				if(substr(VIEW_FILE, 0, strpos(VIEW_FILE, ".")) == substr($ni_data['page'],1))
				{
					$page_title = $ni_data['label'];
					break;
				}
			}
			return $page_title;
		}

		function isAdminLogged()
		{
			if(isset($_COOKIE['loginAccess']) && strlen(trim($_COOKIE['loginAccess'])) > 0)
			{
				$current_time = time();
				$search = array('key' => $_COOKIE['loginAccess'],
								'valid_from^<=' => $current_time,
								'valid_to^>=' => $current_time,
								'closed' => 0);
				$result = __get_record("fx_user_session", "", $search, "fx_user_id");
				$fx_user_id = $result['fx_user_id'];
				
				return $fx_user_id ? $fx_user_id:FALSE; //valid loginAcess
			}
			return FALSE;
		}

		public static function validateLanguage($__FX_PARAMS)
		{
			if(isset($__FX_PARAMS['lang']))
			{
				if($__FX_PARAMS['lang'] != "en" && $__FX_PARAMS['lang'] != "sp")
				{
					//redireccionar a index
					$address = FX_System::url('/sp/');
					header("location: $address");
					exit();
				}
			}
		}

		public static function validateAdminLogin()
		{

			if(!$_SESSION['sysuser_id'])
			{						
				FX_System::redirect(FX_System::url('admin/login'), true);
			}						
		}

		public static function validationComent($firstname, $lastname, $email, $message, $section_id)
		{
			//echo $value;
			$firstname_ok = TRUE;
			$lastname_ok = TRUE;
			$email_ok = TRUE;    
			$message_ok = TRUE;
			$error_message = "";

		    if (trim($firstname) == "")
		    {
		        $firstname_ok = FALSE;
		        //echo('firstname');
		    } 
		    if (trim($lastname)== "")
		    {
		       $lastname_ok = FALSE;
		    }  

		    if (trim($email)== "" || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
		    {
		        $email_ok = FALSE; 
		        //echo('email');
		    }
		        
		    if (trim($message)=="")
		    {
		        $message_ok = FALSE;
		    }

		    if($firstname_ok == TRUE && $lastname_ok == TRUE && $email_ok == TRUE && $message_ok == TRUE)
		    {
		    	//echo('**********');
		    	//search user
		    	$FX_User_obj = new FX_User();
		    	$user_by_email = $FX_User_obj->getUserByEmail(trim($email));
		    	//var_dump($user_by_email);

		    	if(empty($user_by_email))
		    	{
		    		//new user, insert data
		    		$data_user = array(
		    				'firstname' => $firstname, 
		    				'lastname' => $lastname,
		    				'username' => $username,
		    				'email' => $email);

		    		$data_new_user = $FX_User_obj->insertUser($data_user);
		    		//var_dump($data_new_user);
		    		$id_user = 	$data_new_user['id'];
		    	}
		    	else
		    	{
		    		$id_user = $user_by_email['pr_user_id'];
		    	}

		    	//insert coment
		    	$FX_User_post_obj = new FX_UserPost();
		    	$data_post = array(
		    		'pr_user_id' => $id_user,
			    	'pr_section_id' => $section_id,
			    	'title' => '',
			    	'comment' => $message,
			    	'status' => 0,
			    	'date' =>  date("Y-m-d H:i:s")
		    	);

		    	$FX_User_post_obj->insertUserPost($data_post);
		    	
		    	$error_message = "<span id = 'errorContact' style='color:#A9A9B1'>Su comentario se ingreso satisfactoriamente.</span>";
		    }   

			$validation_field_coment = array(
				'firstname_ok' =>  $firstname_ok,
				'lastname_ok' =>  $lastname_ok,
				'email_ok' =>  $email_ok,
				'message_ok' =>  $message_ok,
			);
			return $validation_field_coment;
		}

		public static  function getPageNumbering($total_records, $pstart = 1, $link, $cipp = 10, $ipp = "", $params = "", $page = "pstart")
		{			
			$output = array();

			$spacer = " "; //"&nbsp;"
			$scroll = 10;						
	
			if($total_records > 0)
			{
				$ipp = (is_array($ipp)) ? $ipp:array(30, 60, 90, 120);
				
				$number_of_pages = ceil($total_records/$cipp);

				$current_page = ($pstart > 0 && $pstart <= $number_of_pages) ? $pstart:1;

				if($pstart == "Next >>")
				{
					
					$current_page = $link;	
					
				}

				if($pstart == "<< Previous")
				{
					$current_page = $link;	
								
				}
				
				$limit = " limit ".($current_page-1)*$cipp.", ".$cipp;				
						
				$link = $link;
				$numbering = "";

				if($number_of_pages > 1 && $number_of_pages <= $scroll)
				{
					if($current_page > 1)
					{					
						//$numbering .= $spacer."<a class='pagination_links'' href='".$link."/".$page."=".($current_page-1)."&cipp=".$cipp.$params."'>&lt;&lt; Previous</a>".$spacer;
						$numbering .= $spacer."<a class='pagination_links' data-value='".($current_page-1)."' href='result/".($current_page-1)."'>&lt;&lt; Previous</a>".$spacer;
					}
					for($i=1; $i<=$number_of_pages; $i++)
					{
						$a = array("", "");

						if($i != $current_page)
						{
							$a[0] = "<a class='pagination_links' href='result/".$i."'>";
							$a[1] = "</a>";
						}

						$numbering .= $spacer.$a[0].$i.$a[1].$spacer;
					}
					if($current_page < $number_of_pages)
					{

						$numbering .= $spacer."<a class='pagination_links' data-value='".($current_page+1)."' href='result/".($current_page+1)."'>Next &gt;&gt;</a>".$spacer;
					}
				}
				else if($number_of_pages > 1)
				{
					if($current_page > 1)
					{
						//$numbering .= $spacer."<a class='pagination_links' href='result/".($current_page-1)."'>&lt;&lt; Previous</a>".$spacer;
						$numbering .= $spacer."<a class='pagination_links' data-value='".($current_page-1)."' href='result/".($current_page-1)."'>&lt;&lt; Previous</a>".$spacer;
					}

					$m = ceil($scroll/2);
					$start = $current_page - $m;
					$start = ($start + $scroll > $number_of_pages) ? $number_of_pages+1-$scroll:$start; //handling out of bounds (right)
					$start = ($start <= 0) ? 1:$start; //handling out of bounds (left)

					if($start != 1)
					{
						$numbering .= $spacer."<label>...</label>".$spacer;
					}

					for($i=0; $i<$scroll; $i++)
					{
						$counter = $start+$i;
						$a = array("", "");
					
						if($counter != $current_page)
						{
							$a[0] = "<a class='pagination_links' href='result/".$counter."'>";
							$a[1] = "</a>";
						}					

						$numbering .= $spacer.$a[0].$counter.$a[1].$spacer;
					}

					if($counter != $number_of_pages)
					{
						$numbering .= $spacer."<label>...</label>".$spacer;
					}

					if($current_page < $number_of_pages)
					{
						$numbering .= $spacer."<a class='pagination_links' data-value='".($current_page+1)."' href='result/".($current_page+1)."'>Next &gt;&gt;</a>".$spacer;
					}
				}

				$output = array("total" => $total_records,
								"number_of_pages" => $number_of_pages,
								"current_page" => $current_page,
								"ipp" => $ipp,
								"cipp" => $cipp,
								"limit" => $limit,
								"numbering" => $numbering);

				return $output;
			}
		}

		public static  function iteractive($array, $father_id)
		{
			$obj_fx_section = new FX_Section();
			foreach ($array as $key => $value_iterative) 
			{
				$section_id = $value_iterative['id'];
				
				$position_iteractive = $key + 1;
				
				$data_section = array(
					'fx_menu_id'  => 0,
					'owner_id' 	=> $father_id,
					'position' 	=> $position_iteractive,
				);
				$obj_fx_section->update($data_section, $section_id);
				
				if(is_array($value_iterative['children']))
				{
					FX_System::iteractive($value_iterative['children'], $value_iterative['id']);
				}
			}
		}

		public static  function iteractiveDeleteChildren($array)
		{
			$obj_fx_section = new FX_Section();
			foreach ($array as $key => $value_iterative) 
			{
				$section_id = $value_iterative['fx_section_id'];
				$data_section = array(
					'deleted' => 1,
				);
				$obj_fx_section->update($data_section, $section_id);

				if(count($value_iterative['fx_sub_section']) > 0)
				{
					FX_System::iteractiveDeleteChildren($value_iterative['fx_sub_section']);
				}
			}
		}

		public static function nSubSectionsMenu($array)
		{	
			
			foreach ($array as $key => $value) {				
				if(is_array($value)){
					foreach ($value as $key_2 => $value2) {
						echo("<ul>");
							echo("<li>".$value2['title']."</li>");
						echo("</ul>");
					}
				}			
			}			
		}

		public static function saveStrDb($str)
		{
			return htmlentities($str, ENT_QUOTES, 'UTF-8');
		}

		public static function validFormByPage($page_id, $first_name, $last_name, $email, $comment)
		{
			$contact = new FX_Contact();
			$fx_date = new FX_Date();
			$post = new FX_Post();

			$first_name = FX_System::saveStrDb(trim($first_name));
			$last_name = FX_System::saveStrDb(trim($last_name));
			$email = FX_System::saveStrDb(trim($email));
			$comment = FX_System::saveStrDb(trim($comment));

			$filter = array('email' => $email);
			$verify_email = $contact->getByFilter($filter, '', 1);

			$msg_error = array();

			if($verify_email)
			{
				$error_exist_email = "el email ingresado ya existe";
				array_push($msg_error, $error_exist_email);
			}
			if($first_name=='' || $last_name=='' || $email=='' || $comment =='')
			{
				$error_data = "debe cpompletar todo los campos";
				array_push($msg_error, $error_data);
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) and strlen(trim($email)))
			{
				$error_email_invalid = "ingrese un email valido";		
				array_push($msg_error, $error_email_invalid);	
			}
			if(is_array($msg_error) and count($msg_error))
			{
				return $msg_error;
			}
			else
			{
				$data_contact = array('creation_dt' => date("Y-m-d H:i:s"), 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email);
				$id_contact = $contact->insert($data_contact);
				
				$data_post = array('fx_contact_id' => $id_contact, 'fx_page_id' => $page_id, 'creation_dt' => date("Y-m-d H:i:s"), 'comments' => $comment);
				$post->insert($data_post);
				$msg_success = "Se ha guardado correctamente";
				return $msg_success;
			}
		}

		public static function processImgDB($fx_table, $fx_folder_id, $folder_name, $array_data)
		{
			if(trim($fx_table) == "fx_media")
			{
				$obj_media = new FX_Media();				
				$data = array(
					"fx_folder_id"	=> $fx_folder_id,
					"title"			=> $array_data[0]->name,
					"file"			=> $array_data[0]->name,
					"file_type"		=> $array_data[0]->type,
					"size_kb"		=> $array_data[0]->size,
					"deleted"		=> 0
				);
				$response = $obj_media->insert($data);				
			}
		}

		/**
		* Method:      verificaSec
		* Description: get List Data
		* @return      list Data
		* @created:    Mario 	
		*/

		public static function verificaSec($language,$fx_owner_id, $use_class=false)
		{					
			$fx_section = new FX_Section();
			$fx_section_lang = new FX_SectionLang();

			$data_sub_section = $fx_section->getSectionByOwnerld($fx_owner_id,true);		
			
			if($language=="en")
			{	
				$temp_data = array();		
				$temp = $data_sub_section;
				foreach ($temp as $key => $value) {
					$response = $fx_section_lang->getAllSectionLangBySectionId($value['fx_section_id'],$language);				
					$data_sub_section[$key]['title_en'] = $response['title'];				
				}
			}
			
			$response = array();
			$html = "";
			$page = false;
			$name_class = $use_class? "class='dropdown'" : "";
		
			if(count($data_sub_section)>0)
			{					
				foreach($data_sub_section as $key_dt_subsec => $val_dt_subsec)
				{												
					if(count($val_dt_subsec['fx_sub_section'])>0)
					{	
						if($language=="en")
						{		
							$val_dt_subsec = $fx_section_lang->getAllSectionLangBySectionId($val_dt_subsec['fx_section_id'],$language);
						}			
						$link = $val_dt_subsec['link_external'] == 0 ? FX_System::url($language."/section/".$val_dt_subsec['fx_section_id']) : $value_section['link'];
						$html .= "<li $name_class><a target='_self' href='$link'>".$val_dt_subsec['title']."</a></li>";	
						$test = "1";
					}
					else
					{
						if($language=="en")
						{		
							$val_dt_subsec = $fx_section_lang->getAllSectionLangBySectionId($val_dt_subsec['fx_section_id'],$language);
						}
						//echo($val_dt_subsec["fx_section_id"]);					
						$data_page = FX_System::verificaPage($val_dt_subsec['fx_section_id']);		
						
						$link = FX_System::url($language."/page/".$data_page[0]['fx_page_id']);
						$html .= "<li $name_class><a target='_self' href='$link'>".$val_dt_subsec['title']."</a></li>";								
						$test = "2";					
					}			
				}

				$page = false;				
			}
			elseif(count($data_sub_section) == 0)
			{
				$data_section = $fx_section->getSectionById($fx_owner_id);
				
				if($language=="en")
				{
					$data_section = $fx_section_lang->getAllSectionLangBySectionId($fx_owner_id,$language);	
				}				

				$data_page = FX_System::verificaPage($data_section['fx_section_id'],$language);		
				$target = $data_section['link_external'] == 1 ? "target='".$data_section['link_target']."'" : ""; 
				if(count($data_page)>1)
				{
					$html .= "<li $name_class><a href='".FX_System::url($language."/page/".$data_section['fx_section_id'])."?multiple_pages=true'>".$data_section['title']."</a></li>";
					$test = "3";
				}			
				else
				{		
					$link =  $data_section['link_external'] == 0 ? "":$data_section['link'];
					if(count($data_page)==1)
					{						
						$link = FX_System::url($language."/page/".$data_page[0]['fx_page_id']);
					}					
					$html .= "<li $name_class><a href='$link' $target>".$data_section['title']."</a></li>";
					$test = "4";
				}		
				$page .= true;							
			}
			$response = array(
				"html" => $html,
				"page" => $page,
				"test" => $test 
				);				
		
			return $response;	
		}


		public static function verificaPage($fx_section_id, $language="es")
		{	
			$page = new FX_Page();
			$obj_pagelang = new FX_PageLang();
			$result_page = $page->getPageBySectionF($fx_section_id, false, date("Y-m-d H:i:s"));
			
			if($language == "en")
			{
				$temp = array();
				 array_push($temp,$obj_pagelang->getPageLangByPageId($result_page[0]["fx_page_id"]));
				$result_page = $temp;
			}
					
			/*echo("<pre>");
			print_r($result_page);
			echo("</pre>");*/
			return $result_page;
		}		
	}	