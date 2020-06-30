<?php
/**
	spVideo v 1.0
	Copyright (c) 2009 Filippo Buratti; info [at] cssrevolt.com [dot] com; http://www.filippoburatti.net/

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

include("JSON.php"); // required for php version < 5.2
class spYouTube 
{
	private $videoId;
	public $media;
	public $json;
	private $error				= false;
	const YOUTUBE_API_URL 			= "http://gdata.youtube.com/feeds/api/videos/";
	const YOUTUBE_PLAYER_URL		= "http://www.youtube.com/v/";

	
	function __construct($videoUrl) 
	{
		if (preg_match("/^[^v]+v.(.{11}).*/",$videoUrl,$match)) 
		{
			$this->videoId = $match[1];
			$jsonData = spYouTube::YOUTUBE_API_URL.$this->videoId."?alt=json";		
			$this->getJSON($jsonData);
		} 
		else 
		{ 
			$this->error=true; 
		}
	}

	public function getJSON($jsonData) 
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $jsonData);
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		

		if ($output === false || $info['http_code'] != 200) 
		{
			$this->error = true;
		}
		else 
		{
  			$this->json = json_decode($output);			
		}
		curl_close($ch);			
	}
	
	public function getTitle() 
	{
		if(!$this->error) 
		{
	        	return $this->json->entry->title->{'$t'};
		}
	}
	
	public function getDescription() 
	{
		if (!$this->error)
		{
	        	return $this->json->entry->content->{'$t'};
		}
	}
	
	public function getAuthor() 
	{
		if (!$this->error) 
		{
        		return $this->json->entry->author[0]->name->{'$t'};
		}
	}
	
	public function getTags()
	{
		if (!$this->error)
		{
			return $this->json->entry->{'media$group'}->{'media$keywords'}->{'$t'};
		}
	}
	
	public function getThumb($size=2)
	{
		switch($size) 
		{
			case 'small':
			case 2:
				$size = 2;
				break;
			case 1:
				$size = 1;
				break;
			case 3:
				$size = 3;
				break;
	      		case 'large':
			case 0:
	         		$size = 0;
        	 		break;
			case 'medium':
	         		$size = 3;
        	 		break;
			default:
				$size = 2;
		}
		if (!$this->error) 
		{
			$thumbnail = $this->json->entry->{'media$group'}->{'media$thumbnail'}[$size]->{'url'};
			return $thumbnail;
		}
	}
	
	public function getPlayer() 
	{
		return spYouTube::YOUTUBE_PLAYER_URL.$this->videoId;
	}
	
	public function embedVideo($options='') 
	{
		$defaults = array(
				'width' => 425,
				'height' => 350,
				'color' => 'CCCCCC',
				'fullscreen' => 1,
				'autoplay' => 0,
				'loop' => 0,
				'hd' => 0
  				);
				
		$options = array_merge($defaults, (array)$options);
			
		if (!$this->error)
		{
			$data = $this->getPlayer();
			$html = "\n<object type=\"application/x-shockwave-flash\" width=\"".$options['width']."\" height=\"".$options['height']."\" data=\"".$data."&amp;fs=".$options['fullscreen']."&amp;autoplay=".$options['autoplay']."&amp;loop=".$options['loop']."&amp;color2=".$options['color']."&amp;hd=".$options['hd']."&amp;rel=0&amp;showinfo=0&amp;iv_load_policy=0\">\n";
			$html .= "\t<param name=\"movie\" value=\"".$data."&amp;fs=".$options['fullscreen']."&amp;autoplay=".$options['autoplay']."&amp;loop=".$options['loop']."&amp;color2=".$options['color']."&amp;hd=".$options['hd']."&amp;rel=0&amp;showinfo=0&amp;iv_load_policy=0\" />\n";
			$html .= "\t<param name=\"quality\" value=\"high\" />\n";
			$html .= "\t<param name=\"allowFullScreen\" value=\"true\" />\n";
			$html .= "\t<param name=\"AllowScriptAccess\" value=\"always\" />\n";
			$html .= "\t<param name=\"wmode\" value=\"transparent\" />\n";
			$html .= "\t<param name=\"scale\" value=\"showAll\" />\n";
			$html .= "</object>\n\n";
			return $html;
		}
	}
}
?>
