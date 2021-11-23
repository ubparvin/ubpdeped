<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;


require_once(ROOT . DS . 'vendor' . DS  . 'imagine' . DS . 'autoload.php');

use Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\Image;
//use Imagine\Gd\Imagine;





class ProductsController extends AppController {
	
    public function initialize(): void {
        parent::initialize();
		$this->set('title', 'Inventory Management');
	 }
	
	public function view($id=null, $refid=null){
		$product=  $this->Products->get($id, [
			'contain' => ['Productimages', 'Taggings', 'Categories', 'Subcategories', 'Programs'],
			'refid'	=> $refid
		]);
		
		
		$this->set(compact('product'));
		$this->set('img_dir', $this->Common->imageDIR("web"));
		  
	}
	
	public function postimage(){
		$this->ajaxLayout();
		if($this->request->is('ajax')){
			
			$respcode 		= 0;
			$msg			= '';
			$ndata			= array();
			
			$form_data 	= $this->request->getData();
			$id 		= $_POST['id'];
			$refid 		= $_POST['refid'];
			$imagine 		= new Imagine\Gd\Imagine();
						
			
			if(!empty($id) && !empty($refid)){
				$product = $this->Products->get($id, [
					'contain' => ['Productimages'],
					'refid' => $refid
				]);
				
				if(!empty($product)){
					if(isset($_FILES["imagefile"])){
						$error = $_FILES["imagefile"]["error"];						
						if($error){
							$msg = "You have uploaded an invalid file";
						}else{
							if(!is_array($_FILES["imagefile"]["name"])){
								$fileName 		= $_FILES["imagefile"];
								//$upload_dir		= date('Y').'/'.date('m').'/'.date('d');
								//$check_dir 		= ROOT . DS . 'webroot/img/products';
								$upload_folder	= 'Uploads/'.date('Y').'/'.date('m').'/'.date('d').'/'.basename($fileName['name']);
								$dir 			= $this->Common->imageDIR() . date('Y').'/'.date('m').'/'.date('d').'/';
								$upload_dir  	= $dir . basename($fileName['name']);	
									
								if($this->Upload->uploadProductImage($fileName, $upload_dir, $this->Common->imageDIR())){		
									$_image = $imagine->open($upload_dir);
									$_image->save($dir . basename($fileName['name']).'.webp', array('webp_quality' => 50));
									//$respcode = 1;
								
									 $pimage = $product->productimages[0]->id;
									 
									 if(!empty($pimage)){
										//update the image file
										$productimage = $this->Products->Productimages->get($pimage, [
											'contain' => [],
										]);
										
										$productimage = $this->Products->Productimages->patchEntity($productimage, $this->request->getData());
										$productimage->file = $upload_folder;
										$productimage->modified = date('Y-m-d H:i:s');
										
										if($this->Products->Productimages->save($productimage)){
											
											$msg = "Product image has been updated.";
										}else{
											
											$msg = "Product image upload failed. Please try again.";
										}
										
									 }else{
										 $productimage = $this->Products->Productimages->newEmptyEntity();
										 $data_to_save = array(
											'product_id' => $product->id,
											'file'		=> $upload_folder,
											'added'		=> date('Y-m-d H:i:s'),
											'modified'	=> date('Y-m-d H:i:s'), 
										 );
										 
										 $productimage = $this->Products->Productimages->newEntity($data_to_save, ['validation' => false]);
										if($this->Products->Productimages->save($productimage)){
											
											$msg = "New product image has been uploaded.";
										}else{
											$msg = "Product image upload failed. Please try again.";
										}
									 }
								}else{
									$msg = "File upload failed. Please try again.";
								}
								
								
								
								
								
							}else{
								$msg = "You have uploaded an invalid file";
							}
						}
					}else{
						$msg = "Unable to read the file, please try again";
					}
				}else{
					$msg = "Product record  not found ";
				}
			}else{
				$msg = "Product record  not found ";
			}
			
			
		    $this->log($this->getTheAuthor()."SUCCESSFULLY UPLOADED PRODUCT IMAGE #".$id, "_info");
			
			echo json_encode(array("respcode" => $respcode, "message" => $msg, "data" => $_data));	
			
		}
	
	}
	
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	private function getTheAuthor(){
		$name = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
		$id   = $this->Auth->user('id');
		return $name." (#".$id.") ";
	}
	
	public function saveajax(){
			$this->ajaxLayout();
			
			 $product = $this->Products->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_product = $this->request->getData();
				$product = $this->Products->patchEntity($product, $this->request->getData());
				
				$product->subitem_id 	= 1;
				$product->status 	= 'ACTIVE';
				$product->added 	= date('Y-m-d H:i:s');
				$product->added_by 	= $this->Auth->user('refid');
				$product->refid 	= str_replace(" ", "", microtime() . $this->Common->generateRString());

				
				$resp 	= 0;
				
				if ($this->Products->save($product)) {
					$this->log($this->getTheAuthor()."SUCCESSFULLY ADDED NEW PRODUCT ITEM: ".$_product['name']." SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($product->getErrors()){
						//$this->log(json_encode($product->getErrors()));
						$error_msg = [];
						foreach( $product->getErrors() as $errors){
							if(is_array($errors)){
								foreach($errors as $error){
									$error_msg[]    =   $error;
								}
							}else{
								$error_msg[]    =   $errors;
							}
						}

						if(!empty($error_msg)){
							
							$err = $error_msg[0];
						}
					}
					
					$msg = $this->Message->showMsg('save_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
			}
			
			$this->set(compact('product'));
	}
		

   public function indexajax($type=null, $program_id=null, $category_id=null, $vendor_id=null, $tagging_id=null, $subcategory_id=null){
		$this->ajaxLayout();
		
		//echo $request->getParam('_csrfToken');
		
		if($this->request->is('ajax')){
			
			$data = array();
			$db =  ConnectionManager::get('default');
			//$this->log(json_encode($_POST)); 
			
			$draw 				= $_POST['draw'];
			$row 				= $_POST['start'];
			$rowperpage 		= ((isset($_POST['length']) && $_POST['length'] > 0) ? $_POST['length'] : -1); // Rows display per page
			$columnIndex 		= $_POST['order'][0]['column']; //Column index
			$columnName 		= $_POST['columns'][$columnIndex]['data']; // Column name
		
			
			switch($columnName){
				case "NAME":
					$columnName = 'name';
				break;
				case "EXPIRATION":
					$columnName = 'expiration';
				break;
				case "WARRANTY EXPIRES":
					$columnName = 'warranty_expires';
				break;
				case "QUANTITY":
					$columnName = 'qty';
				break;
				case "REGISTERED":
					$columnName = 'added';
				break;
				case "MODIFIED":
					$columnName = 'modified';
				break;
				case "STATUS":
					$columnName = 'status';
				break;
				default:
					$columnName = 'name';
				break;
			}
			
			$columnSortOrder 	= $_POST['order'][0]['dir']; // asc or desc
			
			## Search 
			$searchValue = '';
			$searchQuery = '';
			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
				
			if((isset($type) && !empty($type)) && $type=="filter"){
				
				$where = " WHERE p.id > 1";
				
				if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
					$searchValue = $_POST['search']['value']; // Search value
					$searchQuery = " AND (p.name like '%".$searchValue."%') OR (p.subname like '%".$searchValue."%')";
				}
				
				$fquery = "";
				$fquery_p = "";
				$fquery_c = "";
				$fquery_v = "";
				$fquery_t = "";
				$fquery_s = "";
				
				if(!empty($program_id)){
					$fquery_p = " AND p.program_id ='".$program_id."' ";
				}
				
				if(!empty($category_id)){
					$fquery_c = " AND p.category_id ='".$category_id."' ";
				}
				
				if(!empty($vendor_id)){
					$fquery_v = " AND p.vendor_id ='".$vendor_id."' ";
				}
				
				if(!empty($tagging_id)){
					$fquery_t = " AND p.tagging_id ='".$tagging_id."' ";
				}
				
				if(!empty($subcategory_id)){
					$fquery_s = " AND p.subcategory_id ='".$subcategory_id."' ";
				}
				
				$fquery = $fquery_p . $fquery_c . $fquery_v . $fquery_t . $fquery_s;
				
				$q1 					= "SELECT count(*) as allcount FROM products as p " . $where . $fquery;
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM products as p " . $where . $fquery . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
			
			
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program, pi.file as image 
				FROM products as p 
				LEFT JOIN categories as c ON c.id = p.category_id 
				LEFT JOIN subcategories as sc ON sc.id = p.subcategory_id 
				LEFT JOIN taggings as t ON t.id = p.tagging_id  
				LEFT JOIN vendors as v ON v.id = p.vendor_id 
				LEFT JOIN programs as pro ON pro.id = p.program_id 
				LEFT JOIN productimages as pi ON pi.product_id = p.id ".$where .  $fquery . $searchQuery." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;
				
			}else{
			
				if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
					$searchValue = $_POST['search']['value']; // Search value
					$searchQuery = " WHERE (p.name like '%".$searchValue."%') OR (p.subname like '%".$searchValue."%')";
				}
				
				$q1 					= "SELECT count(*) as allcount FROM products";
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM products as p " . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
				
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program, pi.file as image 
				FROM products as p 
				LEFT JOIN categories as c ON c.id = p.category_id 
				LEFT JOIN subcategories as sc ON sc.id = p.subcategory_id 
				LEFT JOIN taggings as t ON t.id = p.tagging_id  
				LEFT JOIN vendors as v ON v.id = p.vendor_id 
				LEFT JOIN programs as pro ON pro.id = p.program_id 
				LEFT JOIN productimages as pi ON pi.product_id = p.id 
				".$searchQuery." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;
				
			}
		
			

			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
					
				   $image = $this->Common->imageDIR("web") . 'no_image.jpg';
				   if(!empty($c['image'])){
					$image = $this->Common->imageDIR("web") . $c['image'].'.webp';
				   }
				   
				   $image_link 		=  Router::url(['controller' => 'products', 'action' => 'uploadimage', $c['id'], $c['refid']]);
				   $release_link 	=  Router::url(['controller' => 'distributions', 'action' => 'releaseitem', $c['id'], $c['refid']]);
				   $receive_link 	=  Router::url(['controller' => 'transactions', 'action' => 'receiveitem', $c['id'], $c['refid']]);
				   $view_link 		=  Router::url(['controller' => 'products', 'action' => 'view', $c['id'], $c['refid']]);
				   $edit_link 		=  Router::url(['controller' => 'products', 'action' => 'edit', $c['id']]);
				   
				   $data[] = array( 
						'proimg'		=> '<a href="'.$image_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Upload Product Image" note ="Required fields are marked with *" class="modal_view">
							<img src="'.$image.'" class="img-responsive" />
							</a>',
						'name'			=> '<div>'.$c['name'].'</div>
						<div class="fs-9 text-warning">SUB-ITEM : '.(!empty($c['subname']) ? $c['subname'] : "N/A").'</div>
						<div class="fs-9 text-warning">CATEGORY : '.$c['category'].'</div>
						<div class="fs-9 text-warning">SUB-CATEGORY : '.$c['subcategory'].'</div>
						<div class="fs-9 text-warning">TAGGING : '.$c['tagging'].'</div>
						<div class="fs-9 text-warning">SUPPLIER/VENDOR : '.$c['vendor'].'</div>
						<div class="fs-9 text-warning">PROGRAM : '.$c['program'].'</div>',
						'qty'			=> '<div class="fs-14 bold">'.$c['on_hand'].'</div><div>'.$c['tagging'].'</div>',
						'registered'	=> $c['added'].'<div class="text-warning fs-8">'.$c['added_by'].'</div>',
						'modified'		=> $c['modified'].'<div class="text-warning fs-8">'.$c['modified_by'].'</div>',
						'status'		=> $c['status'],
						'action' 		=> '<a href="'.$edit_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Register New Item" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-danger fs-8 bold  noborder"><i class="fa fa-edit fa-lg"></i> EDIT</a>
						<a href="'.$release_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Distribute Item to School / Branch" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-success fs-8 bold  noborder"><i class="fa fa-shipping-fast fa-lg"></i> DISTRIBUTE</a>
						<a href="'.$receive_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Received Item" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-success fs-8 bold  noborder"><i class="fa fa-gift fa-lg"></i> RECEIVE</a>
						<a href="'.$view_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Item Details" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-success fs-8 bold  noborder"><i class="fa fa-eye fa-lg"></i> VIEW</a>'
									
				   );
				endforeach;
			endif;	
				 
			## Response
			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecords,
			  "iTotalDisplayRecords" => $totalRecordwithFilter,
			  "aaData" => $data
			);

			echo json_encode($response);
			die();
		}
	}
	
	public function requestsupplyajax($type=null, $program_id=null, $category_id=null, $vendor_id=null, $tagging_id=null, $subcategory_id=null, $source=null){
		$this->ajaxLayout();
		
		//echo $request->getParam('_csrfToken');
		
		if($this->request->is('ajax')){
			
			$data = array();
			$db =  ConnectionManager::get('default');
			//$this->log(json_encode($_POST)); 
			
			$draw 				= $_POST['draw'];
			$row 				= $_POST['start'];
			$rowperpage 		= ((isset($_POST['length']) && $_POST['length'] > 0) ? $_POST['length'] : -1); // Rows display per page
			$columnIndex 		= $_POST['order'][0]['column']; //Column index
			$columnName 		= $_POST['columns'][$columnIndex]['data']; // Column name
		
			
			switch($columnName){
				case "ITEM DETAILS":
					$columnName = 'name';
				break;
				case "EXPIRATION":
					$columnName = 'expiration';
				break;
				case "WARRANTY EXPIRES":
					$columnName = 'warranty_expires';
				break;
				case "QUANTITY":
					$columnName = 'qty';
				break;
				case "REGISTERED":
					$columnName = 'added';
				break;
				case "MODIFIED":
					$columnName = 'modified';
				break;
				case "STATUS":
					$columnName = 'status';
				break;
				default:
					$columnName = 'name';
				break;
			}
			
			$columnSortOrder 	= $_POST['order'][0]['dir']; // asc or desc
			
			## Search 
			$searchValue = '';
			$searchQuery = '';
			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
				
			if((isset($type) && !empty($type)) && $type=="filter"){
				
				$where = " WHERE p.id > 1";
				
				if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
					$searchValue = $_POST['search']['value']; // Search value
					$searchQuery = " AND (p.name like '%".$searchValue."%') OR (p.subname like '%".$searchValue."%')";
				}
				
				$fquery = "";
				$fquery_p = "";
				$fquery_c = "";
				$fquery_v = "";
				$fquery_t = "";
				$fquery_s = "";
				
				if(!empty($program_id)){
					$fquery_p = " AND p.program_id ='".$program_id."' ";
				}
				
				if(!empty($category_id)){
					$fquery_c = " AND p.category_id ='".$category_id."' ";
				}
				
				if(!empty($vendor_id)){
					$fquery_v = " AND p.vendor_id ='".$vendor_id."' ";
				}
				
				if(!empty($tagging_id)){
					$fquery_t = " AND p.tagging_id ='".$tagging_id."' ";
				}
				
				if(!empty($subcategory_id)){
					$fquery_s = " AND p.subcategory_id ='".$subcategory_id."' ";
				}
				
				$fquery = $fquery_p . $fquery_c . $fquery_v . $fquery_t . $fquery_s;
				
				$q1 					= "SELECT count(*) as allcount FROM products as p " . $where . $fquery;
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM products as p " . $where . $fquery . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
			
			
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM products as p 
				LEFT JOIN categories as c ON c.id = p.category_id 
				LEFT JOIN subcategories as sc ON sc.id = p.subcategory_id 
				LEFT JOIN taggings as t ON t.id = p.tagging_id  
				LEFT JOIN vendors as v ON v.id = p.vendor_id 
				LEFT JOIN programs as pro ON pro.id = p.program_id ".$where .  $fquery . $searchQuery." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;
				
			}else{
			
				if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
					$searchValue = $_POST['search']['value']; // Search value
					$searchQuery = " WHERE (p.name like '%".$searchValue."%') OR (p.subname like '%".$searchValue."%')";
				}
				
				$q1 					= "SELECT count(*) as allcount FROM products";
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM products as p " . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
				
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM products as p 
				LEFT JOIN categories as c ON c.id = p.category_id 
				LEFT JOIN subcategories as sc ON sc.id = p.subcategory_id 
				LEFT JOIN taggings as t ON t.id = p.tagging_id  
				LEFT JOIN vendors as v ON v.id = p.vendor_id 
				LEFT JOIN programs as pro ON pro.id = p.program_id  
				".$searchQuery." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;
				
			}
		
			

			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				switch($source){
					case "for_order":
						foreach($empRecords as $c):
						   $link =  Router::url(['controller' => 'products', 'action' => 'viewforrequest', $c['id']]);
							$data[] = array( 
								'id'			=> '<div>'.$c['id'].'</div>',
								'name'			=> '<div>'.$c['name'].'</div>
								<div class="fs-9 text-warning">SUB-ITEM : '.(!empty($c['subname']) ? $c['subname'] : "N/A").'</div>
								<div class="fs-9 text-warning">CATEGORY : '.$c['category'].'</div>
								<div class="fs-9 text-warning">SUB-CATEGORY : '.$c['subcategory'].'</div>
								<div class="fs-9 text-warning">TAGGING : '.$c['tagging'].'</div>
								<div class="fs-9 text-warning">SUPPLIER/VENDOR : '.$c['vendor'].'</div>
								<div class="fs-9 text-warning">PROGRAM : '.$c['program'].'</div>',
								'action' 		=> '<a href="'.$link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Request Item Supply" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-success fs-10"><i class="fa fa-plus-circle fa-lg"></i>ADD TO ORDER</a>'
											
						   );
						endforeach;
					break;
					case "for_request":
						foreach($empRecords as $c):
						   $link =  Router::url(['controller' => 'products', 'action' => 'viewforrequest', $c['id']]);
						   $data[] = array( 
								'id'			=> '<div>'.$c['id'].'</div>',
								'name'			=> '<div>'.$c['name'].'</div>
								<div class="fs-9 text-warning">SUB-ITEM : '.(!empty($c['subname']) ? $c['subname'] : "N/A").'</div>
								<div class="fs-9 text-warning">CATEGORY : '.$c['category'].'</div>
								<div class="fs-9 text-warning">SUB-CATEGORY : '.$c['subcategory'].'</div>
								<div class="fs-9 text-warning">TAGGING : '.$c['tagging'].'</div>
								<div class="fs-9 text-warning">SUPPLIER/VENDOR : '.$c['vendor'].'</div>
								<div class="fs-9 text-warning">PROGRAM : '.$c['program'].'</div>',
								'action' 		=> '<a href="'.$link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Request Item Supply" note ="Required fields are marked with *" class="modal_view btn btn-xs btn-success fs-10"><i class="fa fa-plus-circle fa-lg"></i> REQUEST FOR SUPPLY</a>'
											
						   );
						endforeach;
					break;
					default:
						foreach($empRecords as $c):
						  // $link =  Router::url(['controller' => 'products', 'action' => 'viewforrequest', $c['id']]);
						   $data[] = array( 
								'id'			=> '<div>'.$c['id'].'</div>',
								'name'			=> '<div>'.$c['name'].'</div>
								<div class="fs-9 text-warning">SUB-ITEM : '.(!empty($c['subname']) ? $c['subname'] : "N/A").'</div>
								<div class="fs-9 text-warning">CATEGORY : '.$c['category'].'</div>
								<div class="fs-9 text-warning">SUB-CATEGORY : '.$c['subcategory'].'</div>
								<div class="fs-9 text-warning">TAGGING : '.$c['tagging'].'</div>
								<div class="fs-9 text-warning">SUPPLIER/VENDOR : '.$c['vendor'].'</div>
								<div class="fs-9 text-warning">PROGRAM : '.$c['program'].'</div>',
								
								'action' 		=> '<a href="#" item-id="'.$c['id'].'" class="btn add_order btn-xs btn-success fs-10 noradius btn-block"><i class="fa fa-plus-circle fa-lg"></i>ADD TO ORDER</a>'
											
						   );
						endforeach;
					break;
				}
				
			endif;	
				 
			## Response
			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecords,
			  "iTotalDisplayRecords" => $totalRecordwithFilter,
			  "aaData" => $data
			);

			echo json_encode($response);
			
		}
	}
	
	public function index(){
		$type = $this->request->getQuery('type');
		if(isset($type) && $type=="filter"){
			$params = base64_encode(json_encode(array(	
					'type'				=> $type,
					'program_id' 		=> $this->request->getQuery('program_id'),
					'category_id' 		=> $this->request->getQuery('category_id'),
					'vendor_id' 		=> $this->request->getQuery('vendor_id'),
					'tagging_id' 		=> $this->request->getQuery('tagging_id'),
					'subcategory_id' 	=> $this->request->getQuery('subcategory_id')
				)
			));
		}else{
			$params = "empty";
		}
		
		$this->set('params', $params);
	}
	
	public function requestsupply(){
		
		$school = $this->Auth->user('school_id');
		if(!empty($school)){
			$type = $this->request->getQuery('type');
			if(isset($type) && $type=="filter"){
				$params = base64_encode(json_encode(array(	
						'type'				=> $type,
						'program_id' 		=> $this->request->getQuery('program_id'),
						'category_id' 		=> $this->request->getQuery('category_id'),
						'vendor_id' 		=> $this->request->getQuery('vendor_id'),
						'tagging_id' 		=> $this->request->getQuery('tagging_id'),
						'subcategory_id' 	=> $this->request->getQuery('subcategory_id')
					)
				));
			}else{
				$params = "empty";
			}
		}else{
			$this->Flash->error('Unable to process your request. Your account does not have school information');
			return $this->redirect([
				'controller' => 'users',
				'action'	=> 'logout'
			]);
		}
		
		
		$this->set('params', $params);
	}
   
    public function settings(){
		$this->set('title', 'Inventory Settings');
	}

    public function add()
    {
        $product = $this->Products->newEmptyEntity();
		
        $categories 	= $this->Products->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Products->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Products->Subitems->find('list');
        $programs 		= $this->Products->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Products->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Products->Vendors->find('list')->where(['status' => 'ACTIVE']); //->where(['status' => 'ACTIVE']);

        $this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
    }

	public function import(){
        $product = $this->Products->newEmptyEntity();
        $this->set(compact('product'));
    }
	
	public function uploadimage($id=null, $refid=null){
       $product = $this->Products->get($id, [
			'contain' => ['Productimages'],
			'refid' => $refid
	   ]);
	   
	  
	   $this->set(compact('product'));
	   
    }
	
	public function filter(){
		
		/*if($this->request->is('post')){
			$_filter = $this->request->getData();
			
			$items = $this->Products->find()
					->where([
						'program_id' => (!empty($_filter['program_id']) ? $_filter['program_id'] : " > 0")
					])
					->order(['name' => 'ASC'])
					->all();
			
			$this->set('items', $items);
			
		}else{*/
			$product 		= $this->Products->newEmptyEntity();
			$categories 	= $this->Products->Categories->find('list');
			$subcategories 	= $this->Products->Subcategories->find('list');
			$subitems 		= $this->Products->Subitems->find('list');
			$programs 		= $this->Products->Programs->find('list');
			$taggings 		= $this->Products->Taggings->find('list');
			$vendors 		= $this->Products->Vendors->find('list');
		
			$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'subitems', 'programs'));
		//}
    
    }
	
	/*
	public function importproductstest(){
		$this->ajaxLayout();
		$program = $this->Products->Programs->findByName("TVL", ['contain' => []]);
		$program = $program->first();
		//$program->find('first');
		echo $program->id;
		
	}*/
	
	public function importproducts(){
		$this->ajaxLayout();
		if($this->request->is('ajax')){
			
			
			
			$respcode 		= 0;
			$_data 	  		= '';
			$msg			= '';
			$row 			= 1;
			$_added 		= 0;
			$_notadded 		= 0;
			$ndata			= array();
			
			if(isset($_FILES["branchfile"])){
				$error = $_FILES["branchfile"]["error"];						
				if($error){
					$msg = "You have uploaded an invalid file";
				}else{
					if(!is_array($_FILES["branchfile"]["name"])){
						$fileName 		= $_FILES["branchfile"];
						$_data .='<table class="table table-condensed table-striped fs-10">';
						$_data .='<thead><tr class="bold text-danger">';
							$_data .='<th>#</th>';
							//$_data .='<th>PROGRAM</th>';
							//$_data .='<th>CATEGORY</th>';
							//$_data .='<th>SUB-CATEGORY</th>';
							$_data .='<th>ITEM</th>';
							$_data .='<th>SUB-ITEM</th>';
							//$_data .='<th>TAGGING</th>';
							//$_data .='<th>DATE RECEIVED</th>';
							//$_data .='<th>LOCATION</th>';
							//$_data .='<th>LIFESPAN</th>';
							//$_data .='<th>WARRANTY EXPIRES</th>';
							//$_data .='<th>MAINTENANCE</th>';
							$_data .='<th>STATUS</th>';
						$_data .='</tr></thead>';
						$_data .='<tbody>';
						if (($handle = fopen($fileName["tmp_name"], "r")) !== FALSE) {
							fgets($handle);  // read one line for nothing (skip header)
							while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
									
									$data = array_map("utf8_encode", $data); //added
									$item 			= strtoupper(trim($data[3]));
									
									
									if(!empty($item)){
										$respcode = 1;
										$category 		= strtoupper(trim($data[1]));
										if(!empty($category)){
											$category = $this->Products->Categories->findByName($category, 
											['contain' => []]);
											$category = $category->first();
											$category = (!empty($category) ? $category->id : 98);
										}else{
											$category = 98;
										}
										
										
										$subcategory 	= strtoupper(trim($data[2]));
										if(!empty($subcategory)){
											$subcategory = $this->Products->Subcategories->findByName($subcategory, 
											['contain' => []]);
											$subcategory = $subcategory->first();
											$subcategory =(!empty($subcategory) ? $subcategory->id : 14);
										}else{
											$subcategory = 14;
										}
										
										
										$program 		= strtoupper(trim($data[0]));
										if(!empty($program)){
											$program = $this->Products->Programs->findByName($program, 
											['contain' => []]);
											$program  = $program->first();
											$program  = (!empty($program) ? $program->id : 6);
										}else{
											$program  = 6;
										}
										
										
										$subitem 		= strtoupper(trim($data[4]));
										
										$tagging 		= strtoupper(trim($data[5]));
										if(!empty($tagging)){
											$tagging = $this->Products->Taggings->findByName($tagging, 
											['contain' => []]);
											$tagging = $tagging->first();
											$tagging = (!empty($tagging) ? $tagging->id : 4);
										}else{
											$tagging = 4;
										}
										
										$date_received 	= strtoupper(trim($data[6]));
										$location 		= strtoupper(trim($data[7]));
										$lifespan 		= strtoupper(trim($data[8]));
										$warranty 		= strtoupper(trim($data[9]));
										$maintenance 	= strtoupper(trim($data[10]));
										
										
										
										
										
										
										
										/*$subitem = $this->Products->Subitems->findByName($subitem, 
										['contain' => [], 'fields' => ['id']]);
										$subitem = $subitem->first();*/
										
										
										
										//if(!empty($item)){
											
											$ndata = array(
												'refid' 			=> str_replace(" ", "", microtime() . $this->Common->generateRString()),
												'name'				=> $item,
												'subname'			=> (!empty($subitem) ? $subitem : "N/A"),
												'category_id'		=> $category,
												'subcategory_id'	=> $subcategory,
												'tagging_id'		=> $tagging,
												'program_id'		=> $program,
												'subitem_id'		=> 1, //(!empty($subitem) ? $subitem->id : 42),
												//'vendor_id'			=> $item,
												'label'				=> "N/A",
												'brand'				=> "N/A",
												'part_number'		=> "N/A",
												//'expiration'		=> $item,
												'qty'				=> 1,
												'on_hand'			=> 1,
												'date_received'		=> (!empty($date_received) ? $date_received : date('Y-m-d H:i:s')),
												'location'			=> $location,
												'lifespan'			=> $lifespan,
												'warranty_expires'	=> $warranty,
												'maintenance'		=> $maintenance,
												'status'			=> "ACTIVE",
												'added'				=> date('Y-m-d H:i:s'),
												'added_by'			=> $this->Auth->user('refid')
											);
											$product = $this->Products->newEmptyEntity();
											//$product = $this->Products->newEntity($product, ['validate' => true]);
											$product = $this->Products->newEntity($ndata, ['validate' => true]);
											
			
											if ($this->Products->save($product)) {
													$save_response = "Added";
													$_added++;
											}else{
													$_notadded++;
													
													$err = '';
													if($product->getErrors()){
														//$this->log(json_encode($product->getErrors()));
														$error_msg = [];
														foreach( $product->getErrors() as $errors){
															if(is_array($errors)){
																foreach($errors as $error){
																	$error_msg[]    =   $error;
																}
															}else{
																$error_msg[]    =   $errors;
															}
														}

														if(!empty($error_msg)){
															
															$err = $error_msg[0];
														}
													}
													
													$save_response = $err;
											}
										
											
											$_data .='<tr>';
												$_data .='<td>'.$row.'</td>';
												//$_data .='<td>'.$program->name.'</td>';
												//$_data .='<td>'.$category->name.'</td>';
												//$_data .='<td>'.$subcategory->name.'</td>';
												$_data .='<td>'.$item.'</td>';
												$_data .='<td>'.$subitem.'</td>';
												//$_data .='<td>'.$tagging->name.'</td>';
												//$_data .='<td>'.$date_received.'</td>';
												//$_data .='<td>'.$location.'</td>';
												//$_data .='<td>'.$lifespan.'</td>';
												//$_data .='<td>'.$warranty.'</td>';
												//$_data .='<td>'.$maintenance.'</td>';
												$_data .='<td>'.$save_response.'</td>';
											$_data .='</tr>';
										//}
									}
									
									$row++;
							}
						}
						$_data .='</tbody>';
					}else{
						$msg = "You have uploaded an invalid file";
					}
				}
			}else{
				$msg = "Unable to read the file, please try again";
			}
			
		    $this->log($this->getTheAuthor()."SUCCESSFULLY IMPORT A TOTAL PRODUCTS OF ".$_added." & TOTAL FAIL OF ".$_notadded, "_info");
			
			echo json_encode(array("respcode" => $respcode, "message" => $msg, "data" => $_data));	
			
		}
												
			
	}
	
	/*
	public function re_create_image($id=null){
		
		$this->ajaxLayout();
		
		if($this->request->is('ajax') && !empty($id)){	
			
			$imagine = new Imagine\Gd\Imagine();
			
			$this->Product->Behaviors->load('Containable');
			$this->Product->contain('Category', 'Productimage');
			$product = $this->Product->findById($id);
		
			if(!empty($product)){
				$image = $product['Productimage']['image'];
				if(!empty($image)){
					
					$dir 			= $this->Common->imageDIR('display');
					$upload_dir  	= $dir . $image;	
					
					if(file_exists($upload_dir)){
						$_image = $imagine->open($upload_dir);
						$_image->save($dir . $image.'.webp', array('webp_quality' => 50));
						$resp = $this->Message->respMsg(200, "Product image has been re-created.");
					}else{
						$resp = $this->Message->respMsg(400, "Unable to locate product image. Please try again.");
					}
				}else{
					$resp = $this->Message->respMsg(400, "Product image details not found. Please try again.");
				}
			}else{
				$resp = $this->Message->respMsg(400, "Product details not found. Please try again.");
			}
			
			return json_encode($resp);
		}
		
	}*/
	
	
	

   
    public function viewforrequest($id = null){
        $product = $this->Products->get($id, [
            'contain' => ['Categories', 'Subcategories', 'Taggings', 'Programs'],
        ]);
		
		$request = $this->Products->Requests->newEmptyEntity();
		
       // $categories 	= $this->Products->Categories->find('list')->where(['status' => 'ACTIVE']); 
        //$subcategories 	= $this->Products->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Products->Subitems->find('list');
       // $programs 		= $this->Products->Programs->find('list')->where(['status' => 'ACTIVE']); 
       // $taggings 		= $this->Products->Taggings->find('list')->where(['status' => 'ACTIVE']); 
      //  $vendors 		= $this->Products->Vendors->find('list')->where(['status' => 'ACTIVE']);

        //$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
        $this->set(compact('product', 'request'));

    }
	
	public function edit($id = null){
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
		
        $categories 	= $this->Products->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Products->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Products->Subitems->find('list');
        $programs 		= $this->Products->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Products->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Products->Vendors->find('list')->where(['status' => 'ACTIVE']);

        $this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));

    }
	
	public function editajax($id = null){
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			$_product 	= $this->request->getData();
            $product 	= $this->Products->patchEntity($product, $this->request->getData());
			
			$product->modified 		= date('Y-m-d H:i:s');
			$product->modified_by 	= $this->Auth->user('refid');
			
            if ($this->Products->save($product)) {
					$this->log($this->getTheAuthor()."SUCCESSFULLY MODIFIED PRODUCT (#".$id.") NEW ITEM: ".$_product['name']." NEW SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($product->getErrors()){
						$error_msg = [];
						foreach( $product->getErrors() as $errors){
							if(is_array($errors)){
								foreach($errors as $error){
									$error_msg[]    =   $error;
								}
							}else{
								$error_msg[]    =   $errors;
							}
						}

						if(!empty($error_msg)){
							
							$err = $error_msg[0];
						}
					}
					
					$msg = $this->Message->showMsg('update_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		$this->set(compact('product'));

    }
	
	
}
