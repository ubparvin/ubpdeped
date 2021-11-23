<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Utility\Text;

class LogisticsController extends AppController
{
    public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Logistic Management');
	}
	 
	private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	

   public function bulkreceive($status){
	  $logistic = $this->Logistics->newEmptyEntity();
	 /*if($this->request->is('post')){
		 $this->query()
			->update()
			->set(['status' => 2])
			->where(['status' => 1])
			->execute();
		$courierdcpitem 	= $this->Courierdcpitems->patchEntity($courierdcpitem, $this->request->getData());
		//save the transactions 
		$save_trans =  $this->ci->db->prepare("
		INSERT INTO logistictrans 
		(logistic_id, status, added, pa) 
		VALUES 
		(:logistic_id, :status, :added, :pa) 
		");
								
		$data_to_save = array(
			'logistic_id'	=> $data[0],
			'status'		=> $data[1], 
			'added'			=> $data[2],
			'pa'			=> $data[3]
		);
		
		if($save_trans->execute($data_to_save)){
			return true;
		}
		
	 }*/
	 
		$db =  ConnectionManager::get('default');
		switch($status){
			case 9:
				/*$items = $this->Logistics->find('all')
				->where(['status' => 4, 'warehouse_id >' => 1])
				->contain(['Programs'])
				->join([
					'table' => 'users',
					'alias' => 'u',
					'type' => 'LEFT',
					'conditions' => 'u.id = logistics.pa_inspector',
				]);
				->order(['id' => 'DESC']);*/
				
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.warehouse_id >= '1' AND l.status ='4' 
				ORDER BY id DESC";
				
			break;
			case 4:
				
				/*$items = $this->Logistics->find('all')
				->where(['warehouse_id >' => 1])
				->contain(['Programs'])
				->join([
					'table' => 'users',
					'alias' => 'u',
					'type' => 'LEFT',
					'conditions' => 'u.id = logistics.pa_inspector',
				]);
				->order(['id' => 'DESC']);*/
				
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.warehouse_id >= '1'  
				ORDER BY id DESC";
				
			break;
			default:
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.status ='".$status."' 
				ORDER BY id DESC";
				
			break;
		}
		
		$logistics  = $db->execute($query)->fetchAll('assoc');
		
		$this->set('title', $this->Message->logisticStatus($status));
		
		$this->set(compact('logistics', 'logistic'));
		
   }
   
	
   public function showitems($status=null){
		$db =  ConnectionManager::get('default');
		switch($status){
			case 9:
				/*$items = $this->Logistics->find('all')
				->where(['status' => 4, 'warehouse_id >' => 1])
				->contain(['Programs'])
				->join([
					'table' => 'users',
					'alias' => 'u',
					'type' => 'LEFT',
					'conditions' => 'u.id = logistics.pa_inspector',
				]);
				->order(['id' => 'DESC']);*/
				
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.warehouse_id >= '1' AND l.status ='4' 
				ORDER BY id DESC";
				
			break;
			case 4:
				
				/*$items = $this->Logistics->find('all')
				->where(['warehouse_id >' => 1])
				->contain(['Programs'])
				->join([
					'table' => 'users',
					'alias' => 'u',
					'type' => 'LEFT',
					'conditions' => 'u.id = logistics.pa_inspector',
				]);
				->order(['id' => 'DESC']);*/
				
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.warehouse_id >= '1'  
				ORDER BY id DESC";
				
			break;
			default:
				$query = "SELECT l.*, v.name as vendor, p.name as program, 
				CONCAT(u.firstname,' ', u.lastname) as pa 
				FROM logistics as l 
				LEFT JOIN vendors as v ON v.id = l.vendor_id 
				LEFT JOIN programs as p ON p.id = l.program_id 
				LEFT JOIN users as u ON u.id = l.pa_inspector 
				WHERE l.status ='".$status."' 
				ORDER BY id DESC";
				
			break;
		}
		
		$logistics  = $db->execute($query)->fetchAll('assoc');
		
		$this->set('title', $this->Message->logisticStatus($status));
		
		$this->set(compact('logistics'));
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
				$status = $this->Message->logisticStatus();
				$params = array($status);
			break;
			case "item":
				
				$categories 	= $this->Logistics->Distributionitems->Products->Categories->find('list');
				$subcategories 	= $this->Logistics->Distributionitems->Products->Subcategories->find('list');
				//$subitems 		= $this->logistics->Distributionitems->Products->Subitems->find('list');
				$programs 		= $this->Logistics->Distributionitems->Products->Programs->find('list');
				$taggings 		= $this->Logistics->Distributionitems->Products->Taggings->find('list');
				$vendors 		= $this->Logistics->Distributionitems->Products->Vendors->find('list');

				$params = array(
					$programs,
					$categories,
					$vendors,
					$taggings,
					$subcategories
				);
				
			break;
			case "school":
				$schools 		= $this->Logistics->Schools->find('list')
				->order(['name' => 'ASC']);

				$params = array($schools);
			break;
			case "warehouse":
				$warehouses 	= $this->Logistics->Warehouses->find('list')
					->order(['name' => 'ASC']);

				$params = array($warehouses);
			break;
			case "vendor":
				$vendors 	= $this->Logistics->Vendors->find('list')
					->order(['name' => 'ASC']);

				$params = array($vendors);
			break;
			case "date":
				$params = array();
			break;
			case "combine":
				$regions = "";
				$provinces = "";
				$cities = "";
				$barangays = "";
				
				$status = $this->Logistics->Diststagings->find('list');
				
				$categories 	= $this->Logistics->Distributionitems->Products->Categories->find('list');
				$subcategories 	= $this->Logistics->Distributionitems->Products->Subcategories->find('list');
				//$subitems 		= $this->logistics->Distributionitems->Products->Subitems->find('list');
				$programs 		= $this->Logistics->Distributionitems->Products->Programs->find('list');
				$taggings 		= $this->Logistics->Distributionitems->Products->Taggings->find('list');
				$vendors 		= $this->Logistics->Distributionitems->Products->Vendors->find('list');

				$schools 		= $this->Logistics->Schools->find('list');

				
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
   
  
	
   private function getTheAuthor(){
		$name = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
		$id   = $this->Auth->user('id');
		return $name." (#".$id.") ";
	}
	
   
	public function view($id=null){
		$logistic = $this->Logistics->get($id, 
			['contain' => ['Vendors', 'Schools', 'Warehouses']
		]);
		$this->set(compact('logistic'));
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
		$warehouse=null,
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
					$columnName = 'serial_no';
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
			}else{
				$_limit  = '';
			}
			$and 	="";
			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
				$searchQuery = " AND (d.serial_no like '%".$searchValue."%' OR d.qrcode like '%".$searchValue."%')";
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
							switch($status){
								case 9:
									$status = " AND d.status = '4' AND d.warehouse_id >='1'";
								break;
								case 4:
									$status = " AND d.warehouse_id >= '1'";
								break;
								default:
									$status = " AND d.status = '".$status."'";
								break;
							}
							
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
						case "warehouse":
							$warehouse 	= (!empty($warehouse) ? " AND d.warehouse_id='".$warehouse."'" : "");
							$and 		=  $searchQuery . $warehouse;
							
							
						break;
						case "vendor":
							$vendor 	= (!empty($vendor_id) ? " AND d.vendor_id='".$vendor_id."'" : "");
							$and 		=  $searchQuery . $vendor;
							
							
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
			
			$where 	= " WHERE d.id > 0 " . $and;

			
			$q1 					= "SELECT count(*) as allcount FROM logistics as d " .$where;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
					
			$q2 					= "SELECT count(*) as allcount FROM logistics as d " . $where;
			
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];
				
			$empQuery = "SELECT d.*, 
			v.name as vendor, 
			CONCAT(ins.firstname, ' ', ins.lastname) as inspector, 
			CONCAT(tran.firstname, ' ', tran.lastname) as transit,  
			CONCAT(cust.firstname, ' ', cust.lastname) as custodian,   
			CONCAT(ware.firstname, ' ', ware.lastname) as warehouse,
			sch.name as school, wr.name as wrh 
			FROM logistics as d 
			LEFT JOIN users as ins ON ins.id = d.pa_inspector  
			LEFT JOIN users as tran ON tran.id = d.pa_transit 
			LEFT JOIN users as cust ON cust.id = d.pa_school 
			LEFT JOIN users as ware ON ware.id = d.pa_warehouse 
			LEFT JOIN schools as sch ON sch.id = d.school_id  
			LEFT JOIN warehouses as wr ON wr.id = d.warehouse_id 
			LEFT JOIN vendors as v ON v.id = d.vendor_id 
				".$where." 
				ORDER BY ".$columnName." ".$columnSortOrder . $_limit;

			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
						
						$table = "";
						foreach($empRecords as $c):
							$view_link 		=  Router::url(['controller' => 'logistics', 'action' => 'view', $c['id']]);
							$view_link 	    = '<a href="'.$view_link.'" data-toggle ="modal" data-target ="#form_content_with_place" title ="Package Details" note ="" class="m-t-5 modal_view btn btn-xs btn-success fs-8 bold noborder noradius">DETAILS</a>';
							$status = $this->Message->logisticStatus($c['status']);
							
							$inspector = '<div class="_pa">PA : '.Text::truncate($c['inspector'], 20, ['html' => true]).'</div><div class="text-danger fs-10 bold">'.date('m/d/Y h:i A', strtotime($c['inspect_date'])).'</div>';
							
							if(!empty($c['transit'])){
								$transit = '<div class="_pa">PA : '.Text::truncate($c['transit'], 20, ['html' => true]).'</div><div class="text-danger fs-10 bold">'.date('m/d/Y h:i A', strtotime($c['transit_date'])).'</div>';
							}else{
								$transit = '<div>-</div><div>-</div>';
							}
							
							if(!empty($c['custodian'])){
								$custodian = '<div class="_pa">PA : '.Text::truncate($c['custodian'], 20, ['html' => true]).'</div><div class="text-danger fs-10 bold">'.date('m/d/Y h:i A', strtotime($c['sreceived_date'])).'</div><div class="fs-10 bold">'.Text::truncate($c['school'], 25, ['html' => true]).'</div>';
							}else{
								$custodian = '<div>-</div><div>-</div>';
							}
							
							if(!empty($c['warehouse'])){
								$warehouse = '<div class="_pa">PA : '.Text::truncate($c['warehouse'], 20, ['html' => true]).'</div><div class="text-danger fs-10 bold">'.date('m/d/Y h:i A', strtotime($c['wreceived_date'])).'</div><div>'.Text::truncate($c['wrh'], 25, ['html' => true]).'</div>';
							}else{
								$warehouse = '<div>-</div><div>-</div>';
							}
							
							//$link =  Router::url(['controller' => 'logistics', 'action' => 'view', $c['id'], $c['refid']]);
							$data[] = array( 
								//'id'			=> '<div class="m-t-15">'.$c['id'].'</div>',
								
								'item'			=> '<div>
														<table class="table table-condensed">
															<thead>
																<tr>
																<th style="width: 10%;" class="text-center"><span class="text-info">PACKAGE</span></th>
																<th style="width: 20%;"><span class="text-info">VENDOR</span></th>
																<th style="width: 15%;"><span class="text-info">INSPECTION PERSONNEL</span></th>
																<th style="width: 15%;"><span class="text-info">IN-TRANSIT</span></th>
																<th style="width: 20%;"><span class="text-info">RECEIVED BY SCHOOL</span></th>
																<th style="width: 20%;"><span class="text-info">RECEIVED BY WAREHOUSE</span></th>
																</tr>
															</thead>
															<tbody>
																<tr>	
																	<td class="text-default text-center"><div><i class="fs-20 bold fa fa-qrcode fa-lg"></i></div>'.$view_link.'</td>
																	<td class="text-default">'.Text::truncate($c['vendor'], 25, ['html' => true]).'</td>
																	<td class="text-default">'.$inspector.'</td>
																	<td class="text-default">'.$transit.'</td>
																	<td class="text-default">'.$custodian.'</td>
																	<td class="text-default">'.$warehouse.'</td>
																</tr>
															</tbody>
														</table>
													</div>'
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
	
	public function index(){

	}
	
	
	public function editajax(){
        
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
				//bid
				$form = $this->request->getData();
				$added = 0;
				if(!empty($form['bid'])){
					
					foreach($form['bid'] as $id):
					
					$logistic = $this->Logistics->get($id, [
						'contain' => [],
					]);
					
					$logistic 	= $this->Logistics->patchEntity($logistic, $this->request->getData());
				
					//$couriertxtitem->modified 		= date('Y-m-d H:i:s');
					$logistic->status 			= 2;
					$logistic->pa_transit 		= $this->Auth->user('id');
					$logistic->transit_date 	= date('Y-m-d H:i:s');
					
					if ($this->Logistics->save($logistic)) {
						//add to transaction
						$trans = $this->Logistics->Logistictrans->newEmptyEntity();
						
						$trans_data = array(
							'logistic_id' 	=> $id,
							'status'	  	=> 2,
							'added'		 	=> date('Y-m-d H:i:s'),
							'pa'			=> $this->Auth->user('id')
						);
						
						$trans = $this->Logistics->Logistictrans->newEntity($trans_data, ['validate' => false]);
				
						$this->Logistics->Logistictrans->save($trans);
						$added++;
						
					}
					
					
					
					endforeach;
					
					$msg = "Total " . $added.". Item has been received";
				}else{
					$msg = "No data found";
				}
			
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		

    }
	
	
}
