<?php
	header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$sn_parts = explode("/", $_SERVER['SCRIPT_NAME']);
	$base_folder = count($sn_parts) > 1 ? $sn_parts[count($sn_parts)-2]:"";
	define("BASE_FOLDER", $base_folder);

	$uri = strpos($_SERVER['REQUEST_URI'], "?") ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")):$_SERVER['REQUEST_URI'];
	$view_file = substr($uri, strpos($uri, BASE_FOLDER."/") + strlen(BASE_FOLDER."/"));
	$view_file = "/".$view_file;

	$tmp_arr = explode("/",$view_file);//array url with "/"
	
	$ROOT_PATH = "";
	/*var_dump($tmp_arr);
	exit();*/
	include("_config/main.conf.php");
	include("_config/dynamic.conf.php");
	include("_config/db.conf.php");	
	//include("_config/routes.conf.php");
	//admin
	
	include("_config/lang.conf.php");
	
	include("_core/controller.php");
	include("_core/classes/loader.php");
	
	/* Check if systems is MULTI */
		$fx_sys = new FX_Sys();
		$data_fx_sys = $fx_sys->getSysAllByStatus();
		$multi_language = false;		
		if(count($data_fx_sys) == 1)
		{
			include("_config/routes.conf.php"); // One Language
		}else
		{
			$multi_language = true;
			include("_config/routes_lang.conf.php"); // Two or more languages
		}
	/* END */

	include("_core/common.php");

	$view_file_parts = explode("/", $view_file);

	foreach($FX_ROUTES as $key1 => $route)
	{
		foreach($route['path'] as $key2 => $path)
		{
			$path_parts = explode("/", $path);

			$arr_to_loop = count($path_parts) > count($view_file_parts) ?
				$path_parts:$view_file_parts;

			$all_parts = 0;
			$match_parts = 0;

			$path_new=substr($path_parts[1],1,strlen($path_parts[1])-2);
			$__LANG="";
			$path_new=$__LANG;

			foreach($arr_to_loop as $key3 => $v)
			{

				$p_part = $path_parts[$key3];

				if(strpos($p_part, "{") === FALSE)
				{
					$all_parts++;

					if($p_part == $view_file_parts[$key3])
					{
						$match_parts++;
					}
					$__LANG="";
				}
			}

			if($all_parts == $match_parts)
			{
				foreach($arr_to_loop as $key3 => $v)
				{
					$p_part = $path_parts[$key3];
					if(strpos($p_part, "{") !== FALSE)
					{
						$tmp_vf_part = substr($p_part, 1, strlen($p_part)-2);
						eval("\$__FX_PARAMS['".$tmp_vf_part."'] = \"".$view_file_parts[$key3]."\";");
						//var_dump($__FX_PARAMS);
						$__LANG = $__FX_PARAMS['lang'];
					}
				}

				if(file_exists("_views/".$route['view_file'])
					|| file_exists("_scripts/".$route['view_file']))
				{
					define("VIEW_FILE", $route['view_file']);
				}
				else
				{
					define("VIEW_FILE", "404.php");
				}

				break 2;
			}
		}
	}


	if(!defined("VIEW_FILE"))
	{
		define("VIEW_FILE", "404.php");
	}

	if(file_exists("_scripts/".VIEW_FILE))
	{
		include("_scripts/".VIEW_FILE);
	}

	if(file_exists("_views/".VIEW_FILE))
	{
		if(defined("FX_TEMPLATE") && file_exists("_templates/".FX_TEMPLATE))
		{
			include("_templates/".FX_TEMPLATE);
		}
		else
		{
			include("_templates/default.php");
		}
	}
	include("_core/gc.php");