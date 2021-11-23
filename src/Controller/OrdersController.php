<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class OrdersController extends AppController
{
    public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Purchase Management');
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
	
	public function newrequest(){
		$this->set('group', $this->Auth->user('group_id'));
	}
	
	public function updateorder($refid=null){
		$order 		= $this->Orders->find()->where(['refid' => $refid, 'status' => 'DRAFT'])->first();
		
		if(!empty($order)){
			$db =  ConnectionManager::get('default');
			$vendors 	= $this->Orders->Vendors->find('list')->where(['status' => 'ACTIVE']); 
			//$items 		= $this->Orders->Purchases->find()->where(['order_refid' => $refid])->contain(['Products']); 
			
			$items = "SELECT pur.*, p.name, t.name as tagging FROM purchases as pur 
			LEFT JOIN products as p ON p.id = pur.product_id 
			LEFT JOIN taggings as t ON t.id = p.tagging_id  
			WHERE pur.order_refid = '".$refid."'";

		
			$items = $db->execute($items)->fetchAll('assoc');
			
	
			$payment_types	= $this->Message->paymentTypes();
			$payment_terms	= $this->Message->paymentTerms();
			$payment_status	= $this->Message->paymentStatus();
		
			$this->set(compact('items', 'order', 'payment_types', 'payment_terms', 'payment_status', 'vendors'));
		}else{
			return $this->redirect([
				'controller' => 'orders',
				'action'	 => 'index'
			]);
		}

	}
	
	
	public function saveajax(){
			$this->ajaxLayout();
			 if ($this->request->is('ajax')) {
				
				$_data 	= $this->request->getData();
				$refid	= str_replace(" ", "", microtime() . $this->Common->generateRString());
				
				$_items 			= explode(",", $_data['ids'], -1);
				//$data_to_save 		= array();
				$resp 				= 0;
				//$msg 				= "";
				$p_added			= 0;
				$order_data = array(
					'refid'			=> $refid,
					'added'  		=> date('Y-m-d H:i:s'),
					'added_by'   	=> $this->Auth->user('refid'),
					'status' 		=> 'DRAFT',
					'order_status'	=> 'PENDING'
				);
				
				$order = $this->Orders->newEmptyEntity();
				$order = $this->Orders->newEntity($order_data, ['validate' => true]);
				
				if(count($_items) > 0){
					if ($this->Orders->save($order)) {
						$this->log($this->getTheAuthor()."CREATED PURCHASE ORDER |".$refid, "_info");
						$this->log("WITH TOTAL ITEMS : ".count($_items), "_info");
						
						foreach($_items as $i):
							$purchase = $this->Orders->Purchases->newEmptyEntity();
							$data_to_save = array(
									'order_id' 		=> $order->id,
									'order_refid' 	=> $refid,
									'qty' 			=> 1,
									'product_id' 	=> $i,
									'price' 		=> "0.00",
									'total_price' 	=> "0.00",
									'created' 		=> date('Y-m-d H:i:s'),
								);
							$purchase = $this->Orders->Purchases->newEntity($data_to_save, ['validate' => false]);	
							if($this->Orders->Purchases->save($purchase)){
								$p_added++;
							}
						endforeach;
						$this->log("AND SAVED ITEMS : ".$p_added, "_info");
						
						$resp 	= 1;
						$msg = $this->Message->showMsg('save');

						
					}else{
						
						$err = '';
						if($order->getErrors()){
							//$this->log(json_encode($order->getErrors()));
							$error_msg = [];
							foreach( $order->getErrors() as $errors){
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
				}else{
					$msg = "Please add one (1) or more items in your purchase order";
				}
				
				echo json_encode(array('resp' => $resp, 'msg' => $msg, 'refid' => $refid));
			}
			$this->set(compact('order'));
	}
		
	
   
   public function indexajax(){
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
				case "id":
					$columnName = 'id';
				break;
				default:
					$columnName = 'id';
				break;
			}
			
			$columnSortOrder 	= $_POST['order'][0]['dir']; // asc or desc
			
			## Search 
			$searchValue = '';
			$searchQuery = '';

			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
			    $searchQuery = " WHERE (u.id like '%".$searchValue."%')";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM orders";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM orders as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT u.*, COUNT(pur.id) as total 
			FROM orders as u 
			LEFT JOIN purchases as pur ON pur.order_id = u.id ".$searchQuery." 
			GROUP BY u.id ORDER BY ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
					$view_link 	=  Router::url(['controller' => 'orders', 'action' => 'view', $c['id'], $c['refid']]);
					$edit_link 	=  Router::url(['controller' => 'orders', 'action' => 'view', $c['id'], $c['refid']]);
				    $item  = "";
					
					$data[] = array( 
						'id'			=> str_pad($c['id'], 6, "0", STR_PAD_LEFT),
						'vendor'		=> $c['vendor'],
						'item'			=> $c['total'],
						'total'			=> '<span class="pull-left"><span class="pull-right">'.$c['amount_due'].'</span>',
						'discount'		=> '<span class="pull-left">'.$c['amount_due'].'</span>',
						'due'			=> '<span class="pull-left">'.$c['amount_due'].'</span>',
						'paid'			=> '<span class="pull-left">'.$c['amount_due'].'</span>',
						'balance'		=> '<span class="pull-left">'.$c['amount_due'].'</span>',
						'payment'		=> $c['payment_type'],
						'term'			=> $c['payment_term'],
						'status'		=> $c['order_status'],
						'action' 		=> '<a href="'.$view_link.'" title="Supplier Information" note="" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-success fs-9 bold"><i class="fa fa-eye"></i> VIEW</a>
											<a href="'.$edit_link.'" class="btn btn-xs btn-danger fs-9 bold"><i class="fa fa-edit"></i> EDIT</a>'	
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
		$this->log('Could not process for', '_info');
		//$this->log('Could not process for userid=',  'error');
	}
   
    public function deliveries($id, $refid){
		 $order = $this->Orders->get($id, [
			'refid' => $refid,
            'contain' => ['Orders'],
        ]);
	}

    public function add(){
		
		
        $order = $this->Orders->newEmptyEntity();
        
        $categories 	= $this->Orders->Purchases->Products->Categories->find('list')->where(['status' => 'ACTIVE']); 
        $subcategories 	= $this->Orders->Purchases->Products->Subcategories->find('list')->where(['status' => 'ACTIVE']); 
        $programs 		= $this->Orders->Purchases->Products->Programs->find('list')->where(['status' => 'ACTIVE']); 
        $taggings 		= $this->Orders->Purchases->Products->Taggings->find('list')->where(['status' => 'ACTIVE']); 

        $this->set(compact('order', 'categories', 'taggings', 'subcategories', 'programs'));
    }

   
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
		
		
        $regions 		= $this->getRegionList();
		$provinces 		= $this->getProvinceList($order->regCode);
		$cities 		= $this->getCityList($order->regCode, $order->provCode);
		$barangays 		= $this->getBarangayList($order->regCode, $order->provCode, $order->citymunCode);
       
       
		$this->set('id', $id);
        $this->set(compact('order', 'barangays', 'cities', 'provinces', 'regions'));

    }
	
	public function editajax($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $order = $this->Orders->patchEntity($order, $this->request->getData());
			$order->modified = date('Y-m-d H:i:s');
			$order->modified_by = $this->Auth->user('refid');
					
            if ($this->Orders->save($order)) {
				    $this->log($this->getTheAuthor()."MADE CHANGES TO SUPPLIER - ( #".$order->id." ) ".$order->name, "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($order->getErrors()){
						$error_msg = [];
						foreach( $order->getErrors() as $errors){
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
		
		$this->set(compact('order'));

    }
	
	public function editnotifyajax($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
					//send notification
					$resp 	= 1;
					$msg = $this->Message->showMsg('update_notify');
					
				}else{
					$err = '';
					if($order->getErrors()){
						$error_msg = [];
						foreach( $order->getErrors() as $errors){
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
		
		$this->set(compact('order'));

    }
}
