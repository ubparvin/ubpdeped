<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class WarehousesController extends AppController
{
     public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'Warehouse Management');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
		}
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $warehouse = $this->Warehouses->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				
				$warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
				$warehouse->added = date('Y-m-d H:i:s');
				$warehouse->modified = date('Y-m-d H:i:s');
				//$warehouse->region_id = '02';
				//$user->refid = str_replace(" ", "", microtime() . $this->Common->generateRString());
				//$this->log(json_encode($this->request->getData()));
				$resp 	= 0;
				
				$_wrhouse = $this->request->getData();
				$params = array(
					$_wrhouse['brgyCode'],
					$_wrhouse['citymunCode'],
					$_wrhouse['provCode'],
					$_wrhouse['regCode'],
				);
				
				$address = $_wrhouse['sitio'].' '.$this->generateAddress($params);
				$warehouse->address = $address;
				
				if ($this->Warehouses->save($warehouse)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					$err = '';
					if($warehouse->getErrors()){
						$error_msg = [];
						foreach( $warehouse->getErrors() as $errors){
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
			$this->set(compact('warehouse'));
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
				case "ACTION":
				case "NAME & ADDRESS":
					$columnName = 'name';
				break;
				case "CREATED":
					$columnName = 'added';
				break;
				case "CONTACT NO.":
					$columnName = 'mobile_no';
				break;
				case "CONTACT PERSON":
					$columnName = 'contact_person';
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
			    $searchQuery = " WHERE (s.name like '%".$searchValue."%')";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM warehouses";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM warehouses as s " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT s.*, prov.provDesc as province, cty.citymunDesc as city from warehouses as s 
			LEFT JOIN provinces as prov ON prov.provCode = s.provCode  
			LEFT JOIN cities as cty ON cty.citymunCode = s.citymunCode  
			".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
					$view =  Router::url(['controller' => 'warehouses', 'action' => 'view', $c['id']]);
					$edit =  Router::url(['controller' => 'warehouses', 'action' => 'edit', $c['id']]);
				
				
				   $data[] = array( 
					    /*'name'	=> '<div class="row">
										
										<div class="col-md-12">
											<div class="bold text-default fs-12">'.$c['name'].'</div>
											<div class="fs-10 bold">'.$c['address'].'</div>
										</div>
									</div>',*/
						'name' 		=> '<div class="bold text-default">'.$c['name'].'</div><div class="bold text-warning fs-10">'.$c['province'].' '.$c['city'].'</div>',
						//'action' 	=> '<a href="'.$view.'" title="Update Warehouse Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view  btn btn-sm btn-info fs-10"><i class="fa fa-eye fa-lg"></i> View</a>
						'action' 	=> '<a href="'.$edit.'" title="Update Warehouse Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view  btn btn-sm btn-info fs-8 bold"><i class="fa fa-edit fa-lg"></i> EDIT</a>'
									
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
   
    /*public function view($id = null)
    {
        $warehouse = $this->Warehouses->get($id, [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions', 'Receivables', 'Receives', 'Users'],
        ]);

        $this->set(compact('office'));
    }*/


    public function add()
    {
        $warehouse = $this->Warehouses->newEmptyEntity();
        /*if ($this->request->is('post')) {
            $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
            if ($this->Warehouses->save($warehouse)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The office could not be saved. Please, try again.'));
        }*/
        $barangays = ""; //$this->Warehouses->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Warehouses->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Warehouses->Provinces->find('list', ['limit' => 200]);
        $regions = $this->getRegionList();
        $this->set(compact('warehouse', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function view($id=null){
		$warehouse = $this->Warehouses->get($id, [
			'contain' => [],
		]);
		
		$this->set(compact('warehouse'));
	}
   
    public function edit($id = null)
    {
        $warehouse = $this->Warehouses->get($id, [
            'contain' => [],
        ]);
		
		$this->set('id', $id);
        $barangays = $this->getBarangayList($warehouse->regCode, $warehouse->provCode, $warehouse->citymunCode);
        $cities = $this->getCityList($warehouse->regCode, $warehouse->provCode); 
        $provinces = $this->getProvinceList($warehouse->regCode); 
        $regions = $this->getRegionList(); 
        $this->set(compact('warehouse', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function editajax($id = null)
    {
        $warehouse = $this->Warehouses->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			
            $_wh = $this->request->getData();
            $warehouse = $this->Warehouses->patchEntity($warehouse, $this->request->getData());
			
			$params = array(
				$_wh['brgyCode'],
				$_wh['citymunCode'],
				$_wh['provCode'],
				$_wh['regCode'],
			);
				
			$address = $_wh['sitio'].' '.$this->generateAddress($params);
			$warehouse->address = $address;
				
            if ($this->Warehouses->save($warehouse)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($warehouse->getErrors()){
						$error_msg = [];
						foreach( $warehouse->getErrors() as $errors){
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
		
		$this->set(compact('warehouse'));

    }
}
