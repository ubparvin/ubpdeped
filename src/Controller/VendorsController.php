<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class VendorsController extends AppController
{
    public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Supplier/Vendor Management');
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
		$vendor = $this->Vendors->get($id, [
			'contain' => [],
			'refid' => $refid
		]);
		
		$this->set(compact('vendor'));
	}
	
	public function orders($id=null, $refid=null){
		
	}

	public function items($id=null, $refid=null){
		
	}
	
	private function createAddress($type=null, $code=null){
		
	}
	
	public function saveajax(){
			$this->ajaxLayout();
			
			 $vendor = $this->Vendors->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_vendor = $this->request->getData();
				$vendor = $this->Vendors->patchEntity($vendor, $_vendor);
				
				$vendor->added  	= date('Y-m-d H:i:s');
				$vendor->added_by   = $this->Auth->user('refid');
				$vendor->status 	= 'ACTIVE';
				$vendor->refid  	= str_replace(" ", "", microtime() . $this->Common->generateRString());
				
				$params = array(
					$_vendor['brgyCode'],
					$_vendor['citymunCode'],
					$_vendor['provCode'],
					$_vendor['regCode'],
				);
				
				$address = $_vendor['sitio'].' '.$this->generateAddress($params);
				$vendor->address = $address;
				
				$resp 	= 0;
				
				if ($this->Vendors->save($vendor)) {
					$this->log($this->getTheAuthor()."ADDED NEW SUPPLIER - ".$_vendor['name'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($vendor->getErrors()){
						//$this->log(json_encode($vendor->getErrors()));
						$error_msg = [];
						foreach( $vendor->getErrors() as $errors){
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
			$this->set(compact('vendor'));
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
			    $searchQuery = " WHERE (u.name like '%".$searchValue."%')";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM vendors";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM vendors as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT u.* from vendors as u ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):	
					$view_link 		=  Router::url(['controller' => 'vendors', 'action' => 'view', $c['id'], $c['refid']]);
					$edit_link 		=  Router::url(['controller' => 'vendors', 'action' => 'edit', $c['id'], $c['refid']]);
					$order_link 	=  Router::url(['controller' => 'vendors', 'action' => 'orders', $c['id'], $c['refid']]);
					$items_link 	=  Router::url(['controller' => 'vendors', 'action' => 'items', $c['id'], $c['refid']]);
				   
				   $data[] = array( 
						'name'			=> '<span>'.$c['name'].'</span><div class="fs-10 text-warning bold">'.$c['address'].'</div>',
						'manage'		=> '<span>'.$c['operatedby'].'</span><div class="fs-10 text-warning">CONTACT NO : '.$c['mobile_no'].' / '.$c['tel_no'].'</div><div class="fs-10 text-warning">CONTACT PERSON : '.$c['contact_person'].'</div><div class="fs-10 text-warning">EMAIL : '.$c['email'].'</div>',
						'license'		=> '<span>'.$c['license_no'].'</span>',
						'created'		=> '<span>'.date('m/d/Y', strtotime($c['added'])).'</span>',
						'status'		=> '<span class="text-'.$c['status'].'">'.$c['status'].'</span>',
						//'action' 		=> '<a href="'.$view_link.'" title="Supplier Information" note="" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-info fs-8 bold"><i class="fa fa-eye"></i> VIEW</a>
						'action' 		=> '<a href="'.$edit_link.'" title="Update Supplier Information" note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-info fs-8 bold"><i class="fa fa-edit"></i> EDIT</a>'
										
									
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
		 $vendor = $this->Vendors->get($id, [
			'refid' => $refid,
            'contain' => ['Orders'],
        ]);
	}

    public function add()
    {
        $vendor = $this->Vendors->newEmptyEntity();
        
        $barangays 	= ""; //$this->Vendors->Barangays->find('list', ['limit' => 200]);
        $cities 	= ""; //$this->Vendors->Cities->find('list', ['limit' => 200]);
        $provinces 	= ""; //$this->Vendors->Provinces->find('list', ['limit' => 200]);
        $regions 	= $this->getRegionList();
        $this->set(compact('vendor', 'barangays', 'cities', 'provinces', 'regions'));
    }

   
    public function edit($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => [],
        ]);
		
		
        $regions 		= $this->getRegionList();
		$provinces 		= $this->getProvinceList($vendor->regCode);
		$cities 		= $this->getCityList($vendor->regCode, $vendor->provCode);
		$barangays 		= $this->getBarangayList($vendor->regCode, $vendor->provCode, $vendor->citymunCode);
       
       
		$this->set('id', $id);
        $this->set(compact('vendor', 'barangays', 'cities', 'provinces', 'regions'));

    }
	
	public function editajax($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			$_vendor = $this->request->getData();
			
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
			$vendor->modified = date('Y-m-d H:i:s');
			$vendor->modified_by = $this->Auth->user('refid');
			
			$params = array(
					$_vendor['brgyCode'],
					$_vendor['citymunCode'],
					$_vendor['provCode'],
					$_vendor['regCode'],
			);
				
			$address = $_vendor['sitio'].' '.$this->generateAddress($params);
			$vendor->address = $address;
				
            if ($this->Vendors->save($vendor)) {
				    $this->log($this->getTheAuthor()."MADE CHANGES TO SUPPLIER - ( #".$vendor->id." ) ".$vendor->name, "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($vendor->getErrors()){
						$error_msg = [];
						foreach( $vendor->getErrors() as $errors){
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
		
		$this->set(compact('vendor'));

    }
	
	public function editnotifyajax($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->getData());
            if ($this->Vendors->save($vendor)) {
					//send notification
					$resp 	= 1;
					$msg = $this->Message->showMsg('update_notify');
					
				}else{
					$err = '';
					if($vendor->getErrors()){
						$error_msg = [];
						foreach( $vendor->getErrors() as $errors){
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
		
		$this->set(compact('vendor'));

    }
	
}
