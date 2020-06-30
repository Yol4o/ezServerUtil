<?php
	//------------------------------------------------------------------------------
	//
	//------------------------------------------------------------------------------
	$module = $Params['Module'];
	$tpl = eZTemplate::factory();
	$http = eZHTTPTool::instance();
    $ini = eZINI::instance();
	//------------------------------------------------------------------------------
	$__ERROR = '';
	
	if ( $http->hasPostVariable( 'email' ) && strlen($http->postVariable( 'email' )) > 0 )
	{
		//ELEMENTI HOME LIST
		$__MAIL_CHIMPKEY = "35f0bcc88b4888e3787fb0305e3c30ac-us7";
		$__LIST_ID = 'bfb860f05a';
		
		//INTERLINE LIST
		//$__MAIL_CHIMPKEY = "e7d34a7f6306099d447a43410b706ac9-us4";
		//$__LIST_ID = 'dd2868cc4b';
		
		$MailChimp = new MailChimp($__MAIL_CHIMPKEY);

		$__EMAIL_TO_SUBSCRIBE = $http->postVariable( 'email' );

		$__LIST_MEMBERS = $MailChimp->call('lists/members', array('id'=> $__LIST_ID,'status'=>'subscribed'));
		$__IN_LIST = false;
		foreach($__LIST_MEMBERS['data'] as $__SUBSCRIBER)
		{
			if($__SUBSCRIBER['email'] === $__EMAIL_TO_SUBSCRIBE)
			{
				$__IN_LIST = true;
				break;
			}
		}
		
		if(!$__IN_LIST)
		{
			$result = $MailChimp->call('lists/subscribe', array(
							'id'                => $__LIST_ID,
							'email'             => array('email'=>$__EMAIL_TO_SUBSCRIBE),
							'email_type'		=> 'html',
							'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
							'double_optin'      => true,
							'update_existing'   => false,
							'replace_interests' => false,
							'send_welcome'      => false,
						));

// 			print_r($result);
// 			die("------------- DEBUG INTERLINE --------------");
			eZHTTPTool::instance()->setSessionVariable( "__MAILCHIMP", true );
		}
		else
		{
			$__ERROR = "Gia iscritto alla lista";
		}
	}
	else
	{
		$__ERROR = "Inserire la mail";
	}
	
	if($__ERROR !== '') eZHTTPTool::instance()->setSessionVariable( "__ERROR", $__ERROR );
	
	//$tpl->setVariable( '__ERROR', $__ERROR);
	//$Result = array();
 	//$Result['content'] = $tpl->fetch( 'design:newsletter/newsletter_subscribe.tpl' );
//  	print_r($_POST);
//  	die("------------- DEBUG INTERLINE --------");
	$module->redirectTo( $_POST['__URL__'] );

?>
