
<?php	
	class CC_FileHandler
	{
	    /**
	     * Method:     	checkFolderExists
	     * Description: ...
	     * @return      null
	     * @created:    Ruben Sandoval - 2014.02.26
	     * @copyright   Compco Systems. All rights reserved.
	     */
		public static function checkFolderExists($path)
		{			
			$path = trim($path);
			if(strlen($path) && !is_dir($path))
			{				
				mkdir($path,0777,TRUE);
			}
		}

		/**
	     * Method:     	checkFilenameExt
	     * Description: ...
	     * @return      boolean
	     * @created:    Ruben Sandoval - 2014.02.26
	     * @copyright   Compco Systems. All rights reserved.
	     */
		public static function checkFilenameExt($filename, $exts = "") //$exts empty to ignore validation //validateImageExtensions
		{
			$exts = is_array($exts) ? $exts:explode(",",$exts);
			$exts = array_filter($exts);

			$fext = pathinfo(strtolower($filename), PATHINFO_EXTENSION);
			if(in_array($fext,$exts) || count($exts)==0)
			{
				return true;
			}

			return false;
		}

		/**
	     * Method:     	formatFilename
	     * Description: ...
	     * @return      file name
	     * @created:    Ruben Sandoval - 2014.02.26
	     * @copyright   Compco Systems. All rights reserved.
	     */
		public static function formatFilename($file_name)
		{
			$replace = "_";
			$pattern = "/([[:alnum:]_\.]*)/"; ///basically all the filename-safe characters
			$filename = str_replace(str_split(preg_replace($pattern,$replace,$file_name)),$replace,$file_name);

			return $filename;
		}

		/**
	     * Method:     	generateFilenameRandom
	     * Description: ...
	     * @return      file name
	     * @created:    Ruben Sandoval - 2014.02.26
	     * @copyright   Compco Systems. All rights reserved.
	     */
		public static function generateFilenameRandom($filename, $rand_lenght = 3, $rand_rewrite = false) //generateRandomImageName
		{
			$fn_parts = pathinfo($filename);

			if($rand_rewrite === true)
			{
				$i_end = is_numeric($rand_lenght) ? $rand_lenght:10;

				for($i = 0; $i < $i_end ;$i++)
				{
					$n = mt_rand(0,9);
					$str .= "$n";
				}

				$fn_rand = $str.".".$fn_parts['extension'];
			}
			else
			{
				$i_end = is_numeric($rand_lenght) ? $rand_lenght:3;
				for($i = 0; $i < $i_end ;$i++)
				{
					$n = mt_rand(0,9);
					$str .= "$n";
				}

				$fn_rand = $fn_parts['filename']."_".$str.".".$fn_parts['extension'];
			}

			return $fn_rand;
		}

		/**
	     * Method:     	uploadFile
	     * Description: ...
	     * @return      upload data
	     * @created:    Ruben Sandoval - 2014.02.26
	     * @copyright   Compco Systems. All rights reserved.
	     */
		public static function uploadFile($file_name, $file_tmpname, $path, $exts = "")
		{
			$data = array('success'=>false);
			CC_FileHandler::checkFolderExists($path);
			$file_name = CC_FileHandler::formatFilename($file_name);
			if(strlen($file_name) 
				&& strlen($file_tmpname) 
				&& strlen($path))
			{
				if(CC_FileHandler::checkFilenameExt($file_name, $exts))
				{
					if(copy($file_tmpname ,$path.$file_name))
					{	
						$data['success'] = true;
						$data['filename'] = $file_name;						
					}	
				}
			}

			return $data;
		}

		/**
		* Method:      createExcelFromArray
		* Description: generate excel
		* @return      upload data
		* @created:    Jamet Salvatierra l - 2014.02.26
		* @copyright   Compco Systems. All rights reserved.
		*/

	    public static function createExcelFromArray($headers_arr, $data_arr, $file, $path) //code/client/functions.php:general_data_download
	    {
			global $ROOT_PATH;
			$success = FALSE;
		
			set_time_limit(1800);
			ini_set("memory_limit", "2000M");
			
			if(is_array($data_arr) && count($data_arr))
			{
				define ("EXCEL_CODE_PATH", $ROOT_PATH.'code/1.7.2/Classes/');
				set_include_path(get_include_path() .PATH_SEPARATOR . $ROOT_PATH.'code/1.7.2/Classes/');
				
				include_once EXCEL_CODE_PATH.'PHPExcel/Writer/Excel5.php';
				require_once 'PHPExcel.php';
				require_once 'PHPExcel/RichText.php';
		
				$objPHPExcel = new PHPExcel();
				$objPHPExcel->getProperties()->setCreator(getWebsiteName());
				$objPHPExcel->getProperties()->setTitle("Client Database - ".getWebsiteName());
		
				$excel_letters = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK,AL,AM,AN,AO,AP,AQ,AR,AS,AT,AU,AV,AW,AX,AY,AZ,BA,BB,BC,BD,BE,BF,BG,BH,BI,BJ,BK,BL,BM,BN,BO,BP,BQ,BR,BS,BT,BU,BV,BW,BX,BY,BZ,CA,CB,CC,CD,CE,CF,CG,CH,CI,CJ,CK,CL,CM,CN,CO,CP,CQ,CR,CS,CT,CU,CV,CW,CX,CY,CZ,DA,DB,DC,DD,DE,DF,DG,DH,DI,DJ,DK,DL,DM,DN,DO,DP,DQ,DR,DS,DT,DU,DV,DW,DX,DY,DZ,EA,EB,EC,ED,EE,EF,EG,EH,EI,EJ,EK,EL,EM,EN,EO,EP,EQ,ER,ES,ET,EU,EV,EW,EX,EY,EZ,FA,FB,FC,FD,FE,FF,FG,FH,FI,FJ,FK,FL,FM,FN,FO,FP,FQ,FR,FS,FT,FU,FV,FW,FX,FY,FZ,GA,GB,GC,GD,GE,GF,GG,GH,GI,GJ,GK,GL,GM,GN,GO,GP,GQ,GR,GS,GT,GU,GV,GW,GX,GY,GZ,HA,HB,HC,HD,HE,HF,HG,HH,HI,HJ,HK,HL,HM,HN,HO,HP,HQ,HR,HS,HT,HU,HV,HW,HX,HY,HZ";
				$excel_letters_arr = explode(",", $excel_letters);
		
				$column = null;
				$row = 0;
				$number = 0;
		
				$objPHPExcel->setActiveSheetIndex(0);
		
				$row++; 		//moving to next row
				$column = 0; 	//reseting column count to zero
				$number++;		//excel row counter (printed as a column in excel)
				
				$format_header = array();
				foreach($headers_arr as $field => $value)
				{
					if(strpos($field, "format:") === 0)
					{
						$format_header[$field] = $value;
						unset($headers_arr[$field]);
					}				
				}
				
				$hcolumns = count($headers_arr);
				
				for($i=0; $i<$hcolumns; $i++)
				{
					$plus1 = 0;
					$objPHPExcel->getActiveSheet()->getColumnDimension($excel_letters_arr[$i+$plus1])->setWidth(22);
				}
		
				foreach($headers_arr as $db_header => $hdata)
				{
					if(is_array($hdata))
					{
						$xls_header = $hdata['title'];
					}
					else
					{
						$xls_header = $hdata;
					}

					$objPHPExcel->getActiveSheet()->getStyle($excel_letters_arr[$column].$row)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
					$objPHPExcel->getActiveSheet()->getStyle($excel_letters_arr[$column].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$objPHPExcel->getActiveSheet()->getStyle($excel_letters_arr[$column].$row)->getFill()->getStartColor()->setARGB('FF000099');
					$objPHPExcel->getActiveSheet()->setCellValue($excel_letters_arr[$column].$row, $xls_header);
					
					if($format_header["format:".$db_header])
					{					
						$cell_format = $format_header["format:".$db_header];
						if($cell_format['width'])
						{
							$objPHPExcel->getActiveSheet()->getColumnDimension($excel_letters_arr[$column])->setWidth($cell_format['width']);
						}
					}
					$column++;
				}
		
				$total_rows = count($data_arr);
				
				foreach($data_arr as $k0 => $data)
				{
					$number++;
					$row++; 		//moving to next row
					$column = 0; 	//reseting column count to zero
		
					foreach($headers_arr as $db_header => $hdata)
					{
						if(is_array($hdata))
						{
							$xls_header = $hdata['title'];
							$xls_column_type = $hdata['format'];
						}
						else
						{
							$xls_header = $hdata;
							$xls_column_type = "text";
						}				
						
						if(strpos($db_header, "datetime") !== FALSE)
						{
							$txt = $data[$db_header] && $data[$db_header] != "0000-00-00 00:00:00" ?
								date('d/m/Y H:i:s', it_mktime($data[$db_header])):"";
						}
						else if(strpos($db_header, "date") !== FALSE)
						{
							$txt = $data[$db_header] && $data[$db_header] != "0000-00-00" ?
								date('d/m/Y', it_mktime($data[$db_header])):"";
						}
						else
						{
							$txt = $data[$db_header];
						}
						
						$tmpcolumn = $column++;
						
						if($xls_column_type == 'number')
						{
							$objPHPExcel->getActiveSheet()->getStyle($excel_letters_arr[$tmpcolumn].$row)->getNumberFormat()->setFormatCode('#,##0.00;[Red](#,##0.00)');
						}
						
						$style_array = "";
						if($data["format:".$db_header]) //if specific format for cell was found
						{
							$cell_format = $data["format:".$db_header];
							if($cell_format['borders-allborders'])
							{
								$style_array = array(
								  'borders' => array(
								    'allborders' => array(
								      'style' => PHPExcel_Style_Border::BORDER_THIN
								    )
								  )
								);							
							}
							if($style_array != "")
							{
								$objPHPExcel->getActiveSheet()->getStyle($excel_letters_arr[$tmpcolumn].$row)->applyFromArray($style_array);						
							}
						}
						$objPHPExcel->getActiveSheet()->setCellValue($excel_letters_arr[$tmpcolumn].$row, $txt);	
					}
				}
		
				//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
		
				// Set page orientation and size
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
				// Rename sheet
		
				$objPHPExcel->getActiveSheet()->setTitle('Results');
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
		
				$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
				
				$objWriter->save($path.$file);
		
				$success = TRUE;
			}
			else
			{
				$success = FALSE;
			}
			
			return $success;
		}

		/**
		* Method:      createArrayFromExcel
		* Description: generate excel
		* @return      upload data
		* @created:    Jamet Salvatierra l - 2014.02.26
		* @copyright   Compco Systems. All rights reserved.
		*/

	    public static function createArrayFromExcel($excel_file, $ignore_headers = true) //code/client/functions.php:general_data_download
	    {
	    	global $ROOT_PATH;
	    	$output_arr = array();

			if ($excel_file && file_exists($excel_file)) 
			{
				set_include_path(get_include_path().PATH_SEPARATOR.$ROOT_PATH.'_core/classes/vendor/');
				include('PHPExcel/IOFactory.php');
		
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel = $objReader->load($excel_file);
		
				$highest_row 		= $objPHPExcel->getActiveSheet()->getHighestRow();
				$highest_column      = $objPHPExcel->getActiveSheet()->getHighestColumn();
				$highest_column_index = PHPExcel_Cell::columnIndexFromString($highest_column);

				$excel_letters = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,AA,AB,AC,AD,AE,AF,AG,AH,AI,AJ,AK,AL,AM,AN,AO,AP,AQ,AR,AS,AT,AU,AV,AW,AX,AY,AZ,BA,BB,BC,BD,BE,BF,BG,BH,BI,BJ,BK,BL,BM,BN,BO,BP,BQ,BR,BS,BT,BU,BV,BW,BX,BY,BZ,CA,CB,CC,CD,CE,CF,CG,CH,CI,CJ,CK,CL,CM,CN,CO,CP,CQ,CR,CS,CT,CU,CV,CW,CX,CY,CZ,DA,DB,DC,DD,DE,DF,DG,DH,DI,DJ,DK,DL,DM,DN,DO,DP,DQ,DR,DS,DT,DU,DV,DW,DX,DY,DZ,EA,EB,EC,ED,EE,EF,EG,EH,EI,EJ,EK,EL,EM,EN,EO,EP,EQ,ER,ES,ET,EU,EV,EW,EX,EY,EZ,FA,FB,FC,FD,FE,FF,FG,FH,FI,FJ,FK,FL,FM,FN,FO,FP,FQ,FR,FS,FT,FU,FV,FW,FX,FY,FZ,GA,GB,GC,GD,GE,GF,GG,GH,GI,GJ,GK,GL,GM,GN,GO,GP,GQ,GR,GS,GT,GU,GV,GW,GX,GY,GZ,HA,HB,HC,HD,HE,HF,HG,HH,HI,HJ,HK,HL,HM,HN,HO,HP,HQ,HR,HS,HT,HU,HV,HW,HX,HY,HZ";
				$excel_letters_arr = explode(",", $excel_letters);				

				$row_counter = 1; //excel row counter starts at 1		
				$array_index = 0;
				while($objPHPExcel->getActiveSheet())
				{
					if($row_counter == 1 && $ignore_headers)
					{
						$row_counter++;
						continue;
					}
					else
					{
						$output_arr[] = array();
						for($i=0; $i<$highest_column_index; $i++)
						{
							$current_letter = $excel_letters_arr[$i];
							$output_arr[$array_index][$i] = $objPHPExcel->getActiveSheet()->getCell($current_letter.$row_counter)->getValue();
						}

						$array_index++;
						$row_counter++;
					}
					
					if($row_counter == $highest_row + 1)
					{
						break;
					}
				}
			}
			
			return $output_arr;
		}		

	    public static function createCsvFromArray($headers_arr, $data_arr, $file, $path)
	    {
			$_fp   = @fopen( $path.$file, 'w');

			$xls_header_str = "";
			foreach($headers_arr as $db_header => $xls_header)
			{
				$xls_header_str .= $xls_header.",";
			}
			$xls_header_str = rtrim($xls_header_str, ",");
			$_csv_data  	= $xls_header_str. "\n";

			@fwrite( $_fp, $_csv_data);


			foreach($data_arr as $subarray)
			{
				$column_data_str = "";
				$_csv_data  = "";
				if(is_array($subarray))
				{
					foreach($subarray as $column_data)
					{
						$column_data_str .= str_replace(",", " ", $column_data).",";
					}
				}
				
				$column_data_str = rtrim($column_data_str, ",");
				$_csv_data  	  .= $column_data_str. "\n";
			
				@fwrite( $_fp, $_csv_data);
			}

			@fclose( $_fp );			
			return file_exists($path.$file);
		}

		public static function recursive1($array)
		{

			include("_config/lang.conf.php");
			include("_core/common.php");
			//var_dump($_LANG);
			//echo("LANG_SYS".LANG_SYS);
		?>
			<ol class="dd-list">
			<?foreach ($array as $key => $value) {?>
				<li class="dd-item" data-id="<?=$value['fx_section_id']?>" position = "<?=$value['position']?>">
					<div class="dd-handle">
						<?php echo $value['title']?>
						<?if($value['private'] == 1){?>
							<i class="glyphicon glyphicon-lock"></i>
						<?}?>
						<button class="btn btn-lg btn-danger pull-right button-section delete-section dd-nodrag" data = "<?echo $value['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_delete_section']?></button>
						<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-lg  btn-primary pull-right button-section edit-section dd-nodrag" data = "<?echo $value['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_edit_section']?></button>
						<button href="<?=FX_System::url('admin/menu/manager')?>" class="btn btn-lg btn-success pull-right button-section section-add dd-nodrag" data = "<?echo $value['fx_section_id']?>" type="button"><?=$_LANG[LANG_SYS]['menu_mng_btn_add_section']?></button>				
					</div>
					<?(count($value['fx_sub_section']) > 0) ?  CC_FileHandler::recursive1($value['fx_sub_section']): ""; 	?>
				</li>
			<?}?>
			</ol>
			<?
		}

		public static function nSubSections($value_data_sub_section, $space, $id_section)
		{
			$space_last = $space;
			foreach($value_data_sub_section['fx_sub_section'] as $key => $value)
			{
				$selected = '';
				if($id_section == $value['fx_section_id'])
				{
					$selected = "selected";
				}
				?>
			    <option <?=$selected?> style="margin-left:<?=$space?>px;" value="<?=$value['fx_section_id']?>" data="<?=$value['section_type']?>">* <?=$value['title']?></option>
			    <?
			    if(is_array($value))
			    {
			    	$space = $space + 25;
			        CC_FileHandler::nSubSections($value, $space, $id_section);
			    }   
			    $space = $space_last;
			}
		}

		public function header_csv($path_url, $file)
		{		
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=".$file);
			header("Pragma: no-cache");
			header("Expires: 0");
			ob_clean();
			flush();
			readfile($path_url);				
		}

		public function send_mail($mail)
		{
			$headers = 'From: webmaster@example.com' . "\r\n" .
		    'Reply-To: webmaster@example.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
			if(mail($mail['to'], $mail['subject'], $mail['message'], $headers))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
	}