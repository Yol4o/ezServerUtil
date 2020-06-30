<?php

/**
* @author: Pierandrea Della Putta
*/
	class interlineAjax extends ezjscServerFunctions
	{
		//---------------------------------------------------------------------------------------------
		//
		//---------------------------------------------------------------------------------------------
		private static function loadIni()
		{
			return eZINI::instance('interline_ajax.ini')->variable( 'LOAD_TEPLATE', 'load_map_array' );
		}
		
		//---------------------------------------------------------------------------------------------
		//
		//---------------------------------------------------------------------------------------------
		public static function loadTemplate()
		{
			$http = eZHTTPTool::instance();
			$__TEMPLATE = $http->postVariable( 'template' );
			$__RETURN = '';
			if($__TEMPLATE != '')
			{
				$__LOAD_MAP_ARRAY = self::loadIni();
				$tpl = eZTemplate::factory();
				$__RETURN = $tpl->fetch( 'design:'.$__LOAD_MAP_ARRAY[$__TEMPLATE] );
			}
// 			return json_encode($__RETURN);
   			return base64_encode($__RETURN);
//  			return '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FHotelSerenaAndalo&amp;width=950&amp;height=558&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=true&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:950px; height:558px;" allowTransparency="true"></iframe>';
		}
	}
?>
