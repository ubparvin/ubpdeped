<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class UploadComponent extends Component
{	
		
		public function checkFolder($ldir=null){
			//$image_public_url =  dirname($_SERVER['DOCUMENT_ROOT']).'/htdocs/JAMC_MARKETING/product_images/';
			$fldir	= (!empty($ldir) ? $ldir : 'Uploads');
			//$dir 	= APP.'webroot/img/'.$fldir;
			//$dir 	= $image_public_url . $fldir;
			$dir 	= $fldir;
			$year 	= date('Y');
			$month 	= date('m');
			$day 	= date('d');
			
			
			if(is_dir($dir.'/'.$year) && is_writeable($dir.'/'.$year)){	
				if(is_dir($dir.'/'.$year.'/'.$month) && is_writeable($dir.'/'.$year.'/'.$month)){		
					return true;
				}else{
					if(mkdir($dir.'/'.$year.'/'.$month, 0777)){
						if(mkdir($dir.'/'.$year.'/'.$month.'/'.$day, 0777)){
							return true;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}
			}else{
				if(mkdir($dir.'/'.$year, 0777)){
					if(is_dir($dir.'/'.$year.'/'.$month) && is_writeable($dir.'/'.$year.'/'.$month)){		
						return true;
					}else{
						if(mkdir($dir.'/'.$year.'/'.$month, 0777)){
							if(mkdir($dir.'/'.$year.'/'.$month.'/'.$day, 0777)){
								return true;
							}else{
								return false;
							}
						}else{
							return false;
						}
					}
				}else{
					return false;
				}
			}
		}
		
		
		
		public function RenameandUpload($filename, $newfilename, $extension){
			$dir 			= APP.'webroot/Uploads/'.date('Y').'/'.date('m').'/';
			$upload_dir  	= $dir . basename($filename['name']);	
			
			
			if($this->checkFolder()){
				if(move_uploaded_file($filename['tmp_name'], $upload_dir)){
					$file_handler = fopen($upload_dir, 'r');	
					fclose($file_handler);
					if(!empty($newfilename)){
						if(rename($upload_dir, $dir.''.$newfilename.'.'.$extension)){			
							return true;
						}else{
							return false;
						}
					}else{
						return true;
					}				
				}else{
					return false;
				}
			}
		}
		
		public function uploadProductImage($filename, $upload_dir, $public_dir){
			
			
			if($this->checkFolder($public_dir)){
				if(move_uploaded_file($filename['tmp_name'], $upload_dir)){
					$file_handler = fopen($upload_dir, 'r');	
					fclose($file_handler);
					return true;			
				}else{
					return false;
				}
			}
		}
		
		
	}
?>