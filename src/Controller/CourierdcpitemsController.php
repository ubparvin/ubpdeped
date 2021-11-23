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



class CourierdcpitemsController extends AppController {
	
    public function initialize(): void {
        parent::initialize();
		$this->set('title', 'Inventory Management');
	 }
	
	public function printsticker($id=null, $contract=null){
		$this->viewBuilder()->setLayout('print');
		$courierdcpitem = $this->Courierdcpitems->get($id, [
            'contain' => ['Couriercontracts'],
			'couriercontract_id' => $contract
        ]);
		$this->set(compact('courierdcpitem'));
		$this->set('id', $id);
		$this->set('contract', $contract);
	}
	
	public function view($id=null, $refid=null){
		//$this->viewBuilder()->setLayout('modal');
		$courierdcpitem =  $this->Courierdcpitems->get($id, [
			'contain' => ['Couriercontracts' => ['Vendors', 'Couriers', 'Programs']],
			'refid'	=> $refid
		]);

		$this->set(compact('courierdcpitem'));
		$this->set('id', $id);
		//$this->set('img_dir', $this->Common->imageDIR("web"));
		  
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
				$courierdcpitem = $this->Courierdcpitems->get($id, [
					'contain' => ['Productimages'],
					'refid' => $refid
				]);
				
				if(!empty($courierdcpitem)){
					if(isset($_FILES["imagefile"])){
						$error = $_FILES["imagefile"]["error"];						
						if($error){
							$msg = "You have uploaded an invalid file";
						}else{
							if(!is_array($_FILES["imagefile"]["name"])){
								$fileName 		= $_FILES["imagefile"];
								//$upload_dir		= date('Y').'/'.date('m').'/'.date('d');
								//$check_dir 		= ROOT . DS . 'webroot/img/Courierdcpitems';
								$upload_folder	= 'Uploads/'.date('Y').'/'.date('m').'/'.date('d').'/'.basename($fileName['name']);
								$dir 			= $this->Common->imageDIR() . date('Y').'/'.date('m').'/'.date('d').'/';
								$upload_dir  	= $dir . basename($fileName['name']);	
									
								if($this->Upload->uploadProductImage($fileName, $upload_dir, $this->Common->imageDIR())){		
									$_image = $imagine->open($upload_dir);
									$_image->save($dir . basename($fileName['name']).'.webp', array('webp_quality' => 50));
									//$respcode = 1;
								
									 $pimage = $courierdcpitem->productimages[0]->id;
									 
									 if(!empty($pimage)){
										//update the image file
										$courierdcpitemimage = $this->Courierdcpitems->Productimages->get($pimage, [
											'contain' => [],
										]);
										
										$courierdcpitemimage = $this->Courierdcpitems->Productimages->patchEntity($courierdcpitemimage, $this->request->getData());
										$courierdcpitemimage->file = $upload_folder;
										$courierdcpitemimage->modified = date('Y-m-d H:i:s');
										
										if($this->Courierdcpitems->Productimages->save($courierdcpitemimage)){
											
											$msg = "Product image has been updated.";
										}else{
											
											$msg = "Product image upload failed. Please try again.";
										}
										
									 }else{
										 $courierdcpitemimage = $this->Courierdcpitems->Productimages->newEmptyEntity();
										 $data_to_save = array(
											'product_id' => $courierdcpitem->id,
											'file'		=> $upload_folder,
											'added'		=> date('Y-m-d H:i:s'),
											'modified'	=> date('Y-m-d H:i:s'), 
										 );
										 
										 $courierdcpitemimage = $this->Courierdcpitems->Productimages->newEntity($data_to_save, ['validation' => false]);
										if($this->Courierdcpitems->Productimages->save($courierdcpitemimage)){
											
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
			
			 $courierdcpitem = $this->Courierdcpitems->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_product = $this->request->getData();
				$courierdcpitem = $this->Courierdcpitems->patchEntity($courierdcpitem, $this->request->getData());
				
				$courierdcpitem->subitem_id 	= 1;
				$courierdcpitem->status 	= 'ACTIVE';
				$courierdcpitem->added 	= date('Y-m-d H:i:s');
				$courierdcpitem->added_by 	= $this->Auth->user('refid');
				$courierdcpitem->refid 	= str_replace(" ", "", microtime() . $this->Common->generateRString());

				
				$resp 	= 0;
				
				if ($this->Courierdcpitems->save($courierdcpitem)) {
					$this->log($this->getTheAuthor()."SUCCESSFULLY ADDED NEW PRODUCT ITEM: ".$_product['name']." SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($courierdcpitem->getErrors()){
						//$this->log(json_encode($courierdcpitem->getErrors()));
						$error_msg = [];
						foreach( $courierdcpitem->getErrors() as $errors){
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
		

    public function indexajax($type=null, $group_id=null, $courier_id=null){
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
			$where = " WHERE u.id > 1";
			
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

			$searchQuery = $searchQuery . $where . $g_q . $c_q;
				
			$q1 					= "SELECT count(*) as allcount FROM courierdcpitems as u " . $searchQuery;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
				
			$q2 					= "SELECT count(*) as allcount FROM courierdcpitems as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];
			
			$empQuery = "SELECT u.*, con.name, con.description, con.vendor_id, v.name as vendor  
			FROM courierdcpitems as u 
			LEFT JOIN couriercontracts as con ON con.id = u.couriercontract_id  
			LEFT JOIN vendors as v ON v.id = con.vendor_id   
			".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				   $view_link 		=  Router::url(['controller' => 'courierdcpitems', 'action' => 'view', $c['id']]);
					
				   $data[] = array( 
						//'info'			=> '<div>'.$c['firstname'].' '.$c['middlename'].' '.$c['lastname'].'</div><div class="fs-10 text-info"><span class="text-warning"></span> '.$c['mobile_no'].' / '.$c['email'].'</div>',
						'id'			=> '<div>'.$c['id'].'</div>',
						'region'		=> '<div>'.$c['region'].'</div><div class="text-warning fs-10 bold">'.$c['division'].'</div>',
						'school'		=> '<div>'.$c['school'].'</div><div class="text-warning fs-10 bold">'.$c['school_beis'].'</div><div class="text-warning fs-10 bold">'.$c['address'].'</div><div class="text-info fs-10 bold">'.$c['vendor'].'</div>',
						/*'package'		=> '<div>'.$c['package_no'].'</div>',
						'data1'			=> '<div>'.$c['laptop'].'</div>',
						'data2'			=> '<div>'.$c['smart_tv'].'</div>',
						'data3'			=> '<div>'.$c['lapel'].'</div>',
						'data4'			=> '<div>'.$c['est_cost'].'</div>',
						'data5'			=> '<div>'.$c['est_total'].'</div>',
						*/
						'action' 		=> '<a href="'.$view_link.'" title="Dispatch Information" note="Required fields is marked with ( * )" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-danger fs-8 bold"><i class="fa fa-ship fa-lg"></i> DISPATCH</a>'			
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
				
				$q1 					= "SELECT count(*) as allcount FROM Courierdcpitems as p " . $where . $fquery;
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM Courierdcpitems as p " . $where . $fquery . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
			
			
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM Courierdcpitems as p 
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
				
				$q1 					= "SELECT count(*) as allcount FROM Courierdcpitems";
				$records 				= $db->execute($q1)->fetchAll('assoc');
				$totalRecords 			= $records[0]['allcount'];
					
				$q2 					= "SELECT count(*) as allcount FROM Courierdcpitems as p " . $searchQuery;
				$records 				= $db->execute($q2)->fetchAll('assoc');
				$totalRecordwithFilter 	= $records[0]['allcount'];
				
				$empQuery = "SELECT p.*, c.name as category, 
				sc.name as subcategory, t.name as tagging, 
				v.name as vendor, pro.name as program 
				FROM Courierdcpitems as p 
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
						   $link =  Router::url(['controller' => 'Courierdcpitems', 'action' => 'viewforrequest', $c['id']]);
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
						   $link =  Router::url(['controller' => 'Courierdcpitems', 'action' => 'viewforrequest', $c['id']]);
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
						  // $link =  Router::url(['controller' => 'Courierdcpitems', 'action' => 'viewforrequest', $c['id']]);
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

    public function add(){
        $courierdcpitem = $this->Courierdcpitems->newEmptyEntity();
		
        $categories 	= $this->Courierdcpitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Courierdcpitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Courierdcpitems->Subitems->find('list');
        $programs 		= $this->Courierdcpitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Courierdcpitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Courierdcpitems->Vendors->find('list')->where(['status' => 'ACTIVE']); //->where(['status' => 'ACTIVE']);

        $this->set(compact('courierdcpitem', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
    }

	public function import(){
        $courierdcpitem = $this->Courierdcpitems->newEmptyEntity();
        $contracts 	= $this->Courierdcpitems->Couriercontracts->find('list')
		->where(['courier_id' => $this->Auth->user('courier_id'), 'program_id' => 2]);
		
		$this->set(compact('courierdcpitem', 'contracts'));
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
									
									if(!empty($data[0]) && !empty($data[1]) && $data[0] !== "REGION"){
										
										$item_data = array(
											'couriercontract_id' 	=> $_POST['postdata'],
											'region'	 		 	=> !empty($data[0]) ? trim(strtoupper($data[0])) : "",
											'division'	 		 	=> !empty($data[1]) ? trim(strtoupper($data[1])) : "",
											'leg_district'	 	 	=> !empty($data[2]) ? trim(strtoupper($data[2])) : "",
											'school_beis'	 	 	=> !empty($data[3]) ? trim(strtoupper($data[3])) : "",
											'school'	 		 	=> !empty($data[4]) ? trim(strtoupper($data[4])) : "",
											'municipality'	 		=> !empty($data[5]) ? trim(strtoupper($data[5])) : "",
											'barangay'				=> !empty($data[6]) ? trim(strtoupper($data[6])) : "",
											'address'				=> !empty($data[7]) ? trim(strtoupper($data[7])) : "",
											'package_no'			=> !empty($data[8]) ? trim($data[8]) : "",
											'latop'					=> !empty($data[9]) ? trim($data[9]) : "",
											'smart_tv'				=> !empty($data[10]) ? trim($data[10]) : "",
											'lapel'					=> !empty($data[11]) ? trim($data[11]) : "",
											'package_lms'			=> !empty($data[12]) ? trim($data[12]) : "",
											'est_cost'				=> !empty($data[13]) ? trim($data[13]) : "",
											'est_total'				=> !empty($data[14]) ? trim($data[14]) : ""
										);
									}
									
									if(!empty($item_data)){
									
											$courierdcpitem = $this->Courierdcpitems->newEmptyEntity();
											$courierdcpitem = $this->Courierdcpitems->newEntity($item_data, ['validate' => true]);
											
											if ($this->Courierdcpitems->save($courierdcpitem)) {
													$save_response = "Added";
													$_added++;
											}else{
													$_notadded++;
													
													$err = '';
													if($courierdcpitem->getErrors()){
														
														$error_msg = [];
														foreach( $courierdcpitem->getErrors() as $errors){
															if(is_array($errors)){
																foreach($errors as $error){
																	$error_msg[]    =   $error;
																}
															}else{
																$error_msg[]    =   $errors;
															}
														}

														if(!empty($error_msg)){
															msg[0];
														}
													}
													
													$save_response = $err;
											}
										
									}else{
										$save_response = "Item no data ";
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
       $courierdcpitem = $this->Courierdcpitems->get($id, [
			'contain' => ['Productimages'],
			'refid' => $refid
	   ]);
	   
	  
	   $this->set(compact('courierdcpitem'));
	   
    }
	
	public function filter(){
		
		/*if($this->request->is('post')){
			$_filter = $this->request->getData();
			
			$items = $this->Courierdcpitems->find()
					->where([
						'program_id' => (!empty($_filter['program_id']) ? $_filter['program_id'] : " > 0")
					])
					->order(['name' => 'ASC'])
					->all();
			
			$this->set('items', $items);
			
		}else{*/
			$courierdcpitem 		= $this->Courierdcpitems->newEmptyEntity();
			$categories 	= $this->Courierdcpitems->Categories->find('list');
			$subcategories 	= $this->Courierdcpitems->Subcategories->find('list');
			$subitems 		= $this->Courierdcpitems->Subitems->find('list');
			$programs 		= $this->Courierdcpitems->Programs->find('list');
			$taggings 		= $this->Courierdcpitems->Taggings->find('list');
			$vendors 		= $this->Courierdcpitems->Vendors->find('list');
		
			$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'subitems', 'programs'));
		//}
    
    }
	
	
   
    public function viewforrequest($id = null){
        $courierdcpitem = $this->Courierdcpitems->get($id, [
            'contain' => ['Categories', 'Subcategories', 'Taggings', 'Programs'],
        ]);
		
		$request = $this->Courierdcpitems->Requests->newEmptyEntity();
		
       // $categories 	= $this->Courierdcpitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        //$subcategories 	= $this->Courierdcpitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Courierdcpitems->Subitems->find('list');
       // $programs 		= $this->Courierdcpitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
       // $taggings 		= $this->Courierdcpitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
      //  $vendors 		= $this->Courierdcpitems->Vendors->find('list')->where(['status' => 'ACTIVE']);

        //$this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));
        $this->set(compact('product', 'request'));

    }
	
	public function edit($id = null){
        $courierdcpitem = $this->Courierdcpitems->get($id, [
            'contain' => [],
        ]);
		
        $categories 	= $this->Courierdcpitems->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Courierdcpitems->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        //$subitems 		= $this->Courierdcpitems->Subitems->find('list');
        $programs 		= $this->Courierdcpitems->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Courierdcpitems->Taggings->find('list')->where(['status' => 'ACTIVE']); 
        $vendors 		= $this->Courierdcpitems->Vendors->find('list')->where(['status' => 'ACTIVE']);

        $this->set(compact('product', 'vendors', 'categories', 'taggings', 'subcategories', 'programs'));

    }
	
	public function editajax($id = null){
        $courierdcpitem = $this->Courierdcpitems->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			$dn = $courierdcpitem->region."-".substr($courierdcpitem->division, 0, 4)."-".date("mdy")."-".str_pad($id, 8, "0", STR_PAD_LEFT);
			
			if($courierdcpitem->status =="1"){
				$msg  ="Item was already dispatched";
			}else{
				$courierdcpitem 	= $this->Courierdcpitems->patchEntity($courierdcpitem, $this->request->getData());
				$courierdcpitem->status 		= 1;
				$courierdcpitem->dispatch_date 	= date('Y-m-d H:i:s');
				$courierdcpitem->dn 			= $dn;
				
				if ($this->Courierdcpitems->save($courierdcpitem)) {
					//$this->log($this->getTheAuthor()."SUCCESSFULLY MODIFIED PRODUCT (#".$id.") NEW ITEM: ".$_product['name']." NEW SUB-ITEM: ".$_product['subname'], "_info");
					$resp 	= 1;
					//$msg = $this->Message->showMsg('update');
					$msg    = "Item has been successfully dispatch. You can now print the sticker";
				}else{
					$err = '';
					if($courierdcpitem->getErrors()){
						$error_msg = [];
						foreach( $courierdcpitem->getErrors() as $errors){
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
		
		$this->set(compact('courierdcpitem'));

    }
	
	
}
