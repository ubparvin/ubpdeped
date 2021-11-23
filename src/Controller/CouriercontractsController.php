<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class CouriercontractsController extends AppController
{
    public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Supplier/couriercontract Management');
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
	
	public function view($id=null, $refid=null){
		$couriercontracts = $this->Couriercontracts->get($id, [
			'contain' => [],
			'refid' => $refid
		]);
		
		$this->set(compact('couriercontract'));
	}
	
	public function orders($id=null, $refid=null){
		
	}

	public function items($id=null, $refid=null){
		
	}
	
	private function createAddress($type=null, $code=null){
		
	}
	
	public function saveajax(){
			$this->ajaxLayout();
			
			 $couriercontract = $this->Couriercontracts->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				
				$couriercontract = $this->Couriercontracts->patchEntity($couriercontract, $this->request->getData());
				$resp 	= 0;
				
				$couriercontract->courier_id = $this->Auth->user('courier_id');
				
				if ($this->Couriercontracts->save($couriercontract)) {
					$this->log($this->getTheAuthor()."ADDED NEW SUPPLIER - ".$_couriercontract['name'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($couriercontract->getErrors()){
						//$this->log(json_encode($couriercontracts->getErrors()));
						$error_msg = [];
						foreach( $couriercontract->getErrors() as $errors){
							if(is_array($errors)){
								foreach($errors as $error){
									$error_msg[]    =   $error;
								}
							}else{
								$error_msg[]    =   $errors;
							}
						}

						if(!empty($error_msg)){
							/*$this->Flash->error(
								__("Please fix the following error(s):".implode("\n \r", $error_msg))
							);*/
							
							$err = $error_msg[0];
						}
					}
					
					$msg = $this->Message->showMsg('save_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
			}
			$this->set(compact('couriercontract'));
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
				case "NAME":
					$columnName = 'name';
				break;
				case "REGISTRATION DATE":
					$columnName = 'added';
				break;
				default:
					$columnName = 'name';
				break;
			}
			
			$columnSortOrder 	= $_POST['order'][0]['dir']; // asc or desc
			
			## Search 
			$searchValue = '';
			$searchQuery = '';

			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
			    $searchQuery = " WHERE u.name like '%".$searchValue."%'";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM couriercontracts";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM couriercontracts as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT u.*, p.name as program, v.name as vendor, co.name as courier 
			from couriercontracts as u 
			LEFT JOIN programs as p ON u.program_id = p.id 
			LEFT JOIN vendors as v ON u.vendor_id = v.id 
			LEFT JOIN couriers as co ON u.courier_id = co.id 
			".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):	
					$view_link 		=  Router::url(['controller' => 'Couriercontracts', 'action' => 'view', $c['id'], $c['refid']]);
					$edit_link 		=  Router::url(['controller' => 'Couriercontracts', 'action' => 'edit', $c['id'], $c['refid']]);
					$order_link 	=  Router::url(['controller' => 'Couriercontracts', 'action' => 'orders', $c['id'], $c['refid']]);
					$items_link 	=  Router::url(['controller' => 'Couriercontracts', 'action' => 'items', $c['id'], $c['refid']]);
				   
				   $data[] = array( 
						'name'			=> '<span>'.$c['name'].'</span><div class="fs-10 text-warning bold">'.$c['description'].'</div>',
						'program'		=> '<span>'.$c['program'].'</span></span><div class="fs-10 text-warning bold">'.$c['contract_year'].'</div>',
						'vendor'		=> '<span>'.$c['vendor'].'</span>',
						'courier'		=> '<span>'.$c['courier'].'</span>',
						'level'		=> '<span>'.$c['level'].'</span>',
						//'action' 		=> '<a href="'.$view_link.'" title="Supplier Information" note="" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-info fs-8 bold"><i class="fa fa-eye"></i> VIEW</a>
						'action' 		=> '<a href="'.$edit_link.'" title="Update Contract Information" note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-info fs-8 bold"><i class="fa fa-edit"></i> EDIT</a>'
										
									
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
		//$this->log('Could not process for', '_info');
		//$this->log('Could not process for userid=',  'error');
	}
   
    public function deliveries($id, $refid){
		 $couriercontract = $this->Couriercontracts->get($id, [
			'refid' => $refid,
            'contain' => ['Orders'],
        ]);
	}

    public function add()
    {
        $couriercontract = $this->Couriercontracts->newEmptyEntity();
        
        $programs 	= $this->Couriercontracts->Programs->find('list')->order(['name' => 'ASC']);
        $vendors 	= $this->Couriercontracts->Vendors->find('list')->order(['name' => 'ASC']);
        $this->set(compact('couriercontract', 'vendors', 'programs'));
    }

   
    public function edit($id = null)
    {
        $couriercontract = $this->Couriercontracts->get($id, [
            'contain' => [],
        ]);
		
		
        $programs 	= $this->Couriercontracts->Programs->find('list')->order(['name' => 'ASC']);
        $vendors 	= $this->Couriercontracts->Vendors->find('list')->order(['name' => 'ASC']);
        $this->set(compact('couriercontract', 'vendors', 'programs'));
		$this->set('id', $id);
    }
	
	public function editajax($id = null)
    {
        $couriercontract = $this->Couriercontracts->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			
            $couriercontract = $this->Couriercontracts->patchEntity($couriercontract, $this->request->getData());
			
            if ($this->Couriercontracts->save($couriercontract)) {
				    //$this->log($this->getTheAuthor()."MADE CHANGES TO SUPPLIER - ( #".$couriercontract->id." ) ".$couriercontract->name, "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($couriercontract->getErrors()){
						$error_msg = [];
						foreach( $couriercontract->getErrors() as $errors){
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
		
		$this->set(compact('couriercontract'));

    }
	
	public function editnotifyajax($id = null)
    {
        $couriercontract = $this->Couriercontracts->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $couriercontract = $this->Couriercontracts->patchEntity($couriercontract, $this->request->getData());
            if ($this->Couriercontracts->save($couriercontract)) {
					//send notification
					$resp 	= 1;
					$msg = $this->Message->showMsg('update_notify');
					
				}else{
					$err = '';
					if($couriercontract->getErrors()){
						$error_msg = [];
						foreach( $couriercontract->getErrors() as $errors){
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
		
		$this->set(compact('couriercontract'));

    }
	
}
