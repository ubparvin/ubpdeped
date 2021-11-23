<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;

class OfficesController extends AppController
{
	 public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'Office Management');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			//$this->render(false);
			$this->autoRender = false;
			$this->view = false;
		}
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $office = $this->Offices->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				
				$office = $this->Offices->patchEntity($office, $this->request->getData());
				$office->added = date('Y-m-d H:i:s');
				$office->modified = date('Y-m-d H:i:s');
				//$office->region_id = '02';
				//$user->refid = str_replace(" ", "", microtime() . $this->Common->generateRString());
				$this->log(json_encode($this->request->getData()));
				$resp 	= 0;
				
				if ($this->Offices->save($office)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					$err = '';
					if($office->getErrors()){
						$error_msg = [];
						foreach( $office->getErrors() as $errors){
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
			    $searchQuery = " WHERE (o.name like '%".$searchValue."%')";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM offices";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM offices as o " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT o.* from offices as o ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				   $data[] = array( 
					    /*'name'	=> '<div class="row">
										
										<div class="col-md-12">
											<div class="bold text-default fs-12">'.$c['name'].'</div>
											<div class="fs-10 bold">'.$c['address'].'</div>
										</div>
									</div>',		*/
						'name' 		=> '<div class="bold text-default">'.$c['name'].'</div><div class="fs-10 text-warning">ADDRESS : '.$c['address'].'</div>',
						'contact' 	=> $c['contact_person'],
						'mobile' 	=> $c['mobile_no'].' / '.$c['tel_no'],
						'created' 	=> $c['added'],
						'action' 	=> '<a href="offices/edit/'.$c['id'].'" title="Update Office Information", note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view"><i class="fa fa-edit fa-lg"></i></a>'
									
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
   
    /*public function view($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions', 'Receivables', 'Receives', 'Users'],
        ]);

        $this->set(compact('office'));
    }*/


    public function add()
    {
        $office = $this->Offices->newEmptyEntity();
        if ($this->request->is('post')) {
            $office = $this->Offices->patchEntity($office, $this->request->getData());
            if ($this->Offices->save($office)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The office could not be saved. Please, try again.'));
        }
        $barangays = ""; //$this->Offices->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Offices->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Offices->Provinces->find('list', ['limit' => 200]);
        $regions = ""; //$this->getRegionList();
        $this->set(compact('office', 'barangays', 'cities', 'provinces', 'regions'));
    }

   
    public function edit($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => [],
        ]);
		
		$this->set('id', $id);
        $barangays = $this->getBarangayList($office->regCode, $office->provCode, $office->citymunCode);
        $cities = $this->getCityList($office->regCode, $office->provCode); 
        $provinces = $this->getProvinceList($office->regCode); 
        $regions = ""; //$this->getRegionList();
        $this->set(compact('office', 'barangays', 'cities', 'provinces', 'regions'));
    }
	
	public function editajax($id = null)
    {
        $office = $this->Offices->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			
			$_office = $this->request->getData();
            $office = $this->Offices->patchEntity($office, $this->request->getData());
			
			if(isset($_office['regCode_1']) && !empty($_office['regCode_1'])){
				$office->regCode = $_office['regCode_1'];
			}else{
				$office->regCode = $office->regCode;
			}
			
            if ($this->Offices->save($office)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($office->getErrors()){
						$error_msg = [];
						foreach( $office->getErrors() as $errors){
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
					
					$msg = $this->Message->showMsg('update_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		$this->set(compact('office'));

    }

    /**
     * Delete method
     *
     * @param string|null $id Office id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $office = $this->Offices->get($id);
        if ($this->Offices->delete($office)) {
            $this->Flash->success(__('The office has been deleted.'));
        } else {
            $this->Flash->error(__('The office could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/
}
