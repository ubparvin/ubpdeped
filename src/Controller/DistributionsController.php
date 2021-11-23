<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class DistributionsController extends AppController
{
    public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Distributions Management');
	}
	 
	private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	
   public function filterproduct($type=null){
		$this->set('filter', $type);
		
		switch($type){
			case "place":
				$regions = "";
				$provinces = "";
				$cities = "";
				$barangays = "";
				$params = array(
					$regions, $provinces, $cities, $barangays
				);
				
				
			break;
			case "status":
				$status = $this->Distributions->Diststagings->find('list');
				$params = array($status);
			break;
			case "item":
				
				$categories 	= $this->Distributions->Distributionitems->Products->Categories->find('list');
				$subcategories 	= $this->Distributions->Distributionitems->Products->Subcategories->find('list');
				//$subitems 		= $this->Distributions->Distributionitems->Products->Subitems->find('list');
				$programs 		= $this->Distributions->Distributionitems->Products->Programs->find('list');
				$taggings 		= $this->Distributions->Distributionitems->Products->Taggings->find('list');
				$vendors 		= $this->Distributions->Distributionitems->Products->Vendors->find('list');

				$params = array(
					$programs,
					$categories,
					$vendors,
					$taggings,
					$subcategories
				);
				
			break;
			case "school":
				$schools 		= $this->Distributions->Schools->find('list');

				$params = array($schools);
			break;
			case "date":
				$params = array();
			break;
			case "combine":
				$regions = "";
				$provinces = "";
				$cities = "";
				$barangays = "";
				
				$status = $this->Distributions->Diststagings->find('list');
				
				$categories 	= $this->Distributions->Distributionitems->Products->Categories->find('list');
				$subcategories 	= $this->Distributions->Distributionitems->Products->Subcategories->find('list');
				//$subitems 		= $this->Distributions->Distributionitems->Products->Subitems->find('list');
				$programs 		= $this->Distributions->Distributionitems->Products->Programs->find('list');
				$taggings 		= $this->Distributions->Distributionitems->Products->Taggings->find('list');
				$vendors 		= $this->Distributions->Distributionitems->Products->Vendors->find('list');

				$schools 		= $this->Distributions->Schools->find('list');

				
				$params = array(
					$regions,
					$provinces, 
					$cities, 
					$barangays,
					$status,
					$programs,
					$categories,
					$vendors,
					$taggings,
					$subcategories,
					$schools
				);
				
				
			break;
		}
		
		$this->set(compact('params'));
   }
   
   public function releaseitem($pid=null, $prefid=null){
	
	 $product = $this->Distributions->Distributionitems->Products->get($pid, [
		'contain' => ['Productimages', 'Categories', 'Subcategories', 'Taggings', 'Programs'],
		'refid' => $prefid
	 ]);
	 
	 if(!empty($product)){
		$schools = $this->Distributions->Schools->find('list')->order(['name' => 'desc']);;
        $barangays = ""; //$this->Users->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Users->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Users->Provinces->find('list', ['limit' => 200]);
        $regions = ""; //$this->getRegionList();
		
		 $series = $this->Distributions->Distributionitems->Products->Programs->Programseries
		->find('list')
		->where(['program_id' => $product->program_id])
		->contain([]);
		
		
		$this->set(compact(
			'product',
			'schools',
			'barangays', 
			'cities', 
			'provinces', 
			'regions',
			'series'
		));
	 }
	 
	  $this->set('img_dir', $this->Common->imageDIR("web"));
   }
	

	
   private function getTheAuthor(){
		$name = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
		$id   = $this->Auth->user('id');
		return $name." (#".$id.") ";
	}
	
   public function canceldistribution($pid = null, $prefid=null){
		$this->ajaxLayout();
		
		if ($this->request->is('ajax')) {
			
			$distribution = $this->Distributions->get($pid, [
				'contain' => ['Distributionitems' => ['Products']],
				'refid' => $prefid,
				'diststaging_id' => 1
			]);
			
			
			
			if(!empty($distribution)){
				
				$qty = $distribution->distributionitems[0]->qty;
				
				if($qty > 0){
					 $_pid = $distribution->distributionitems[0]->product_id;
					 $product = $this->Distributions->Distributionitems->Products->get($_pid, [
						'contain' => []
					 ]);
					 
					 if(!empty($product)){
						 $new_qty  = $product->on_hand + $qty;
						 $product->on_hand = $new_qty;
						 
						 
						 $transactions = $this->Distributions->Distributionitems->Products->Transactions->newEmptyEntity();
										
						 $data_to_save = array(
							'type' 			=> 'CANCELLED',
							'product_id' 	=> $product->id,
							'current_qty'	=> $product->on_hand,
							'added_qty'		=> $qty,
							'new_qty'		=> $new_qty,
							'created'		=> date('Y-m-d H:i:s'),
							'trans_by'		=> $this->Auth->user('id')
						);
										
						$transactions = $this->Distributions->Distributionitems->Products->Transactions->newEntity($data_to_save, ['validate' => false]);
						$distribution->diststaging_id = 11;
										
						if($this->Distributions->save($distribution) && 
							$this->Distributions->Distributionitems->Products->save($product) && 
							$this->Distributions->Distributionitems->Products->Transactions->save($transactions)){
							
							$msg ="Item distribution has been cancelled";
						}else{
							$msg ="Cancellation failed. Please try again";
						}
					}else{
						$msg ="Cancellation failed. Product details not found";
					}
				}else{
					$msg = "Cancellation failed. Invalid quantity, please try again.";
				}
			}else{
				$msg = "Cancellation failed. No data found or item is no longer available for cancellation.";
			}
			
			echo json_encode(array('msg' => $msg));	
			$this->set(compact('product'));
			
		}
   }
   
   public function editajax($pid = null, $prefid=null){
        $this->ajaxLayout();
		
		if ($this->request->is('ajax')) {
			
			$product = $this->Distributions->Distributionitems->Products->get($pid, [
				'contain' => [],
				'refid' => $prefid
			 ]);
			 
			 $item 		= $this->request->getData();
			 
			 //get school data
			 $school = $this->Distributions->Schools
				->find()
				->where(['id' => $item['school_id']])
				->first();
		
			
			if(!empty($product) && !empty($school)){
			
				
				//$qty 		= $product->qty;
				$on_hand	= $product->on_hand;
				$new_qty	= ($on_hand - $item['qty']);
				
				if($new_qty > 0 && $on_hand >= $new_qty && $item['qty'] > 0){
					
					$series = $item['series'];
					$start 	= ltrim($item['series_start'], "0");
					$end 	= ltrim($item['series_end'], "0");
					$total 	= count(range($start, $end));
					
					if(!empty($series) && !empty($start) && !empty($end) && ($end > $start) && ($total > 0)){
						if($total==$item['qty']){
							//check if series exists;
							/*$series_exists = $this->Distributions->Distributionitems->Products->Productseries
								->find()
								->select(['id'])
								->where([
									'product_id' 	=> $product->id,
									'series'	 	=> $series,
									'start' 		=> $start,
									'end' 			=> $end
									
								])
								->first();
								
							if(empty($series_exists)){
								$msg = "Product series was not found. Please check the details again ";
							}else{
									//check if distribution exists
									$dist_exists = $this->Distributions->Distributionitems
									->find()
									->select(['id'])
									->where([
										'product_id' 	=> $product->id,
										'series'	 	=> $series,
										'series_start' 	=> $start,
										'series_end' 	=> $end
										
									])
									->first();
								
								if(!empty($dist_exists)){
									$msg = "Product series was already distributed. Please check the details again ";
								}else{*/
										$refid 		= str_replace(" ", "", microtime() . $this->Common->generateRString());
										
										$distribution = $this->Distributions->newEmptyEntity();
										$data_to_save  = array(
											'refid'	 		=> $refid,
											'program_id' 	=> $product->program_id,
											'school_id'		=> $school->id,
											'regCode'		=> $school->regCode,
											'provCode'		=> $school->provCode,
											'citymunCode'	=> $school->citymunCode,
											'brgyCode'		=> $school->brgyCode,
											'sitio'			=> $school->sitio,
											'address'		=> $school->address,
											'created'		=> date('Y-m-d H:i:s'),
											'userid'		=> $this->Auth->user('id'),
											'diststaging_id'=> 1, //DEPED WAREHOUSE,
											'est_from'		=> $item['est_from'],
											'est_to'		=> $item['est_to'],
										);
										
										$distribution = $this->Distributions->newEntity($data_to_save, ['validation' => true]);
										
										
										//$product 	= $this->Distributions->Distributionitems->Products->patchEntity($product, $this->request->getData());

										$product->on_hand 		= $new_qty;
										

										//$product = $this->Distributions->Distributionitems->Products->patchEntity($product, $this->request->getData());
										
										if ($this->Distributions->save($distribution) && $this->Distributions->Distributionitems->Products->save($product)) {
											
											//save the items & transactions
											
											$items = $this->Distributions->Distributionitems->newEmptyEntity();
											$data_to_save = array(
												'distribution_id' 	=> $distribution->id,
												'product_id'		=> $product->id,
												'program_id'		=> $product->program_id,
												'series'			=> $series,
												'series_start'		=> $start,
												'series_end'		=> $end,
												'qty'				=> $item['qty'],
												'added'				=> date('Y-m-d H:i:s')
											);
											
											$items = $this->Distributions->Distributionitems->newEntity($data_to_save, ['validate' => false]);
											
											$trans = $this->Distributions->Distransactions->newEmptyEntity();
											$trans_data = array(
												'distribution_id' 	=> $distribution->id,
												'date_received'		=> date('Y-m-d H:i:s'),
												'date_released'		=> date('Y-m-d H:i:s'),
												'diststaging_id'	=> 1,
												'userid'			=> $this->Auth->user('id')
											);

											$trans = $this->Distributions->Distransactions->newEntity($trans_data, ['validate' => false]);
												
											
											if($this->Distributions->Distributionitems->save($items) && $this->Distributions->Distransactions->save($trans)){

												$this->log($this->getTheAuthor()."SUCCESSFULLY DISTRIBUTED ".$item['qty']." ITEM ID # ".$product->id." TO SCHOOL ID # ".$item['school_id'], "_info");
											
											}else{
												$this->log($this->getTheAuthor()."SUCCESSFULLY DISTRIBUTED ".$item['qty']." ITEM ID # ".$product->id." TO SCHOOL ID # ".$item['school_id'], "_info");
											}
											
											$resp 	= 1;
											$msg = "Item successfully distributed and will be pack soon.";
											
										}else{
											$err = '';
											if($distribution->getErrors()){
												$error_msg = [];
												foreach( $distribution->getErrors() as $errors){
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
								//}
							//}
							
						}else{
							$msg = "Series and quantity to received does not match";
						}
						
					}else{
						$msg = "Invalid series data. Please check the details";
					}
					
				}else{
					$msg = $this->Message->showMsg('save_failed')." Quantity to release is more than the quantity on hand";
				}
			}else{
				$msg = $this->Message->showMsg('save_failed')." Product / School Record not found";
			}
			
			echo json_encode(array('resp' => $resp, 'msg' => $msg));	
			$this->set(compact('product'));
        }
    }
	
	public function view($id=null, $refid=null){
		$distribution = $this->Distributions->get($id, 
		[
			'contain' => ['Diststagings', 'Schools', 'Distributionitems' => ['Programs', 'Products' => ['Taggings', 'Subcategories', 'Categories']]],
			'refid' => $refid
		]
		);
		/*$distribution = $this->Distributions
			->find()
			->where(['id' => $id, 'refid' => $refid])
			->contain(['Schools', 'Distributionitems' => ['Programs', 'Products' => ['Taggings']]])->first();
		*/
		$this->set(compact('distribution'));
	}
	
	
	public function indexajax(
		$type=null, 
		$filter_type=null,
		$program_id=null,
		$category_id=null,
		$vendor_id=null,
		$tagging_id=null,
		$subcategory_id=null,
		$school=null,
		$status=null,
		$region=null,
		$province=null,
		$city=null,
		$barangay=null,
		$d_from=null,
		$d_to=null
	){
		$this->ajaxLayout();
		if($this->request->is('ajax')){
			
			$data = array();
			$db =  ConnectionManager::get('default');

			$draw 				= $_POST['draw'];
			$row 				= $_POST['start'];
			$rowperpage 		= ((isset($_POST['length']) && $_POST['length'] > 0) ? $_POST['length'] : -1); 
			$columnIndex 		= $_POST['order'][0]['column']; 
			$columnName 		= $_POST['columns'][$columnIndex]['data'];
		
			
			switch($columnName){
				case "ITEM DETAILS":
					$columnName = 'created';
				break;
				default:
					$columnName = 'created';
				break;
			}
			
			$columnSortOrder 	= $_POST['order'][0]['dir']; // asc or desc
			
			## Search 
			$searchValue = '';
			$searchQuery = '';
			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
			}else{
				$_limit  = '';
			}
			$and 	="";
			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
				$searchQuery = " AND (p.name like '%".$searchValue."%' OR s.name like '%".$searchValue."%')";
			}
					
			switch($type){
				case "filter":
					switch($filter_type){
						case "place":

							$region 	= (!empty($region) ? " AND d.regCode='".$region."'" : "");
							$province 	= (!empty($province) ? " AND d.provCode='".$province."'" : "");
							$city 		= (!empty($city) ? " AND d.citymunCode='".$city."'" : "");
							$barangay 	= (!empty($barangay) ? " AND d.brgyCode='".$barangay."'" : "");
							
							$and 		= $searchQuery . $region . $province . $city . $barangay;
						break;
						case "status":
							$status 	= (!empty($status) ? " AND diststaging_id='".$status."'" : "");
							$and 		= $searchQuery . $status;
						break;
						case "item":
							$program 		= (!empty($program_id) ? " AND d.program_id='".$program_id."'" : "");
							$category 		= (!empty($category_id) ? " AND p.category_id='".$category_id."'" : "");
							$vendor 		= (!empty($vendor_id) ? " AND p.vendor_id='".$vendor_id."'" : "");
							$tagging 		= (!empty($tagging_id) ? " AND p.tagging_id='".$tagging_id."'" : "");
							$subcategory 	= (!empty($subcategory_id) ? " AND p.subcategory_id='".$subcategory_id."'" : "");
							
							$and 		=  $searchQuery . $program; // . $category . $vendor . $tagging . $subcategory;
							
						break;
						case "school":
							$school 	= (!empty($school) ? " AND d.school_id='".$school."'" : "");
							$and 		=  $searchQuery . $school;
							
						break;
						case "date":
							$d_from 	= (!empty($d_from) ? $d_from : date('Y-m-d'));
							$d_to 		= (!empty($d_to) ? $d_to : date('Y-m-d'));
							
							$d_from 	= " AND DATE(d.est_from)='".$d_from."'";
							$d_to 		= " AND DATE(d.est_to)='".$d_to."'";
							
							$and 		=  $searchQuery . $d_from . $d_to;
						break;
						case "combine":
							$region 	= (!empty($region) ? " AND d.regCode='".$region."'" : "");
							$province 	= (!empty($province) ? " AND d.provCode='".$province."'" : "");
							$city 		= (!empty($city) ? " AND d.citymunCode='".$city."'" : "");
							$barangay 	= (!empty($barangay) ? " AND d.brgyCode='".$barangay."'" : "");
							
							
							$status 	= (!empty($status) ? " AND diststaging_id='".$status."'" : "");
							
							$program 		= (!empty($program_id) ? " AND d.program_id='".$program_id."'" : "");
							$category 		= (!empty($category_id) ? " AND p.category_id='".$category_id."'" : "");
							$vendor 		= (!empty($vendor_id) ? " AND p.vendor_id='".$vendor_id."'" : "");
							$tagging 		= (!empty($tagging_id) ? " AND p.tagging_id='".$tagging_id."'" : "");
							$subcategory 	= (!empty($subcategory_id) ? " AND p.subcategory_id='".$subcategory_id."'" : "");
							
							
							$school 	= (!empty($school) ? " AND d.school_id='".$school."'" : "");
							
							
							$and 		= $searchQuery . $region . $province . $city . $barangay . $status . $program . $school;
				
						break;
						
						default:
							$and 		= $searchQuery;
						break;
					}
					
				break;
				default:
					$and = $searchQuery;
				break;
			}
			
			$where 	= " WHERE d.id > 0 " . $and. " AND d.userid > 0 ";
			
			$q1 					= "SELECT count(*) as allcount FROM distributions as d " .$where;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
					
			$q2 					= "SELECT count(*) as allcount FROM distributions as d " . $where;
			
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];
				
			$empQuery = "SELECT d.*, di.product_id, di.qty as diqty, p.name, p.subname, 
				p.program_id, p.tagging_id, p.category_id, p.subcategory_id, p.vendor_id, 
				pr.name as program, s.name as school, ds.description as status FROM distributions as d  
				LEFT JOIN distributionitems as di ON d.id = di.distribution_id  
				LEFT JOIN products as p ON p.id = di.product_id 
				LEFT JOIN programs as pr ON pr.id = d.program_id  
				LEFT JOIN schools as s ON s.id = d.school_id  
				LEFT JOIN diststagings as ds ON ds.id = d.diststaging_id   
				".$where." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;

			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				
						foreach($empRecords as $c):
							$cancel_link = '';
							if($c['diststaging_id']==1){
								$cancel_link = Router::url(['controller' => 'distributions', 'action' => 'canceldistribution', $c['id'], $c['refid']]);
								$cancel_link = ' <a href="'.$cancel_link.'" class="cancel_action btn btn-xs btn-danger fs-8 bold"><i class="fa fa-trash fa-lg"></i> CANCEL</a>';
							}
							
						   $link =  Router::url(['controller' => 'distributions', 'action' => 'view', $c['id'], $c['refid']]);
						   $data[] = array( 
								'id'			=> '<div>'.$c['id'].'</div>',
								'program'		=> '<div>'.$c['program'].'</div>',
								'item'			=> '<div>'.$c['diqty'].' X '.$c['name'].'</div>',
								'school'		=> '<div>'.$c['school'].'</div><div class="fs-10 bold text-warning">'.$c['address'].'</div>',
								'status'		=> '<div class="text-success bold">'.$c['status'].'</div>
								<div class="text-warning fs-10 bold">EST '.$c['est_from'].' - '.$c['est_to'].'
								</div>',
								'action' 		=> '<a href="'.$link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Package Information" note ="This sticker will be used on application Receive Package" class="modal_view btn btn-xs btn-success fs-8 bold"><i class="fa fa-eye fa-lg"></i> DETAILS</a>' . $cancel_link
											
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
			
		}
	}
	
	public function index(){

	}
	
	
}
