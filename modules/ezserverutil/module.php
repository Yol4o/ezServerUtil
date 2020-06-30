<?php

$Module = array( "name" => "EzServerUtil" );

$ViewList = array();
$ViewList["action"] = array( 
								'functions' => array( 'action' ),
								"script" => "action.php"
							);
							
$ViewList["mailchimp"] = array(
								'functions' => array( 'mailchimp' ),
								"script" => "mailchimp.php",
								'params' => array(),
							);
$FunctionList = array(); 
$FunctionList['action'] = array();
$FunctionList['mailchimp'] = array();

?>