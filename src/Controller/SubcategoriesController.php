<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;


class SubcategoriesController extends AppController
{
    public function initialize(): void
	 {
        parent::initialize();
		$this->set('title', 'Inventory Management');
	 }
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
		}
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $subcategory = $this->Subcategories->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				//$this->log(json_encode($this->request->getData()));
				$subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->getData());
				$resp 	= 0;
				
				if ($this->Subcategories->save($subcategory)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($subcategory->getErrors()){
						//$this->log(json_encode($subcategory->getErrors()));
						$error_msg = [];
						foreach( $subcategory->getErrors() as $errors){
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
			$this->set(compact('subcategory'));
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
				case "DESCRIPTION":
					$columnName = 'description';
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
			    $searchQuery = " WHERE (c.name like '%".$searchValue."%')";
			}
		

			$q1 					= "SELECT count(*) as allcount FROM subcategories";
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
			
			$q2 					= "SELECT count(*) as allcount FROM subcategories as c " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];


			if($rowperpage > 0){
				$_limit  = " limit ".$row.", ".$rowperpage;
				//$_limit  = " limit 10";
			}else{
				$_limit  = '';
			}
			
			$empQuery = "SELECT c.* from subcategories as c ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				  $data[] = array( 
						'id'			=> $c['id'],
						'name'			=> $c['name'],
						'stat'			=> $c['status'],
						'action' 		=> '<a href="../subcategories/edit/'.$c['id'].'" data-table = "subcategory_table" 
			                                data-controller = "subcategories" title="Update Category Information" note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_sub"  class="modal_view_sub"><i class="fa fa-eye fa-lg"></i></a>'	
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
		/* $this->paginate = [
            'contain' => [],
        ];
        $subcategory = $this->paginate($this->Subcategories);

        $this->set(compact('subcategory'));*/
	}
   
   

    public function add(){
        $subcategory = $this->Subcategories->newEmptyEntity();
        $this->set(compact('subcategory'));
    }

   
    public function edit($id = null){
        $subcategory = $this->Subcategories->get($id, [
            'contain' => [],
        ]);
		
		
		$this->set('id', $id);
        $this->set(compact('subcategory'));

    }
	
	public function editajax($id = null)
    {
        $subcategory = $this->Subcategories->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategories->save($subcategory)) {
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
					if($subcategory->getErrors()){
						$error_msg = [];
						foreach( $subcategory->getErrors() as $errors){
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
		
		$this->set(compact('subcategory'));

    }
}
