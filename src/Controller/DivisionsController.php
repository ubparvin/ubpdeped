<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class DivisionsController extends AppController
{
     public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'Division Management');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	public function import(){
        $division = $this->Divisions->newEmptyEntity();
        $this->set(compact('division'));
    }
	
	public function importdivision(){
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
							$_data .='<th>DIVISION</th>';
							$_data .='<th>STATUS</th>';
						$_data .='</tr></thead>';
						$_data .='<tbody>';
						if (($handle = fopen($fileName["tmp_name"], "r")) !== FALSE) {
							fgets($handle);  // read one line for nothing (skip header)
							while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
									
									$data 	= array_map("utf8_encode", $data); 
									$region = strtoupper(trim($data[1]));
									$region = $this->getPlaceCode("region", $region);
									
									if(!empty($region)){
										
										$region 			= $region;
										$name   			= !empty($data[2]) ? strtoupper($data[2]) : "";
										$superintendent   	= !empty($data[3]) ? strtoupper($data[3]) : "";
										$assistant   		= !empty($data[4]) ? strtoupper($data[4]) : "";
										$hq   				= !empty($data[5]) ? strtoupper($data[5]) : "";
										$supply_officer   	= !empty($data[6]) ? strtoupper($data[6]) : "";
										$contact_no   		= $data[7];
										$email   			= $data[8];
										
										$data_to_save = array(
											'regCode'			=> $region,
											'name'				=> $name,
											'sds'				=> $superintendent,
											'asds'				=> $assistant,
											'hqco'				=> $hq,
											'supply_officer'	=> $supply_officer,
											'contact_no'		=> $contact_no,
											'email'				=> $email
										);
										
										$division = $this->Divisions->newEmptyEntity();
										$division = $this->Divisions->newEntity($data_to_save, ['validate' => true]);
											
			
											if ($this->Divisions->save($division)) {
													$save_response = "Added";
													$_added++;
											}else{
													$_notadded++;
													
													$err = '';
													if($division->getErrors()){
														
														$error_msg = [];
														foreach( $division->getErrors() as $errors){
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
													
													$save_response = $err;
											}
										
											
											$_data .='<tr>';
												$_data .='<td>'.$row.'</td>';
												$_data .='<td>'.$name.'</td>';
												$_data .='<td>'.$save_response.'</td>';
											$_data .='</tr>';
									
									}
									
									$row++;
							}
						}
						$_data .='</tbody>';
						$respcode = 1;
					}else{
						$msg = "You have uploaded an invalid file";
					}
				}
			}else{
				$msg = "Unable to read the file, please try again";
			}
			
		   // $this->log($this->getTheAuthor()."SUCCESSFULLY IMPORT A TOTAL PRODUCTS OF ".$_added." & TOTAL FAIL OF ".$_notadded, "_info");
			
			echo json_encode(array("respcode" => $respcode, "message" => $msg, "data" => $_data));	
			
		}
												
			
	}
	
	public function saveajax(){
			$this->ajaxLayout();
			
			 $division = $this->Divisions->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				
				$_school = $this->request->getData();
				$division = $this->Divisions->patchEntity($division, $this->request->getData());

				
				$resp 	= 0;

				
				if ($this->Divisions->save($division)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					$err = '';
					if($division->getErrors()){
						$error_msg = [];
						foreach( $division->getErrors() as $errors){
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
			$this->set(compact('division'));
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
		

			$q1 					= "SELECT count(*) as allcount FROM divisions";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM divisions as s " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT s.* from divisions as s ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
					$view =  Router::url(['controller' => 'divisions', 'action' => 'view', $c['id']]);
					$edit =  Router::url(['controller' => 'divisions', 'action' => 'edit', $c['id']]);
					
				   $data[] = array( 

						'name' 		=> '<div class="bold text-default fs-12">'.$c['name'].'</div>',
						//'action' 	=> '<a href="'.$view.'" title="Divion Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-sm btn-info fs-10"><i class="fa fa-eye"></i> View</a>
						'action' 	=> '<a href="'.$edit.'" title="Update Divion Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-sm btn-info fs-8 bold"><i class="fa fa-edit fa-lg"></i> EDIT</a>'
									
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
        $division = $this->Divisions->get($id, [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions', 'Receivables', 'Receives', 'Users'],
        ]);

        $this->set(compact('office'));
    }*/


    public function add()
    {
        $division = $this->Divisions->newEmptyEntity();
        /*if ($this->request->is('post')) {
            $division = $this->Divisions->patchEntity($division, $this->request->getData());
            if ($this->Divisions->save($division)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The office could not be saved. Please, try again.'));
        }*/
        $barangays = ""; //$this->Divisions->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Divisions->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Divisions->Provinces->find('list', ['limit' => 200]);
        $regions = $this->getRegionList();
        $this->set(compact('division', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function view($id=null){
		$division = $this->Divisions->get($id, [
			'contain' => [],
		]);
		
		$this->set(compact('division'));
	}
	
   
    public function edit($id = null)
    {
        $division = $this->Divisions->get($id, [
            'contain' => [],
        ]);
		
		$this->set('id', $id);
        $barangays = ""; //$this->getBarangayList($division->regCode, $division->provCode, $division->citymunCode);
        $cities = ""; //$this->getCityList($division->regCode, $division->provCode); 
        $provinces = ""; //$this->getProvinceList($division->regCode); 
        $regions = $this->getRegionList();
        $this->set(compact('division', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function editajax($id = null)
    {
        $division = $this->Divisions->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			
           
            $division = $this->Divisions->patchEntity($division, $this->request->getData());
			
			
			
            if ($this->Divisions->save($division)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($division->getErrors()){
						$error_msg = [];
						foreach( $division->getErrors() as $errors){
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
		
		$this->set(compact('division'));

    }
}
