<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class RequestsController extends AppController
{
    public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'Purchase Request');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $request = $this->Requests->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				//$this->log(json_encode($this->request->getData()));
				$request = $this->Requests->patchEntity($request, $this->request->getData());
				$resp 	= 0;
				$msg	= '';
				
				$request->added 	= date('Y-m-d H:i:s');
				$request->refid 	= str_replace(" ", "", microtime() . $this->Common->generateRString());
				$request->status 	= "PENDING";
				$request->requestor = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
				
				$user_id 					= $this->Auth->user('id');
				$user_refid 				= $this->Auth->user('refid');
				$request->requestorid 		= $user_id;
				$request->requestorrefid 	= $user_refid;
				$request->school_id		 	= (!empty($this->Auth->user('school_id')) ? $this->Auth->user('school_id') : "");
				
				//$request->details 	= base64_encode(json_encode(array("id" => $user_id, "refid" => $user_refid)));
				
				/*$r_data = $this->request->getData();
				$nr_data = array();
				
				if(!empty($r_data['item'])){
					$i=0;
					foreach($r_data['item'] as $key => $d):
						$i++;
						$nr_data[$i] = array(
							'qty' 	=> $r_data['qty'][$key],
							'type' 	=> $r_data['type'][$key],
							'item' 	=> $d
						);
					endforeach;
				}
				
				$request->items = base64_encode(json_encode($nr_data));*/
				
				if ($this->Requests->save($request)) {
					$resp 	= 1;
					$msg = "Your request for supply has been submitted";
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($request->getErrors()){
						//$this->log(json_encode($request->getErrors()));
						$error_msg = [];
						foreach( $request->getErrors() as $errors){
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
			$this->set(compact('request'));
	}
		
	
   
   /*public function indexajaxtest(){
		$this->ajaxLayout();
		$db =  ConnectionManager::get('default');
		$empQuery = "SELECT c.* from requests as c";

		
		$empRecords = $db->execute($empQuery)->fetchAll('assoc');
		$items = array();
			$i = 0;
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				  $items = json_decode(base64_decode($c['items']));
					foreach($items as $t):
						echo $t->item.'<br />';
					endforeach;
				endforeach;
			endif;
		var_dump($items);
   }*/
   
   public function filter(){
		$request = $this->Requests->newEmptyEntity();
		$status	 = $this->Message->requestStatus();
		$this->set(compact('request', 'status'));
   }
   
   public function view($id=null, $refid=null){
		$this->set('group', $this->Auth->user('group_id'));
		
		$request = $this->Requests->get($id, [
			'refid' => $refid,
            'contain' => [],
        ]);
		
        $this->set(compact('request'));
		
   }
   
   
   public function indexajax($group=null, $type=null, $status=null){
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
				case "#":
					$columnName = 'id';
				break;
				case "REQUESTOR DETAILS":
					$columnName = 'requestor';
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
			
			switch($group){
				case "1": //admin
					if((isset($type) && !empty($type)) && $type=="filter"){
						$where = " WHERE r.status='".$status."'";
					}else{
						$where = " WHERE r.status='PENDING'";
					}
				break;
				default:
					if((isset($type) && !empty($type)) && $type=="filter"){
						
						$where = " WHERE r.requestorid ='".$this->Auth->user('id')."' 
						AND r.requestorrefid = '".$this->Auth->user('refid')."' 
						AND r.status='".$status."'";
					
					}else{
						
						$where = " WHERE r.requestorid ='".$this->Auth->user('id')."' 
						AND r.requestorrefid = '".$this->Auth->user('refid')."'";
					
					}
				break;
			}
			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
				$searchQuery = " AND (r.name like '%".$searchValue."%')";
			}
			

			$q1 					= "SELECT count(*) as allcount FROM requests as r " . $where;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
				
			$q2 					= "SELECT count(*) as allcount FROM requests as r " . $where . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


				
			$empQuery = "SELECT r.*, i.id as itemid, i.name as item, 
			c.name as category, sc.name as subcategory, 
			t.name as tagging, p.name as program, sch.name as school, sch.address as delivery_address, 
			u.mobile_no, u.email 
			from requests as r 
			LEFT JOIN products as i ON i.id = r.product_id 
			LEFT JOIN categories as c on c.id = i.category_id 
			LEFT JOIN subcategories as sc on sc.id = i.subcategory_id 
			LEFT JOIN taggings as t on t.id = i.tagging_id 
			LEFT JOIN programs as p on p.id = i.program_id 
			LEFT JOIN schools as sch on sch.id = r.school_id 
			LEFT JOIN users as u on u.id = r.requestorid  
			". $where . $searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;
			
		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			$items = array();
			$i = 0;
			
			if(!empty($empRecords)):
				
				foreach($empRecords as $c):
				  
				  $link = Router::url(['controller' => 'requests', 'action' => 'view', $c['id'], $c['refid']]);
				  $link2 = Router::url(['controller' => 'orders', 'action' => 'add', $c['id'], $c['refid']]);
				  
				  $data[] = array( 
						'id'			=> $c['id'],
						'requestor'		=> '<div class="bold">'.$c['requestor'].'</div>
								<div class="text-warning fs-10 bold">CONTACT NO: '.$c['mobile_no'].'</div>
								<div class="text-warning fs-10 bold">EMAIL: '.$c['email'].'</div>
								<div class="text-warning fs-10 bold">SCHOOL: '.$c['school'].'</div>',
						'items'			=> $c['qty']." X " .$c['item'].'
										  <div class="text-warning fs-10 bold">PROGRAM: '.$c['program'].'</div>
										  <div class="text-warning fs-10 bold">CATEGORY: '.$c['category'].'</div>
										  <div class="text-warning fs-10 bold">SUB-CATEGORY: '.$c['subcategory'].'</div>
										  <div class="text-warning fs-10 bold">TAGGING: '.$c['tagging'].'</div>',
						'address'		=> '<div class="fs-12 bold">'.$c['school'].'</div><div class="text-warning fs-10 bold">'.$c['delivery_address'].'</div>',
						'added'			=> date('Y-m-d', strtotime($c['added'])),
						'status'		=> $c['status'],
						'action' 		=> '<a href="'.$link.'" data-table = "group_table" 
			                                data-controller = "requests" title="Purchase Request Information" note="Details" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view"><i class="fa fa-eye fa-lg"></i></a>
											<a href="'.$link2.'" data-table = "group_table" 
			                                data-controller = "requests" title="Purchase Request Information" note="Details" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view"><i class="fa fa-user-circle fa-lg"></i></a>'	
				   );
				   $i++;
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
		$this->set('group', $this->Auth->user('group_id'));
	}
	

    public function add(){
		
        $request = $this->Requests->newEmptyEntity();
		$user = $this->Auth->user();
        $this->set(compact('request', 'user'));
    }

   
    public function edit($id = null){
        $request = $this->Requests->get($id, [
            'contain' => [],
        ]);
		
		
		$this->set('id', $id);
        $this->set(compact('request'));

    }
	
	public function editajax($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($request->getErrors()){
						$error_msg = [];
						foreach( $request->getErrors() as $errors){
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
		
		$this->set(compact('request'));

    }
}
