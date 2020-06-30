<?php
	//------------------------------------------------------------------------------
	//
	//------------------------------------------------------------------------------
	$module = $Params['Module'];
	$tpl = eZTemplate::factory();
	$http = eZHTTPTool::instance();
    $ini = eZINI::instance();
    //------------------------------------------------------------------------------
	$__CLASS_IDENTIFIER_ORDER_PRODUCT = 'order_product';
	$__CLASS_IDENTIFIER_ORDER_BUSINESS_NET = 'business_net_order';
	$__CURRENT_USER = &eZUser::currentUser();
	$__CURRENT_USER_CONTENT_OBJECT = &$__CURRENT_USER->attribute( "contentobject" );
	$__CURRENT_USER_NODE_ID = $__CURRENT_USER_CONTENT_OBJECT->attribute('main_node_id');
	$__USER = eZUser::fetchByName( 'admin' );
	//------------------------------------------------------------------------------

	$__OBJ_IMPOSTAZIONI_SITO_DATA_MAP = $_SESSION['__OBJ_IMPOSTAZIONI_SITO']->datamap();
// 	business_net_email
// 	echo "<pre>";
// 	print_r($ini->variable( 'MailSettings', 'EmailSender' ));
// 	echo "</pre>";
// 	die("---------- FINE PREVENTIVA!");
	
	$__MAIL_STATUS = "(error)";

	if ( $http->hasPostVariable( 'SUBMIT_ORDER' ) )
	{
		//-- ORDER_BUSINESS_NET --
		$params = array();
		$params['class_identifier'] = $__CLASS_IDENTIFIER_ORDER_BUSINESS_NET;
		$params['creator_id'] = $__USER->ContentObjectID;//admin
		$params['parent_node_id'] = $__CURRENT_USER_NODE_ID;

		$attributesData = array ( ) ;
		$attributesData['order_name'] = "Ordine in data";
		$attributesData['order_data'] = $http->postVariable( 'ORDER_DATE' );
		$attributesData['order_agent_name'] = $__CURRENT_USER_CONTENT_OBJECT->Name;
		$attributesData['order_day_off'] = $http->postVariable( 'ORDER_DAY_OFF' );
		$attributesData['order_day_give'] = $http->postVariable( 'ORDER_DAY_OF_GIVE_UP' );
		$attributesData['order_telephone'] = $http->postVariable( 'PRE_TEL' );
		$attributesData['order_new_client'] = $http->postVariable( 'ORDER_NEW_CLIENT' );
		$attributesData['order_client_active'] = $http->postVariable( 'ORDER_ACTIVE_CLIENT' );
		$attributesData['order_client_name'] = $http->postVariable( 'ORDER_CLIENT_REFERENCE' );
		$attributesData['order_address'] = $http->postVariable( 'ORDER_CLIENT_ADDRESS' );
		$attributesData['order_address_place'] = $http->postVariable( 'ORDER_CLIENT_COUNTRY' );
		$attributesData['order_zip'] = $http->postVariable( 'ORDER_CLIENT_ZIP' );
		$attributesData['order_alt_adress'] = $http->postVariable( 'ORDER_CLIENT_ALTERNATIVE_ADDRESS' );
		$attributesData['order_client_vat'] = $http->postVariable( 'ORDER_CLIENT_VAT' );
		$attributesData['order_cf'] = $http->postVariable( 'ORDER_CLIENT_CF' );
		$attributesData['order_client_bank'] = $http->postVariable( 'ORDER_CLIENT_BANK_NAME' );
		$attributesData['order_bank_iban'] = $http->postVariable( 'ORDER_CLIENT_BANK_IBAN' );
		$attributesData['order_client_activity'] = $http->postVariable( 'ORDER_CLIENT_ACTIVITY' );
		$attributesData['order_payment_methood'] = $http->postVariable( 'ORDER_PAYMENT_METHOD' );
		$attributesData['order_total'] = $http->postVariable( 'final_tot_ordine' );
		$attributesData['order_total_to_pay'] = $http->postVariable( 'final_tot_da_pagare' );
		$attributesData['order_total_with_vat'] = $http->postVariable( 'final_tot_fattura' );
		
		
		$params['attributes'] = $attributesData;
		$__ORDER_BUSINESS_NET_CONTENT_OBJECT = eZContentFunctions::createAndPublishObject($params);

		if($__ORDER_BUSINESS_NET_CONTENT_OBJECT)
		{
			$__ARRAY_CHECK_CREATE = array();
			$params = array();
			$params['class_identifier'] = $__CLASS_IDENTIFIER_ORDER_PRODUCT;
			$params['creator_id'] = $__USER->ContentObjectID;//admin
			$params['parent_node_id'] = $__ORDER_BUSINESS_NET_CONTENT_OBJECT->attribute('main_node_id');
			
			foreach($_POST['PRODUCT_NODE_ID'] as $__POSITION => $__NODE_ID)
			{
				$attributesData = array( );
				$attributesData['order_product_name'] = $_POST['PRODUCT_NAME'][$__POSITION];
				$attributesData['order_product_site'] = $_POST['SITE_REFERENCE'][$__POSITION];
				$attributesData['order_product_line_site'] = $_POST['PRODUCT_LINE'][$__POSITION];
				$attributesData['order_product_price'] = $_POST['PRODUCT_PRICE'][$__POSITION];
				$attributesData['order_product_disconut'] = $_POST['PRODUCT_DISCOUNT'][$__POSITION];
				$attributesData['order_product_quantity'] = $_POST['PRODUCT_QUANTITY'][$__POSITION];
				$attributesData['order_product_total'] = $_POST['PRODUCT_TOTAL_COST'][$__POSITION];
				$attributesData['order_product_year'] = $_POST['PRODUCT_YEAR'][$__POSITION];
				$attributesData['order_product_format'] = $_POST['PRODUCT_FORMAT'][$__POSITION];
				
				$params['attributes'] = $attributesData;
				$__ARRAY_CHECK_CREATE[] = eZContentFunctions::createAndPublishObject($params);
			}
			
			//TO DO: CONTROLLO SE OGNI OGGETTO DI TIPO Prodotto Ordinato NON È STATO CREATO, chi se ne frega,
			//tanto mando una mail con il riepilogo!!!
			
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$tpl = eZTemplate::factory();
			$tpl->setVariable( '__POST', $_POST );
			$tpl->setVariable( 'AGENT_NAME', $__CURRENT_USER_CONTENT_OBJECT->Name );
			//************
// 			$emailSender = "info@la-vis.com";
			$emailSender = $ini->variable( 'MailSettings', 'EmailSender' );
 			$emailAgent = $__CURRENT_USER->Email;
			$emailLa_Vis_Grup = $__OBJ_IMPOSTAZIONI_SITO_DATA_MAP['business_net_email']->DataText;
			//************
			
			$templateResult = $tpl->fetch( 'design:business_net/business_net_mail.tpl' );

			$mail = new ezcMailComposer();

			$mail->from = new ezcMailAddress( $emailSender, "Gruppo La-Vis Rete Commerciale" );
			$mail->subject = "Ordine Rete Commerciale effettuato in data ".$http->postVariable( 'ORDER_DATE' );
			$mail->addTo( new ezcMailAddress( $emailAgent, "" ) );
			$mail->htmlText = $templateResult;
			$mail->charset = 'utf-8';
			
			$mail->build();

			$transport = new ezcMailMtaTransport();
			try
			{
				$transport->send( $mail );
				$__MAIL_STATUS = "(ok)";
				
				$mail = new ezcMailComposer();

				$mail->from = new ezcMailAddress( $emailSender, "Gruppo La-Vis Rete Commerciale" );
				$mail->subject = "Ordine Rete Commerciale effettuato in data ".$http->postVariable( 'ORDER_DATE' );
				$mail->addTo( new ezcMailAddress( $emailLa_Vis_Grup, "" ) );
				$mail->htmlText = $templateResult;
				$mail->charset = 'utf-8';
				
				$mail->build();
				$transport = new ezcMailMtaTransport();
				try
				{
					$transport->send( $mail );
					$__MAIL_STATUS = "(ok)";
				} 
				catch(Exception $e) 
				{
					$__MAIL_STATUS = "(error2)";
				}
			} 
			catch(Exception $e) 
			{
				$__MAIL_STATUS = "(error1)";
			}
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		}
	}
	$module->redirectTo( $_POST['__URL__']."/".$__MAIL_STATUS );
?>
