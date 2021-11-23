<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class SchoolsController extends AppController
{
     public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'School Management');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	public function import(){
        $school = $this->Schools->newEmptyEntity();
        $this->set(compact('school'));
    }
	
	public function importschools(){
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
									
									$data 			= array_map("utf8_encode", $data); 
									
									$region 		= strtoupper(trim($data[1]));
									$province 		= strtoupper(trim($data[2]));
									$city 			= strtoupper(trim($data[3]));
									$barangay 		= strtoupper(trim($data[4]));
									$division 		= strtoupper(trim($data[5]));
									
									$region 		= $this->getPlaceCode("region", $region);
									$province 		= $this->getPlaceCode("province", $province);
									$city 			= $this->getPlaceCode("city", $city);
									$barangay 		= $this->getPlaceCode("barangay", $barangay);
									$division 		= $this->getPlaceCode("division", $division);
									
									$name 			= isset($data[8]) ? strtoupper($data[8]) : "";
									$address 		= isset($data[9]) ? strtoupper($data[9]) : "";

									$beis 			= isset($data[7]) ? strtoupper($data[7]) : "";
					
									$district 		= isset($data[6]) ? strtoupper($data[6]) : "";
									
									$ms 			= isset($data[10]) ? strtoupper($data[10]) : "";
									$ld 			= isset($data[11]) ? strtoupper($data[11]) : ""; //legislative district
									$sector 		= isset($data[12]) ? strtoupper($data[12]) : "";
									$sc 			= isset($data[13]) ? strtoupper($data[13]) : ""; //Sub classification
									$type 			= isset($data[14]) ? strtoupper($data[14]) : ""; //School Type
									$iu 			= isset($data[15]) ? strtoupper($data[15]) : ""; //implementing unit
									$co 			= isset($data[16]) ? strtoupper($data[16]) : ""; //circular offering
									$mco 			= isset($data[17]) ? strtoupper($data[17]) : ""; //Modified circular offering
									$added 			= date('Y-m-d H:i:s');	
									
									/*if(!empty($region) && !empty($province)
										&& !empty($city) && !empty($barangay)
									&& !empty($division)){*/
										
										$refid 			= str_replace(" ", "", microtime() . $this->Common->generateRString());
										
										$school_data  = array(
											'name' 				=> $name,
											'regCode' 			=> $region,
											'provCode' 			=> $province,
											'citymunCode' 		=> $city,
											'brgyCode' 			=> $barangay,
											'address' 			=> $address,
											'added' 			=> $added,
											'beis' 				=> $beis,
											'division_id' 		=> $division,
											'district' 			=> $district,
											'ms' 				=> $ms, 		//mother school
											'ld' 				=> $ld,		 	//legislative district
											'sector' 			=> $sector,
											'sc' 				=> $sc, 		//Sub classification
											'type' 				=> $type, 		//School Type
											'iu' 				=> $iu, 		//implementing unit
											'co' 				=> $co, 		//circular offering
											'mco' 				=> $mco 		//Modified circular offering
										);
										
										
								
										$err = '';
										$school = $this->Schools->newEmptyEntity();
										$school = $this->Schools->newEntity($school_data, ['validate' => true]);
											
			
											if ($this->Schools->save($school)) {
												
												$user_data = array(
													'refid'				=> $refid,
													'group_id'			=> 4,
													'role_id'			=> 1,
													'school_id'			=> $school->id,
													
													'firstname'			=> "School",
													'middlename'		=> "",
													'lastname'			=> $beis,
													'birthdate'			=> date('Y-m-d'),
													'username'			=> $beis,
													'password'			=> $beis,
													'regCode'			=> $region,
													'provCode'			=> $province,
													'citymunCode'		=> $city,
													'brgyCode'			=> $barangay,
													
													'address'			=> $address,
													'added'				=> $added,
													'added_by'			=> $this->Auth->user('id'),
													'status'			=> 'ACTIVE',
													'diststaging_id'	=> 9
												);
												
												$user = $this->Schools->Users->newEmptyEntity();
												$user = $this->Schools->Users->newEntity($user_data, ['validate' => true]);
												
												if ($this->Schools->Users->save($user)) {
													$save_response = "Added";
													//$_added++;
												}else{
													
													if($user->getErrors()){
														
														$error_msg = [];
														foreach( $user->getErrors() as $errors){
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
													
													$save_response = "School added only " . $err;
												}
											}else{
													//$_notadded++;
													
													
													if($school->getErrors()){
														
														$error_msg = [];
														foreach( $school->getErrors() as $errors){
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
										
											
											
									//}else{
										//$save_response = "Invalid address tagging <br /> Region : ".$region." <br /> Province : ".$province." <br /> City ".$city."<br /> Barangay : ".$barangay."<br /> Division : ".$division;
									//}
									
									$_data .='<tr>';
										$_data .='<td>'.$row.'</td>';
										$_data .='<td>'.$name.'</td>';
										$_data .='<td>'.$save_response.'</td>';
									$_data .='</tr>';
									
									
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
			
			 $school = $this->Schools->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				
				$_school = $this->request->getData();
				$school = $this->Schools->patchEntity($school, $this->request->getData());
				$school->added = date('Y-m-d H:i:s');
				$school->modified = date('Y-m-d H:i:s');
				//$school->region_id = '02';
				//$user->refid = str_replace(" ", "", microtime() . $this->Common->generateRString());
				$this->log(json_encode($this->request->getData()));
				$resp 	= 0;
				
				$params = array(
					$_school['brgyCode'],
					$_school['citymunCode'],
					$_school['provCode'],
					$_school['regCode'],
				);
				
				$address = $_school['sitio'].' '.$this->generateAddress($params);
				$school->address = $address;
				
				if ($this->Schools->save($school)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					$err = '';
					if($school->getErrors()){
						$error_msg = [];
						foreach( $school->getErrors() as $errors){
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
			$this->set(compact('office'));
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
		

			$q1 					= "SELECT count(*) as allcount FROM schools";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM schools as s " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT s.* from schools as s ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
					$view =  Router::url(['controller' => 'schools', 'action' => 'view', $c['id']]);
					$edit =  Router::url(['controller' => 'schools', 'action' => 'edit', $c['id']]);
					
				   $data[] = array( 
					    /*'name'	=> '<div class="row">
										
										<div class="col-md-12">
											<div class="bold text-default fs-12">'.$c['name'].'</div>
											<div class="fs-10 bold">'.$c['address'].'</div>
										</div>
									</div>',*/
						'name' 		=> '<div class="bold text-default fs-12">'.$c['name'].'</div><div class="fs-10 text-warning bold">'.$c['address'].'</div>',
						//'contact' 	=> $c['contact_person'],
						//'mobile' 	=> $c['mobile_no'].' / '.$c['tel_no'],
						//'created' 	=> $c['added'],
						//'action' 	=> '<a href="'.$view.'" title="School Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-sm btn-info fs-8"><i class="fa fa-eye"></i> VIEW</a>
						'action' 	=> '<a href="'.$edit.'" title="Update School Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-sm btn-info fs-8"><i class="fa fa-edit fa-lg"></i> EDIT</a>'
									
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
        $school = $this->Schools->get($id, [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions', 'Receivables', 'Receives', 'Users'],
        ]);

        $this->set(compact('office'));
    }*/


    public function add()
    {
        $school = $this->Schools->newEmptyEntity();
        /*if ($this->request->is('post')) {
            $school = $this->Schools->patchEntity($school, $this->request->getData());
            if ($this->Schools->save($school)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The office could not be saved. Please, try again.'));
        }*/
        $barangays = ""; //$this->Schools->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Schools->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Schools->Provinces->find('list', ['limit' => 200]);
        $regions = $this->getRegionList();
        $this->set(compact('school', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function view($id=null){
		$school = $this->Schools->get($id, [
			'contain' => [],
		]);
		
		$this->set(compact('school'));
	}
	
   
    public function edit($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => [],
        ]);
		
		$this->set('id', $id);
        $barangays = $this->getBarangayList($school->regCode, $school->provCode, $school->citymunCode);
        $cities = $this->getCityList($school->regCode, $school->provCode); 
        $provinces = $this->getProvinceList($school->regCode); 
        $regions = $this->getRegionList();
        $this->set(compact('school', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function editajax($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			
            $_school = $this->request->getData();
            $school = $this->Schools->patchEntity($school, $this->request->getData());
			
			if(isset($_school['regCode_1']) && !empty($_school['regCode_1'])){
				$school->regCode = $_school['regCode_1'];
			}else{
				$school->regCode = $school->regCode;
			}
			
			$params = array(
					$_school['brgyCode'],
					$_school['citymunCode'],
					$_school['provCode'],
					$_school['regCode'],
				);
				
			$address = $_school['sitio'].' '.$this->generateAddress($params);
			$school->address = $address;
				
				
			
            if ($this->Schools->save($school)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($school->getErrors()){
						$error_msg = [];
						foreach( $school->getErrors() as $errors){
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
		
		$this->set(compact('school'));

    }
}
