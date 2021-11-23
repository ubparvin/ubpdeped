<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;


class PurchasesController extends AppController
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
	
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $purchase = $this->Purchases->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_vendor = $this->request->getData();
				$purchase = $this->Purchases->patchEntity($purchase, $_vendor);
				
				$purchase->added  	= date('Y-m-d H:i:s');
				$purchase->added_by   = $this->Auth->user('refid');
				$purchase->status 	= 'ACTIVE';
				$purchase->refid  	= str_replace(" ", "", microtime() . $this->Common->generateRString());
				
			
				$resp 	= 0;
				
				if ($this->Purchases->save($purchase)) {
					$this->log($this->getTheAuthor()."ADDED NEW SUPPLIER - ".$_vendor['name'], "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($purchase->getErrors()){
						//$this->log(json_encode($purchase->getErrors()));
						$error_msg = [];
						foreach( $purchase->getErrors() as $errors){
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
			$this->set(compact('purchase'));
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
		

			$q1 					= "SELECT count(*) as allcount FROM Purchases";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM Purchases as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT u.* from Purchases as u ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				   $data[] = array( 
						'name'			=> '<span class="text-'.$c['status'].'">'.$c['name'].'</span>',
						'manage'		=> '<span class="text-'.$c['status'].'">'.$c['operatedby'].'</span>',
						'license'		=> '<span class="text-'.$c['status'].'">'.$c['license_no'].'</span>',
						'created'		=> '<span class="text-'.$c['status'].'">'.$c['added'].'</span>',
						'status'		=> '<span class="text-'.$c['status'].'">'.$c['status'].'</span>',
						'action' 		=> '<a href="Purchases/edit/'.$c['id'].'" title="Update Supplier Information" note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view"><i class="fa fa-eye fa-lg"></i></a>
										   <a href="Purchases/deliveries/'.$c['id'].'/'.$c['refid'].'" title="Deliverables" note="" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view m-l-10"><i class="fa fa-truck-loading fa-lg"></i></a>'
									
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
		 $purchase = $this->Purchases->get($id, [
			'refid' => $refid,
            'contain' => ['Orders'],
        ]);
	}

    public function add()
    {
        $purchase = $this->Purchases->newEmptyEntity();
        
        $barangays 	= ""; //$this->Purchases->Barangays->find('list', ['limit' => 200]);
        $cities 	= ""; //$this->Purchases->Cities->find('list', ['limit' => 200]);
        $provinces 	= ""; //$this->Purchases->Provinces->find('list', ['limit' => 200]);
        $regions 	= $this->getRegionList();
        $this->set(compact('purchase', 'barangays', 'cities', 'provinces', 'regions'));
    }

   
    public function edit($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [],
        ]);
		
		
        $regions 		= $this->getRegionList();
		$provinces 		= $this->getProvinceList($purchase->regCode);
		$cities 		= $this->getCityList($purchase->regCode, $purchase->provCode);
		$barangays 		= $this->getBarangayList($purchase->regCode, $purchase->provCode, $purchase->citymunCode);
       
       
		$this->set('id', $id);
        $this->set(compact('purchase', 'barangays', 'cities', 'provinces', 'regions'));

    }
	
	public function editajax($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
			$purchase->modified = date('Y-m-d H:i:s');
			$purchase->modified_by = $this->Auth->user('refid');
					
            if ($this->Purchases->save($purchase)) {
				    $this->log($this->getTheAuthor()."MADE CHANGES TO SUPPLIER - ( #".$purchase->id." ) ".$purchase->name, "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($purchase->getErrors()){
						$error_msg = [];
						foreach( $purchase->getErrors() as $errors){
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
		
		$this->set(compact('purchase'));

    }
	
	public function editnotifyajax($id = null)
    {
        $purchase = $this->Purchases->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $purchase = $this->Purchases->patchEntity($purchase, $this->request->getData());
            if ($this->Purchases->save($purchase)) {
					//send notification
					$resp 	= 1;
					$msg = $this->Message->showMsg('update_notify');
					
				}else{
					$err = '';
					if($purchase->getErrors()){
						$error_msg = [];
						foreach( $purchase->getErrors() as $errors){
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
		
		$this->set(compact('purchase'));

    }
}
