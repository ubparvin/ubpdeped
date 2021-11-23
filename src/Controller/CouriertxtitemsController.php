<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

/*
require_once(ROOT . DS . 'vendor' . DS  . 'imagine' . DS . 'autoload.php');

use Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\Image;
//use Imagine\Gd\Imagine;

*/



class CouriertxtitemsController extends AppController {
	
    public function initialize(): void {
        parent::initialize();
		$this->set('title', 'Inventory Management');
	 }
	
	public function printsticker($id=null, $contract=null){
		$this->viewBuilder()->setLayout('print');
		$couriertxtitem = $this->Couriertxtitems->get($id, [
            'contain' => ['Couriercontracts'],
			'couriercontract_id' => $contract
        ]);
		$this->set(compact('couriertxtitem'));
		$this->set('id', $id);
		$this->set('contract', $contract);
	}
	
	public function view($id=null, $refid=null){
		//$this->viewBuilder()->setLayout('modal');
		$couriertxtitem =  $this->Couriertxtitems->get($id, [
			'contain' => ['Couriercontracts' => ['Vendors', 'Couriers', 'Programs']],
			'refid'	=> $refid
		]);

		$this->set(compact('couriertxtitem'));
		$this->set('id', $id);
		
		//$this->set('img_dir', $this->Common->imageDIR("web"));
		  
	}
	
	public function selectprogram(){
		$contracts = $this->Couriertxtitems->Couriercontracts
		->find('all')
		->where(['program_id' => 5]);
		
		$this->set(compact('contracts'));
	}
	
	/*
	public function postimage(){
		$this->ajaxLayout();
		if($this->request->is('ajax')){
			
			$respcode 		= 0;
			$msg			= '';
			$ndata			= array();
			
			$form_data 	= $this->request->getData();
			$id 		= $_POST['id'];
			$refid 		= $_POST['refid'];
			$imagine 	= new Imagine\Gd\Imagine();
						
			
			if(!empty($id) && !empty($refid)){
				$couriertxtitem = $this->Couriertxtitems->get($id, [
					'contain' => ['Productimages'],
					'refid' => $refid
				]);
				
				if(!empty($couriertxtitem)){
					if(isset($_FILES["imagefile"])){
						$error = $_FILES["imagefile"]["error"];						
						if($error){
							$msg = "You have uploaded an invalid file";
						}else{
							if(!is_array($_FILES["imagefile"]["name"])){
								$fileName 		= $_FILES["imagefile"];
								//$upload_dir		= date('Y').'/'.date('m').'/'.date('d');
								//$check_dir 		= ROOT . DS . 'webroot/img/Couriertxtitems';
								$upload_folder	= 'Uploads/'.date('Y').'/'.date('m').'/'.date('d').'/'.basename($fileName['name']);
								$dir 			= $this->Common->imageDIR() . date('Y').'/'.date('m').'/'.date('d').'/';
								$upload_dir  	= $dir . basename($fileName['name']);	
									
								if($this->Upload->uploadProductImage($fileName, $upload_dir, $this->Common->imageDIR())){		
									$_image = $imagine->open($upload_dir);
									$_image->save($dir . basename($fileName['name']).'.webp', array('webp_quality' => 50));
									//$respcode = 1;
								
									 $pimage = $couriertxtitem->productimages[0]->id;
									 
									 if(!empty($pimage)){
										//update the image file
										$couriertxtitemimage = $this->Couriertxtitems->Productimages->get($pimage, [
											'contain' => [],
										]);
										
										$couriertxtitemimage = $this->Couriertxtitems->Productimages->patchEntity($couriertxtitemimage, $this->request->getData());
										$couriertxtitemimage->file = $upload_folder;
										$couriertxtitemimage->modified = date('Y-m-d H:i:s');
										
										if($this->Couriertxtitems->Productimages->save($couriertxtitemimage)){
											
											$msg = "Product image has been updated.";
										}else{
											
											$msg = "Product image upload failed. Please try again.";
										}
										
									 }else{
										 $couriertxtitemimage = $this->Couriertxtitems->Productimages->newEmptyEntity();
										 $data_to_save = array(
											'product_id' => $couriertxtitem->id,
											'file'		=> $upload_folder,
											'added'		=> date('Y-m-d H:i:s'),
											'modified'	=> date('Y-m-d H:i:s'), 
										 );
										 
										 $couriertxtitemimage = $this->Couriertxtitems->Productimages->newEntity($data_to_save, ['validation' => false]);
										if($this->Couriertxtitems->Productimages->save($couriertxtitemimage)){
											
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
	*/
	
	
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
			
			 $couriertxtitem = $this->Couriertxtitems->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_product = $this->request->getData();
				$couriertxtitem = $this->Couriertxtitems->patchEntity($couriertxtitem, $this->request->getData());
				
				$couriertxtitem->subitem_id 	= 1;
				$couriertxtitem->status 	= 'ACTIVE';
				$couriertxtitem->added 	= date('Y-m-d H:i:s');
				$couriertxtitem->added_by 	= $this->Auth->user('refid');
				$couriertxtitem->refid 	= str_replace(" ", "", microtime() . $this->Common->generateRString());

				
				$resp 	= 0;
				
				if ($this->Couriertxtitems->save($couriertxtitem)) {
					$this->log($this->getTheAuthor()."SUCCESSFULLY ADDED NEW PRODUCT ITEM: ".$_product['name']." SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($couriertxtitem->getErrors()){
						//$this->log(json_encode($couriertxtitem->getErrors()));
						$error_msg = [];
						foreach( $couriertxtitem->getErrors() as $errors){
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
		

    public function indexajax($contract=null, $type=null, $group_id=null, $courier_id=null){
		$this->ajaxLayout();
		
		//echo $request->getParam('_csrfToken');
		
		if($this->request->is('ajax')){
			
			$data 	= array();
			$db 	=  ConnectionManager::get('default');
			//$this->log(json_encode($_POST)); 
			
			$draw 				= $_POST['draw'];
			$row 				= $_POST['start'];
			$rowperpage 		= ((isset($_POST['length']) && $_POST['length'] > 0) ? $_POST['length'] : -1); // Rows display per page
			$columnIndex 		= $_POST['order'][0]['column']; //Column index
			$columnName 		= $_POST['columns'][$columnIndex]['data']; //Column name
		
						
			switch($columnName){
				case "NAME & CONTACT INFO":
					$columnName = 'firstname';
				break;
				case "ACCESS GROUP":
					$columnName = 'group_id';
				break;
				case "CREATED":
					$columnName = 'created';
				break;
				case "MODIFIED":
					$columnName = 'modified';
				break;
				case "LAST ACCESS":
					$columnName = 'last_access';
				break;
				default:
					$columnName = 'id';
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
			
			$g_q = '';
			$c_q = '';
			$where = " WHERE u.id > 1 AND couriercontract_id = '".$contract."' ";
			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
				$searchQuery = " AND ((u.school like '%".$searchValue."%') OR (u.address like '%".$searchValue."%'))";
			}
				
			if((isset($type) && !empty($type)) && $type=="filter"){
				
				$g_q = '';
				$c_q = '';
				
				if(!empty($group_id)){
					$g_q = " AND u.group_id ='".$group_id."' ";
				}
				
				if(!empty($courier_id)){
					$c_q = " AND u.courier_id ='".$courier_id."' ";
				}
				
					
			}

			$searchQuery = $where . $searchQuery . $g_q . $c_q;
				
			$q1 					= "SELECT count(*) as allcount FROM couriertxtitems as u " . $searchQuery;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
				
			$q2 					= "SELECT count(*) as allcount FROM couriertxtitems as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];
			
			$empQuery = "SELECT u.*, con.name, con.description 
			FROM couriertxtitems as u 
			LEFT JOIN couriercontracts as con ON con.id = u.couriercontract_id  
			".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				   $view_link 		=  Router::url(['controller' => 'couriertxtitems', 'action' => 'view', $c['id']]);
					
				   $data[] = array( 
						//'info'			=> '<div>'.$c['firstname'].' '.$c['middlename'].' '.$c['lastname'].'</div><div class="fs-10 text-info"><span class="text-warning"></span> '.$c['mobile_no'].' / '.$c['email'].'</div>',
						'id'			=> '<div>'.$c['id'].'</div>',
						'region'		=> '<div>'.$c['region'].' / '.$c['division'].'</div>',
						'school'		=> '<div>'.$c['school'].'</div><div>'.$c['recipient_district'].'</div><div class="text-warning fs-10 bold">'.$c['address'].'</div>',
						'package'		=> '<div>'.$c['package_no'].'</div>',
						'data1'			=> '<div>'.$c['laptop'].'</div>',
						'data2'			=> '<div>'.$c['smart_tv'].'</div>',
						'data3'			=> '<div>'.$c['lapel'].'</div>',
						'data4'			=> '<div>'.$c['est_cost'].'</div>',
						'data5'			=> '<div>'.$c['est_total'].'</div>',
						'action' 		=> '<a href="'.$view_link.'" title="Dispatch Information" note="Required fields are marked with (*) " data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-danger fs-8 bold"><i class="fa fa-ship fa-lg"></i> DISPATCH</a>'			
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
				
				$q1 					= "SELECT count(*) as allcount FROM Couriertxtitems as p " . $where . $fquery;
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM Couriertxtitems as p " . $where . $fquery . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
			
			
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM Couriertxtitems as p 
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
				
				$q1 					= "SELECT count(*) as allcount FROM Couriertxtitems";
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM Couriertxtitems as p " . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
				
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM Couriertxtitems as p 
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
						   $link =  Router::url(['controller' => 'Couriertxtitems', 'action' => 'viewforrequest', $c['id']]);
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
						   $link =  Router::url(['controller' => 'Couriertxtitems', 'action' => 'viewforrequest', $c['id']]);
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
						  // $link =  Router::url(['controller' => 'Couriertxtitems', 'action' => 'viewforrequest', $c['id']]);
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
	
	public function index($id=null, $name=null){
		
		
		
		$contract = $this->Couriertxtitems->Couriercontracts->get($id, [
			'program_id' => 5,
			'contain' => []
		]);
		
		
		if(empty($contract)){
			return $this->redirect(['action' => 'selectprogram']);
		}
		
		
		$this->set('id', $id);
		$this->set('name', $name);
		$this->set('contract', $contract);
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

    public function add(){
        $couriertxtitem = $this->Couriertxtitems->newEmptyEntity();
		
        $categories 	= $this->Couriertxtitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Couriertxtitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Couriertxtitems->Subitems->find('list');
        $programs 		= $this->Couriertxtitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Couriertxtitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Couriertxtitems->Vendors->find('list')->where(['status' => 'ACTIVE']); //->where(['status' => 'ACTIVE']);

        $this->set(compact('couriertxtitem', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
    }

	public function import(){
        $couriertxtitem = $this->Couriertxtitems->newEmptyEntity();
        $contracts 	= $this->Couriertxtitems->Couriercontracts->find('list')
		->where(['courier_id' => $this->Auth->user('courier_id'), 'program_id' => 5]);
		
		$this->set(compact('couriertxtitem', 'contracts'));
    }
	
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
							$_data .='<th>ITEM</th>';
							$_data .='<th>DESCRIPTION</th>';
							$_data .='<th>STATUS</th>';
						$_data .='</tr></thead>';
						$_data .='<tbody>';
						if (($handle = fopen($fileName["tmp_name"], "r")) !== FALSE) {
							$respcode = 1;
							fgets($handle);  // read one line for nothing (skip header)
							while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
									
									$data  = array_map("utf8_encode", $data); 
									
									switch($_POST['postdata']){
										case 1: //grade 1
											if($data[5] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
													$item_data = array(
														'couriercontract_id' 	=> $_POST['postdata'],
														'region'	 		 	=> trim(strtoupper($data[0])),
														'division'	 		 	=> trim(strtoupper($data[1])),
														'leg_district'	 	 	=> trim(strtoupper($data[2])),
														'no_eas'	 		 	=> trim(strtoupper($data[3])),
														'no_district'	 		=> trim(strtoupper($data[4])),
														'recipient_district'	=> trim(strtoupper($data[5])),
														'address'				=> trim(strtoupper($data[6])),
														'tx'					=> trim(strtoupper($data[7]))
													);
												}
											}
										break;
										case 2: //grade 4
											if($data[5] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
												$item_data = array(
													'couriercontract_id' 	=> $_POST['postdata'],
													'region'	 		 	=> trim(strtoupper($data[0])),
													'division'	 		 	=> trim(strtoupper($data[1])),
													'leg_district'	 	 	=> trim(strtoupper($data[2])),
													'no_eas'	 		 	=> trim(strtoupper($data[3])),
													'no_district'	 		=> trim(strtoupper($data[4])),
													'recipient_district'	=> trim(strtoupper($data[5])),
													'address'				=> trim(strtoupper($data[6])),
													'tx'					=> trim(strtoupper($data[7])),
													'tm'					=> trim(strtoupper($data[8]))
												);
												}
											}
										break;
										case 3: ///grade 9
											if($data[4] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
												$item_data = array(
													'couriercontract_id' 	=> $_POST['postdata'],
													'region'	 		 	=> trim(strtoupper($data[0])),
													'division'	 		 	=> trim(strtoupper($data[1])),
													'leg_district'	 	 	=> trim(strtoupper($data[2])),
													'school_beis'	 	 	=> trim(strtoupper($data[3])),
													'school'	 	 		=> trim(strtoupper($data[4])),
													'address'	 	 		=> trim(strtoupper($data[5])),
													'esp_tx'				=> trim(strtoupper($data[6])),
													'esp_tm'				=> trim(strtoupper($data[7])),
													'ap_tx'					=> trim(strtoupper($data[8])),
													'ap_tm'					=> trim(strtoupper($data[9]))
												);
												}
											}
										break;
										case 4: // kindergarten
											if($data[5] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
												$item_data = array(
													'couriercontract_id' 	=> $_POST['postdata'],
													'region'	 		 	=> trim(strtoupper($data[0])),
													'division'	 		 	=> trim(strtoupper($data[1])),
													'leg_district'	 	 	=> trim(strtoupper($data[2])),
													'no_eas'	 	 		=> trim(strtoupper($data[3])),
													'no_district'	 	 	=> trim(strtoupper($data[4])),
													'recipient_district'	=> trim(strtoupper($data[5])),
													'address'	 	 		=> trim(strtoupper($data[6])),
													'kg_total'				=> trim(strtoupper($data[7])),
													'kg_ilokano'			=> trim(strtoupper($data[8])),
													'kg_tagalog'			=> trim(strtoupper($data[9])),
													'kg_pangasinan'			=> trim(strtoupper($data[10])),
													'kg_ivatan'				=> trim(strtoupper($data[11])),
													'kg_ibanag'				=> trim(strtoupper($data[12])),
													'kg_kapampangan'		=> trim(strtoupper($data[13])),
													'kg_sambal'				=> trim(strtoupper($data[14])),
													'kg_bikol'				=> trim(strtoupper($data[15])),
													'kg_binisaya'			=> trim(strtoupper($data[16])),
													'kg_waray'				=> trim(strtoupper($data[17])),
													'kg_hiligaynon'			=> trim(strtoupper($data[18])),
													'kg_kinaraya'			=> trim(strtoupper($data[19])),
													'kg_akeanon'			=> trim(strtoupper($data[20])),
													'kg_chavacano'			=> trim(strtoupper($data[21])),
													'kg_maguindanao'		=> trim(strtoupper($data[22])),
													'kg_maranao'			=> trim(strtoupper($data[23])),
													'kg_tausug'				=> trim(strtoupper($data[24])),
													'kg_surigaonon'			=> trim(strtoupper($data[25])),
													'kg_yakan'				=> trim(strtoupper($data[26]))
												);
												}
											}
										break;
										case 5: //grade 10
											if($data[4] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
												$item_data = array(
													'couriercontract_id' 	=> $_POST['postdata'],
													'region'	 		 	=> trim(strtoupper($data[0])),
													'division'	 		 	=> trim(strtoupper($data[1])),
													'leg_district'	 	 	=> trim(strtoupper($data[2])),
													'school_beis'	 	 	=> trim(strtoupper($data[3])),
													'school'	 	 		=> trim(strtoupper($data[4])),
													'address'	 	 		=> trim(strtoupper($data[5])),
													'ma_tx'					=> trim(strtoupper($data[6])),
													'ma_tm'					=> trim(strtoupper($data[7]))
												);
												}
											}
										break;
										case 6: //minima
											if($data[5] !== "Sub-total"){
												if(!empty($data[0]) && !empty($data[1])){
												$item_data = array(
													'couriercontract_id' 	=> $_POST['postdata'],
													'region'	 		 	=> trim(strtoupper($data[0])),
													'division'	 		 	=> trim(strtoupper($data[1])),
													'leg_district'	 	 	=> trim(strtoupper($data[2])),
													'no_eas'	 	 		=> trim(strtoupper($data[3])),
													'no_district'	 	 	=> trim(strtoupper($data[4])),
													'recipient_district'	=> trim(strtoupper($data[5])),
													'address'	 	 		=> trim(strtoupper($data[6])),
													'kg_total'				=> trim(strtoupper($data[7])),
													'kg_ilokano'			=> trim(strtoupper($data[8])),
													'kg_tagalog'			=> trim(strtoupper($data[9])),
													'kg_pangasinan'			=> trim(strtoupper($data[10])),
													'kg_ivatan'				=> trim(strtoupper($data[11])),
													'kg_ibanag'				=> trim(strtoupper($data[12])),
													'kg_kapampangan'		=> trim(strtoupper($data[13])),
													'kg_sambal'				=> trim(strtoupper($data[14])),
													'kg_bikol'				=> trim(strtoupper($data[15])),
													'kg_binisaya'			=> trim(strtoupper($data[16])),
													'kg_waray'				=> trim(strtoupper($data[17])),
													'kg_hiligaynon'			=> trim(strtoupper($data[18])),
													'kg_kinaraya'			=> trim(strtoupper($data[19])),
													'kg_akeanon'			=> trim(strtoupper($data[20])),
													'kg_chavacano'			=> trim(strtoupper($data[21])),
													'kg_maguindanao'		=> trim(strtoupper($data[22])),
													'kg_maranao'			=> trim(strtoupper($data[23])),
													'kg_tausug'				=> trim(strtoupper($data[24])),
													'kg_surigaonon'			=> trim(strtoupper($data[25])),
													'kg_yakan'				=> trim(strtoupper($data[26]))
												);
												}
											}
										break;
										default:
											$item_data = "";
										break;
									}
									
									
									if(!empty($item_data)){
									
											$couriertxtitem = $this->Couriertxtitems->newEmptyEntity();
											$couriertxtitem = $this->Couriertxtitems->newEntity($item_data, ['validate' => true]);
											
											if ($this->Couriertxtitems->save($couriertxtitem)) {
													$save_response = "Added";
													$_added++;
											}else{
													$_notadded++;
													
													$err = '';
													if($couriertxtitem->getErrors()){
														
														$error_msg = [];
														foreach( $couriertxtitem->getErrors() as $errors){
															if(is_array($errors)){
																foreach($errors as $error){
																	$error_msg[]    =   $error;
																}
															}else{
																$error_msg[]    =   $errors;
															}
														}

														if(!empty($error_msg)){
															w_msg[0];
														}
													}
													
													$save_response = $err;
											}
										
									}else{
										$save_response = "Invalid Courier Contract ";
									}										
											
											$_data .='<tr>';
												$_data .='<td>'.$row.'</td>';
												$_data .='<td>&nbsp;</td>';
												$_data .='<td>&nbsp;</td>';
												$_data .='<td>'.strtoupper($save_response).'</td>';
											$_data .='</tr>';
									
									
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
	
	
	public function uploadimage($id=null, $refid=null){
       $couriertxtitem = $this->Couriertxtitems->get($id, [
			'contain' => ['Productimages'],
			'refid' => $refid
	   ]);
	   
	  
	   $this->set(compact('couriertxtitem'));
	   
    }
	
	public function filter(){
		
		/*if($this->request->is('post')){
			$_filter = $this->request->getData();
			
			$items = $this->Couriertxtitems->find()
					->where([
						'program_id' => (!empty($_filter['program_id']) ? $_filter['program_id'] : " > 0")
					])
					->order(['name' => 'ASC'])
					->all();
			
			$this->set('items', $items);
			
		}else{*/
			$couriertxtitem 		= $this->Couriertxtitems->newEmptyEntity();
			$categories 	= $this->Couriertxtitems->Categories->find('list');
			$subcategories 	= $this->Couriertxtitems->Subcategories->find('list');
			$subitems 		= $this->Couriertxtitems->Subitems->find('list');
			$programs 		= $this->Couriertxtitems->Programs->find('list');
			$taggings 		= $this->Couriertxtitems->Taggings->find('list');
			$vendors 		= $this->Couriertxtitems->Vendors->find('list');
		
			$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'subitems', 'programs'));
		//}
    
    }
	
	
   
    public function viewforrequest($id = null){
        $couriertxtitem = $this->Couriertxtitems->get($id, [
            'contain' => ['Categories', 'Subcategories', 'Taggings', 'Programs'],
        ]);
		
		$request = $this->Couriertxtitems->Requests->newEmptyEntity();
		
       // $categories 	= $this->Couriertxtitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        //$subcategories 	= $this->Couriertxtitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Couriertxtitems->Subitems->find('list');
       // $programs 		= $this->Couriertxtitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
       // $taggings 		= $this->Couriertxtitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
      //  $vendors 		= $this->Couriertxtitems->Vendors->find('list')->where(['status' => 'ACTIVE']);

        //$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
        $this->set(compact('product', 'request'));

    }
	
	public function edit($id = null){
        $couriertxtitem = $this->Couriertxtitems->get($id, [
            'contain' => [],
        ]);
		
        $categories 	= $this->Couriertxtitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Couriertxtitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Couriertxtitems->Subitems->find('list');
        $programs 		= $this->Couriertxtitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Couriertxtitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Couriertxtitems->Vendors->find('list')->where(['status' => 'ACTIVE']);

        $this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));

    }
	
	
	public function editajax($id = null){
        $couriertxtitem = $this->Couriertxtitems->get($id, [
            'contain' => [],
        ]);
		
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			$dn = $couriertxtitem->region."-".substr($couriertxtitem->division, 0, 4)."-".date("mdy")."-".str_pad($id, 8, "0", STR_PAD_LEFT);
			//$_product 	= $this->request->getData();
			
			if($couriertxtitem->status =="1"){
				$msg  ="Item was already dispatched";
			}else{
				$couriertxtitem 	= $this->Couriertxtitems->patchEntity($couriertxtitem, $this->request->getData());
			
				//$couriertxtitem->modified 		= date('Y-m-d H:i:s');
				$couriertxtitem->status 		= 1;
				$couriertxtitem->dispatch_date 	= date('Y-m-d H:i:s');
				$couriertxtitem->dn 			= $dn;
			
				if ($this->Couriertxtitems->save($couriertxtitem)) {
					//$this->log($this->getTheAuthor()."SUCCESSFULLY MODIFIED PRODUCT (#".$id.") NEW ITEM: ".$_product['name']." NEW SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					$msg    = "Item has been successfully dispatch. You can now print the sticker";
					
				}else{
					$err = '';
					if($couriertxtitem->getErrors()){
						$error_msg = [];
						foreach( $couriertxtitem->getErrors() as $errors){
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
			}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		$this->set(compact('couriertxtitem'));

    }
	
	
}
