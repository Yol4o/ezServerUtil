<?php
/**
	@company Interline S.R.L
	@author Pierandrea Della Putta
	@version 1.1
*/
// include_once("kernel/classes/ezcontentobjecttreenode.php");
// include_once("kernel/classes/ezcontentobject.php");
// require_once( 'kernel/common/template.php' );
//$http = eZHTTPTool::instance();
// $tpl = eZTemplate::factory();

// require_once 'kernel/common/template.php';

// $tpl = eZTemplate::factory();
// $http = eZHTTPTool::instance();
// $module = $Params['Module'];

class ezServerUtil
{
	/**
	*
	*/
	function ezServerUtil()
	{
		//@session_start();
	}
	
	/**
	*
	*/
	private function kshuffle(&$array)
	{
		if(!is_array($array) || empty($array))
		{
			return false;
		}
		$tmp = array();
		foreach($array as $key => $value)
		{
			$tmp[] = array('k' => $key, 'v' => $value);
		}
		shuffle($tmp);
		$array = array();
		foreach($tmp as $entry)
		{
			$array[$entry['k']] = $entry['v'];
		}
		return true;
	}


	function operatorList()
	{
		return array(
						'sessionset',
						'sessionget',
						'removefromsession',
						'redirectabsolute',
						'redirectrelative',
						'sessionSet',
						'sessionGet',
						'removeFromSession',
						'getSession',
						'getPost',
						'isMail',
						'getGet',
						'addToArray',
						'getServer',
						'KShuffle',
						'Shuffle',
						'kSort',
						'aSort',
						'krSort',
						'arSort',
						'arrayCountValues',
						'strStr',
						'stripTags',
						'flashReplace',
						'flashReplaceT',
						'youTube',
						'arrayKey',
						'strReplace',
						'dateTime',
						'checkDate',
						'strToTime',
						'strrChr',
						'Round',
						'getsiteaccess',
						'getGlobals',
						'getglobals',
						'globalsset',
						'globalsget',
						'globalget',
						'globalset',
						'removefromglobals',
						'removeFromGlobals',
			);
	}

	/*!
	\return true to tell the template engine that the parameter list exists per operator type,
		this is needed for operator classes that have multiple operators.
	*/
	function namedParameterPerOperator()
	{
		return array(
						'sessionset' => array('var' , 'value'),
						'sessionget' => array('var'),
						'removefromsession' => array('var'),
						'sessionSet' => array('var' , 'value'),
						'sessionGet' => array('var'),
						'removeFromSession' => array('var'),
						'redirectabsolute' => array('var'),
						'redirectrelative' => array('var'),
						'strStr' => array('var' , 'value'),
						'strrChr' => array('var' , 'value'),
						'arrayKey' => array('var' , 'value'),
						'addToArray' => array('var' , 'value'),
						'arrayCountValues' => array('var' , 'value'),
						'stripTags' => array('var' , 'value'),
						'flashReplace' => array('var' , 'value'),
						'strReplace' => array('var' , 'value'),
						'flashReplaceT' => array('var'),
						'isMail' => array('var'),
						'youTube' => array('var','value'),
						'getSession' => array(),
						'getPost' => array(),
						'getServer' => array(),
						'aSort' => array('var'),
						'arSort' => array('var'),
						'kSort' => array('var'),
						'krSort' => array('var'),
						'KShuffle' => array('var'),
						'Shuffle' => array('var'),
						'strToTime' => array('var'),
						'dateTime' => array('var' , 'value'),
						'checkDate' => array('var'),
						'getGet' => array(),
						'Round' => array('var'),
						'getsiteaccess'=> array(),
						'getGlobals'=> array(),
						'getglobals' => array(),
						'globalsset' => array('var' , 'value'),
						'globalsget' => array('var'),
						'globalget' => array('var'),
						'globalset' => array('var', 'value'),
						'removefromglobals' => array('var'),
						'removeFromGlobals' => array('var'),
			);
	}

	/*!
		See eZTemplateOperator::namedParameterList
	*/
	function namedParameterList()
	{
		return array(
						'sessionset' => array('var' => array (
																'type' => 'string',
																'required' => true,
																'default' => ''
																),
												'value' => array (
																	'type' => 'string',
																	'required' => true,
																	'default' => '0'
														)
										),
						'sessionget' => array('var'=> array (
																'type' => 'string',
																'required' => true,
																'default' => ''
															)
										),
						'removefromsession' => array('var'=> array (
																		'type' => 'string',
																		'required' => true,
																		'default' => ''
																	)
													),
						'redirectabsolute' => array( 'var' => array(
																		'type' => 'string',
																		'required' => true,
																		'default' => '' 
																	)
													),
							
						'redirectrelative' => array( 'var' => array( 
																		'type' => 'string',
																		'required' => true,
																		'default' => ''
																	)
													),
						'sessionSet' => array('var' => array (
																'type' => 'string',
																'required' => true,
																'default' => ''
																),
												'value' => array (
																	'type' => 'string',
																	'required' => true,
																	'default' => '0'
														)
										),
						'sessionGet' => array('var'=> array (
																'type' => 'string',
																'required' => true,
																'default' => ''
															)
										),
						'removeFromSession' => array('var'=> array (
																		'type' => 'string',
																		'required' => true,
																		'default' => ''
																	)
													),
						'arrayCountValues' => array('var' => array (
																	'type' => 'string',
																	'required' => true,
																	'default' => ''
															),
															'value' => array (
																		'type' => 'array',
																		'required' => true,
																		'default' => '0'
																	)
										),
						'addToArray' => array('var' => array (
															'type' => 'array',
															'required' => true,
															'default' => ''
															),
											'value' => array (
														'type' => 'array',
														'required' => true,
														'default' => ''
													)
										),
						'arrayKey' => array('var' => array (
															'type' => 'string',
															'required' => true,
															'default' => ''
															),
											'value' => array (
														'type' => 'array',
														'required' => true,
														'default' => '0'
													)
										),
						'strStr' => array('var' => array (
											'type' => 'string',
											'required' => true,
											'default' => '' ),
											'value' => array (
														'type' => 'string',
														'required' => true,
														'default' => '0'
													)
										),
						'strrChr' => array('var' => array (
											'type' => 'string',
											'required' => true,
											'default' => '' ),
											'value' => array (
														'type' => 'string',
														'required' => true,
														'default' => '0'
													)
										),
						'stripTags' => array('var' => array (
											'type' => 'string',
											'required' => true,
											'default' => '' ),
											'value' => array (
														'type' => 'string',
														'required' => true,
														'default' => '0'
													)
										),
						'flashReplace' => array('var' => array (
											'type' => 'string',
											'required' => true,
											'default' => '' ),
											'value' => array (
														'type' => 'string',
														'required' => true,
														'default' => '0'
													)
										),
						'flashReplaceT' => array('var' => array (
											'type' => 'string',
											'required' => true,
											'default' => ''
											)
									),
						'youTube' => array(	'var'=> array (
											'type' => 'string',
											'required' => true,
											'default' => ''
										),
									'value' => array (
											'type' => 'array',
											'required' => true,
											'default' => ''
											)
								),
						'getPost' => array('var'=> array (
											'type' => 'string',
											'required' => false,
											'default' => ''
										)
									),
						'getGet' => array('var'=> array (
											'type' => 'string',
											'required' => false,
											'default' => ''
										)
									),
						'getsiteaccess' => array('var'=> array (
																	'type' => 'string',
																	'required' => false,
																	'default' => ''
																)
												),
						'getServer' => array('var'=> array (
											'type' => 'string',
											'required' => false,
											'default' => ''
										)
									),
						'isMail' => array('var'=> array (
											'type' => 'string',
											'required' => true,
											'default' => ''
										)
									),
						'KShuffle' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'Shuffle' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'Round' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'aSort' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'arSort' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'kSort' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'krSort' => array('var'=> array (
											'type' => 'array',
											'required' => true,
											'default' => ''
										)
									),
						'strReplace' => array('var' => array (
																'type' => 'string',
																'required' => true,
																'default' => ''
															),
											'value' => array (
																'type' => 'array',
																'required' => true,
																'default' => ''
															)
										),
						'dateTime' => array('var' => array (
															'type' => 'array',
															'required' => false,
															'default' => ''
															),
											'value' => array (
														'type' => 'int',
														'required' => false,
														'default' => 0
													)
										),
						'checkDate' => array('var'=> array (
																'type' => 'array',
																'required' => true,
																'default' => ''
														)
											),
						'strToTime' => array('var' => array (
															'type' => 'array',
															'required' => true,
															'default' => ''
															)
										),
						'getSession' => array('var'=> array (
											'type' => 'string',
											'required' => false,
											'default' => ''
										)),
						'getglobals' => array('var'=> array (
																'type' => 'string',
																'required' => false,
																'default' => ''
															)
											),
						'getGlobals' => array('var'=> array (
																'type' => 'string',
																'required' => false,
																'default' => ''
															)
											),
						'globalsset' => array('var' => array (
																'type' => 'string',
																'required' => true,
																'default' => ''
																),
												'value' => array (
																	'type' => 'string',
																	'required' => true,
																	'default' => '0'
														)
										),
						'globalsget' => array('var'=> array (
																'type' => 'string',
																'required' => true,
																'default' => ''
															)
										),
						'removefromglobals' => array('var'=> array (
																		'type' => 'string',
																		'required' => true,
																		'default' => ''
																	)
													),
						'globalset' => array('var' => array (
																'type' => 'string',
																'required' => true,
																'default' => ''
																),
												'value' => array (
																	'type' => 'string',
																	'required' => true,
																	'default' => '0'
														)
										),
						'globalget' => array('var'=> array (
																'type' => 'string',
																'required' => true,
																'default' => ''
															)
										),
						'removeFromGlobals' => array('var'=> array (
																		'type' => 'string',
																		'required' => true,
																		'default' => ''
																	)
													),
				);
	}

	function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
	{
		$variable = $namedParameters['var'];
		$value = @$namedParameters['value'];
// 		if (isset($namedParameters['value']))
// 		{
// 			$value = $namedParameters['value'];
// 		}
		switch ( $operatorName )
		{
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'removeFromGlobals':
			case 'removefromglobals':
			{
				unset($GLOBALS[$variable]);
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'globalsset':
			case 'globalset':
			{
				echo "<p>GLOBALS - SETTO [$variable] = $value</p>";
 				$GLOBALS[$variable] = $value;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'globalsget':
			case 'globalget':
			{
				$operatorValue = $GLOBALS[$variable];
// 				echo "<pre>";
// 				print_r($GLOBALS);
// 				echo "</pre>";
 				break;
			}
            //---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getGlobals':
			{
				$operatorValue = $GLOBALS;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getsiteaccess':
			{
				$operatorValue = $GLOBALS['eZCurrentAccess']['name'];
				break;
			}
			//---------------------------------------------------------------------------------
			// @array: primo valore il numero. Eventuale secondo valore il numero di cifre dopo
			//			la virgola
			//---------------------------------------------------------------------------------
			case 'Round':
			{
				$__NUMBER = $variable[0];
				$__PRECISIUS = 2;
				if(count($variable) > 1) $__PRECISIUS = $variable[1];
				$operatorValue = round($__NUMBER,$__PRECISIUS);
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'addToArray':
			{
				if(count($value) == 1)
				{
					$variable[] = $value[0];
				}
				else
				{
					$variable[$value[1]] = $value[0];
				}

				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'dateTime':
			{
				$__temp_date = NULL;
				if($value == 1)
				{
					$__temp_date = new DateTime(date("Y-m-d",time()));
				}
				elseif($value == 2)
				{
					$__temp_date = new DateTime(date("Y-m-d H:i:s",time()));
				}
				elseif(count($variable) == 3)
				{
					$__temp_date = new DateTime("{$variable[0]}-{$variable[1]}-{$variable[2]}");
				}
				else
				{
					$__temp_date = new DateTime();
				}

				$operatorValue = $__temp_date->getTimestamp();
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'checkDate':
			{
				// $operatorValue = checkdate(month, day, year)
				$operatorValue = checkdate($variable[1],$variable[0],$variable[2]);
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'strToTime':
			{
				$operatorValue = strtotime("{$variable[0]}-{$variable[1]}-{$variable[2]}");
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'sessionSet':
			case 'sessionset':
			{
// 				$_SESSION[$variable] = $value;
				eZHTTPTool::instance()->setSessionVariable( $variable, $value );
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'sessionGet':
			case 'sessionget':
			{
				//PIER: BLOCCO DI CODICE AGGIUNTO PER UTILIZZO CON EZPUBLISH 5.1 e successivi!
				//NOTA: per utilizzare le istante della classe eZHTTPTool si fa in questo modo!!!
				if(array_key_exists($variable,$_SESSION))
				{
					$operatorValue = $_SESSION[$variable];
				}
				else
				{
					if(eZHTTPTool::instance()->hasSessionVariable($variable))
					{
						$operatorValue = eZHTTPTool::instance()->sessionVariable($variable);
					}
					else
					{
						$operatorValue = '';
// 							echo "<pre>";
// 							print_r($_SESSION);
// 							echo "</pre>";
// 							die("----------DEBUG INTERLINE--------------");
					}
				}
// 				$operatorValue = isset($_SESSION[$variable])?$_SESSION[$variable]:'';
 				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'removeFromSession':
			case 'removefromsession':
			{
				//unset($_SESSION[$variable]);
				eZHTTPTool::instance()->removeSessionVariable( $variable );
				break;
			}
			
            //---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
            case 'redirectabsolute':
            {
                //$operatorValue = $this->redirectAbsolute( $namedParameters['to'] );
				if (headers_sent())
				{
					return false;
				}
				else
				{
					//301 - Moved forever. 
					header("HTTP/1.1 301 Moved Permanently");
						
					//302 - Use the same method (GET/POST) to request the specified page. 
					// header("HTTP/1.1 302 Found")
						
					//303 - Use GET to request the specified page.
					// header("HTTP/1.1 303 See Other")

					header("Location: $variable");
					eZExecution::cleanExit();
				}
            } 
            break;
            
            //---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
            case 'redirectrelative':
            {
				$schema = $_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http';
				$host = strlen($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
				if( headers_sent() ) 
				{
					return false;
				}
				else
				{
					//301 - Moved forever. 
						header("HTTP/1.1 301 Moved Permanently");
						
					//302 - Use the same method (GET/POST) to request the specified page. 
						//header("HTTP/1.1 302 Found")
						
						//303 - Use GET to request the specified page.
						//header("HTTP/1.1 303 See Other")
							
						header("Location: $schema://$host$variable");
						eZExecution::cleanExit();
				}
            } 
            break;
            //---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getSession':
			{
				$operatorValue = $_SESSION;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getPost':
			{
				$operatorValue = $_POST;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getGet':
			{
				$operatorValue = $_GET;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'getServer':
			{
				$operatorValue = $_SERVER;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'kSort':
			{
				ksort($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'aSort':
			{
				asort($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'arSort':
			{
				arsort($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'kSort':
			{
				ksort($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'krSort':
			{
				krsort($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'KShuffle':
			{
				$this->kshuffle($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'Shuffle':
			{
				shuffle($variable);
				$operatorValue = $variable;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'isMail':
			{
				$email = $variable;
				$isValid = true;
				if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
				{
					$isValid = false;
				}
				$operatorValue = $isValid;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'strStr':
			{
				$operatorValue = substr(strstr($value, $variable),1,strlen($value));
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'strrChr':
			{
				$operatorValue = substr(strrchr($value, $variable),1,strlen($value));
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'stripTags':
			{
				$operatorValue = strip_tags($variable,$value);
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'flashReplace':
			{
				$pattern = array();
				$pattern[0] = '/width="(\d+)"/i';
				$pattern[1] = '/height="(\d+)"/i';
				$replacement = array();
				$replacement[0] = 'width="(__WIDTH__)"';
				$replacement[1] = 'height="(__HEIGHT__)"';

				if(is_array($value))
				{
					$variable = preg_replace($pattern, $replacement, $variable);
					$operatorValue = str_replace(array('(__WIDTH__)','(__HEIGHT__)'),$value,$variable);
				}
				else
				{
					$operatorValue = $variable;
				}
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'flashReplaceT':
			{
				$__ARR = preg_split("/ /",$variable);
				if( !in_array("wmode=transparent",$__ARR,true) )
				{
					$__TMP = array();
					foreach($__ARR as $__KEY => $__VALUE)
					{
						$__TMP[] = $__VALUE;
						if($__KEY == (count($__ARR) - 2) )
						{
							$__TMP[] = "wmode=transparent";
						}
					}
					$__ARR = $__TMP;
				}
				$operatorValue =  implode(" ", $__ARR);
			}
			//------------------------------------------------------------------------------
			// Parametri:
			//	getTitle
			//	getDescription
			//	getAuthor
			//	getTags
			//	getThumb
			//		-> large = 0 || small = 1 || 2 || 3
			//	embedVideo
			//		-> array(
			//			'width' => '425',
			//			'height' => '350',
			//			'color' => 'CCCCCC',
			//			'fullscreen' => 1,
			//			'autoplay' => 0,
			//			'loop' => 0,
			//			'hd' => 0 // alta definzione
			//		);
			//------------------------------------------------------------------------------
			case 'youTube':
			{
				require_once("classes/sp.youtube.json.php");
				$__VIDEO = new spYouTube($variable);

				if(array_key_exists("getTitle",(array)$value))
				{
					$operatorValue = $__VIDEO->getTitle();
				}
				elseif(array_key_exists("getDescription",(array)$value))
				{
					$operatorValue = $__VIDEO->getDescription();
				}
				elseif(array_key_exists("getAuthor",(array)$value))
				{
					$operatorValue = $__VIDEO->getAuthor();
				}
				elseif(array_key_exists("getTags",(array)$value))
				{
					$operatorValue = $__VIDEO->getTags();
				}
				elseif(array_key_exists("getThumb",(array)$value))
				{
					$__IMAGE = $value['getThumb'];
					$operatorValue = $__VIDEO->getThumb($__IMAGE);
				}
				elseif(array_key_exists("embedVideo",(array)$value))
				{
					$operatorValue = $__VIDEO->embedVideo($value['embedVideo']);
				}
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'arrayCountValues':
			{
				$__VALUES = array_count_values($value);
				if($variable != '')
					$operatorValue = $__VALUES[$variable];
				else
					$operatorValue = $__VALUES;
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'arrayKey':
			{
				$operatorValue = array_key_exists($variable,$value);
				break;
			}
			//---------------------------------------------------------------------------------
			//
			//---------------------------------------------------------------------------------
			case 'strReplace':
			{
				//strReplace('COSA',$value)
				$operatorValue = str_replace($value[0],$value[1],$variable);
				break;
			}
		}//end switch
	}
	//---------------------------------------------------------------------------------
	//
	//---------------------------------------------------------------------------------
	static function makePDF($__BODY, $__FILE_NAME = "", $__PDF_MARGIN_LEFT = 10, $__PDF_MARGIN_TOP = 10 , $__PDF_MARGIN_RIGHT = 10)
	{
		require_once('tcpdf/tcpdf.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetMargins($__PDF_MARGIN_LEFT, $__PDF_MARGIN_TOP, $__PDF_MARGIN_RIGHT, true);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->setLanguageArray($l);

		$pdf->setPrintFooter(false);

		$pdf->setFontSubsetting(true);

		$pdf->SetFont('dejavusans', '', 8, '');

		$pdf->AddPage();

		$pdf->writeHTML($__BODY, true, false, true, false, '');

		//echo "<pre>";
		//print_r($pdf);
		//echo "</pre>";
		//$pdf->Output($__FILE_NAME, 'I');

		return $pdf->Output($__FILE_NAME, 'S');
		//return $pdf;
	}
}
?>
