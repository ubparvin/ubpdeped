<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class CommonComponent extends Component
{
    
	public function imageDIR($type=null){
		switch($type){
			case "display":
				$dir = dirname($_SERVER['DOCUMENT_ROOT']).'/httpdocs/product_images/';
			break;
			case "web":
				$dir = "http://deped.ubivelox.com.ph/product_images/";
			break;
			case "image":
				$dir = dirname($_SERVER['DOCUMENT_ROOT']).'/httpdocs/dashboard/webroot/img/';
			break;
			default:
				$dir = dirname($_SERVER['DOCUMENT_ROOT']).'/httpdocs/product_images/Uploads/';
			break;
		}
		return $dir;
	}
	
	public function imagePublicUrl(){
		return 'http://localhost/JAMC_MARKETING/product_images/';
	}
	
	public function generateRString(){
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		
	    return strtoupper($str);
	}
	
	
	public function generateOTP(){
		$str = "";
		$characters = array_merge(range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < 6; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		
	    return strtoupper($str);
	}
	
	public function formatSeries($no){
		return str_pad($no, 8, "0", STR_PAD_LEFT);
	}
	
}