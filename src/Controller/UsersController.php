<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;

class UsersController extends AppController
{
	
	public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Account Management');
		$this->Auth->allow(['login','logout']);
	 }
	
	
	public function filter(){
		

			$user 		= $this->Users->newEmptyEntity();
			$groups 	= $this->Users->Groups->find('list');
			$couriers 	= $this->Users->Couriers->find('list');
			
			$this->set(compact('user', 'groups', 'couriers'));
		
    
    }
	
	public function login(){
		$this->viewBuilder()->setLayout('login');
		if($this->request->is('post')){
			$user = $this->Auth->identify();
			if($user){
				
				
				$this->Auth->setUser($user);
				//return $this->redirect($this->Auth->redirectUrl());
				if($this->Auth->User('group_id')==1 || $this->Auth->User('group_id')==3){
					$userTable = $this->getTableLocator()->get('Users');
					$_user = $userTable->get($this->Auth->user('id')); 

					$_user->last_access = date('Y-m-d H:i:s');
					$userTable->save($_user);
						
						
					return $this->redirect([
						//'controller' => 'users',
						//'controller' => 'distributions',
						'controller' => 'logistics',
						//'action'	=> 'dashboard'
						'action'	=> 'index'
					]);
				}else{
					$this->Flash->success('Only admin is allowed to view the dashboard.');
					return $this->redirect([
						'controller' => 'users',
						'action'	=> 'logout'
					]);
				}
			}
			$this->Flash->error('Sign failed. You have provided an invalid credentials.');
		}
	}
	
	private function getTheAuthor(){
		$name = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
		$id   = $this->Auth->user('id');
		return $name." (#".$id.") ";
	}
	
	public function logout(){
		
		if($this->request->is('ajax')){
			$this->ajaxLayout();
			$this->Auth->logout();
		}else{
			$this->Flash->success('You have signed-off your account.');
			return $this->redirect($this->Auth->logout());
		}
	}
	
	
	public function dashboard(){
		$this->set('group', $this->Auth->user('group_id'));
		
	}
	
	 
    private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	private function disableView(){
		if($this->request->is('ajax')){
			return true;
		}else{
			$this->autoRender = false;
			$this->view = false;
		}
	}
	
		
	public function saveajax(){
			$this->ajaxLayout();
			
			 $user = $this->Users->newEmptyEntity();
			 if ($this->request->is('ajax')) {
				
				$_user = $this->request->getData();
				$user = $this->Users->patchEntity($user, $this->request->getData());
				
				$user->added = date('Y-m-d H:i:s');
				//$user->modified = date('Y-m-d H:i:s');
				$user->status = 'ACTIVE';
				$refid = str_replace(" ", "", microtime() . $this->Common->generateRString());
				$user->refid = $refid;
				$user->role_id = 1;
				$user->disstaging_id = 1;
				$user->added_by = $this->Auth->user('refid');
				
				$params = array(
					$_user['brgyCode'],
					$_user['citymunCode'],
					$_user['provCode'],
					$_user['regCode'],
				);
				
				$address = $_user['sitio'].' '.$this->generateAddress($params);
				$user->address = $address;
				
				//$this->log(json_encode($this->request->getData()));
				//$this->log("BD".$_user["birthdate"]);
				
				if(!empty($_user["birthdate"]) && !empty($_user["lastname"])){
					$user->username = substr($_user["lastname"], 0, 4) . date('mdY', strtotime($_user["birthdate"]));
					$user->password = date('mdY', strtotime($_user["birthdate"]));
				}
				
				if(empty($_user['diststaging_id'])){
					$user->diststaging_id = 10;
				}
				
				$resp 	= 0;
				
				if ($this->Users->save($user)){
					$this->log($this->getTheAuthor()." CREATED NEW ACCOUNT ". $refid, "_info");
					$resp 	= 1;
					$msg = $this->Message->showMsg('save');
					//notify the user and send the code for later use
				}else{
					//$this->log(json_encode($this->request->getData()));
					$err = '';
					if($user->getErrors()){
						//$this->log(json_encode($user->getErrors()));
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
			$this->set(compact('user'));
	}
		
	
   
   public function indexajax($type=null, $group_id=null, $courier_id=null){
		$this->ajaxLayout();
		
		//echo $request->getParam('_csrfToken');
		
		if($this->request->is('ajax')){
			
			$data 	= array();
			$db 	=  ConnectionManager::get('default');
			//$this->log(json_encode($_POST)); 
			
			$draw 				= $_POST['draw'];
			$row 				= $_POST['start'];
			$rowperpage 		= ((isset($_POST['length']) && $_POST['length'] > 0) ? $_POST['length'] : -1); // Rows display per page
			$columnIndex 		= $_POST['order'][0]['column']; //Column index
			$columnName 		= $_POST['columns'][$columnIndex]['data']; //Column name
		
						
			switch($columnName){
				case "NAME & CONTACT INFO":
					$columnName = 'firstname';
				break;
				case "ACCESS GROUP":
					$columnName = 'group_id';
				break;
				case "CREATED":
					$columnName = 'created';
				break;
				case "MODIFIED":
					$columnName = 'modified';
				break;
				case "LAST ACCESS":
					$columnName = 'last_access';
				break;
				default:
					$columnName = 'lastname';
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
			
			$g_q = '';
			$c_q = '';
			$where = " WHERE u.id > 1";
			
			if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
				$searchValue = $_POST['search']['value']; // Search value
				$searchQuery = " AND ((u.firstname like '%".$searchValue."%') OR (u.lastname like '%".$searchValue."%'))";
			}
				
			if((isset($type) && !empty($type)) && $type=="filter"){
				$g_q = '';
				$c_q = '';
				
				if(!empty($group_id)){
					$g_q = " AND u.group_id ='".$group_id."' ";
				}
				
				if(!empty($courier_id)){
					$c_q = " AND u.courier_id ='".$courier_id."' ";
				}
				
					
			}

			$searchQuery = $searchQuery . $where . $g_q . $c_q;
				
			$q1 					= "SELECT count(*) as allcount FROM users as u " . $searchQuery;
			$records 				= $db->execute($q1)->fetchAll('assoc');
			$totalRecords 			= $records[0]['allcount'];
				
			$q2 					= "SELECT count(*) as allcount FROM users as u " . $searchQuery;
			$records 				= $db->execute($q2)->fetchAll('assoc');
			$totalRecordwithFilter 	= $records[0]['allcount'];
			
			$empQuery = "SELECT u.*, g.name as gname, st.description as staging, r.name as rname from users as u 
			LEFT JOIN groups as g ON g.id = u.group_id 
			LEFT JOIN diststagings as st ON st.id  = u.diststaging_id 
			LEFT JOIN roles as r ON r.id = u.role_id ".$searchQuery." 
			order by ".$columnName." ".$columnSortOrder . $_limit;

		
			$empRecords = $db->execute($empQuery)->fetchAll('assoc');
			
			//var_dump($empRecords);
			
			if(!empty($empRecords)):
				foreach($empRecords as $c):
				   $view_link 		=  Router::url(['controller' => 'users', 'action' => 'edit', $c['id'], $c['refid']]);
					
				   $data[] = array( 
						//'info'			=> '<div>'.$c['firstname'].' '.$c['middlename'].' '.$c['lastname'].'</div><div class="fs-10 text-info"><span class="text-warning"></span> '.$c['mobile_no'].' / '.$c['email'].'</div>',
						'info'			=> '<div>'.$c['firstname'].' '.$c['middlename'].' '.$c['lastname'].'</div>',
						'group'			=> '<div>'.$c['gname'].'</div><div>'.$c['username'].'</div>',
						'added'			=> '<div>'.date('m/d/Y', strtotime($c['added'])).'</div>',
						'modified'		=> '<div>'.date('m/d/Y', strtotime($c['modified'])).'</div>',
						'access'		=> (!empty($c['last_access']) ? $c['last_access'] : "--"),
						'status'		=> ($c['status']=="ACTIVE" ? '<span class="text-success">ACTIVE</span>' : '<span class="text-danger">'.$c['status'].'</span>'),
						'action' 		=> '<a href="'.$view_link.'" title="Update Account Information" note="Required fields are marked with *" data-toggle="modal" data-target="#form_content_with_place"  class="modal_view btn btn-xs btn-info fs-8 bold"><i class="fa fa-edit fa-lg"></i> EDIT</a>'			
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

    public function add(){
		$this->disableView();
        $user = $this->Users->newEmptyEntity();
        /*if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The office has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The office could not be saved. Please, try again.'));
        }*/
        $roles = $this->Users->Roles->find('list');
        $groups = $this->Users->Groups->find('list')->where(['id >' => 1])->order(['name' => 'ASC']);
        $offices = $this->Users->Offices->find('list')->order(['name' => 'asc']);
        $schools = $this->Users->Schools->find('list')->order(['name' => 'asc'])->limit(100);
        $couriers = $this->Users->Couriers->find('list')->order(['name' => 'asc']);
        $warehouses = $this->Users->Warehouses->find('list')->order(['name' => 'asc']);
        $barangays = ""; //$this->Users->Barangays->find('list', ['limit' => 200]);
        $cities = ""; //$this->Users->Cities->find('list', ['limit' => 200]);
        $provinces = ""; //$this->Users->Provinces->find('list', ['limit' => 200]);
        $regions = $this->getRegionList();
		$diststagings = $this->Users->Diststagings->find('list')->where(['id <' => 11])->order(['id' => 'ASC']);
		
        $this->set(compact('user', 'schools', 'couriers', 'warehouses', 'diststagings', 'roles', 'groups', 'offices', 'schools', 'barangays', 'cities', 'provinces', 'regions'));
    }

   
    public function edit($id = null)
    {
			$this->disableView();
			$user = $this->Users->get($id, [
				'contain' => [],
			]);
			
			$roles = $this->Users->Roles->find('list');
			$groups = $this->Users->Groups->find('list')->where(['id >' => 0]);
			$offices = $this->Users->Offices->find('list')->order(['name' => 'desc']);
			$schools = $this->Users->Schools->find('list')->order(['name' => 'desc'])->limit(100);
		    $warehouses = $this->Users->Warehouses->find('list')->order(['name' => 'asc']);
			$couriers = $this->Users->Couriers->find('list')->order(['name' => 'asc']);
			$regions = $this->getRegionList();
			$provinces = $this->getProvinceList($user->regCode);
			$cities = $this->getCityList($user->regCode, $user->provCode);
			$barangays = $this->getBarangayList($user->regCode, $user->provCode, $user->citymunCode);
		   
		    $diststagings = $this->Users->Diststagings->find('list')->where(['id >' => 1])->order(['id' => 'ASC']);
		   
		   
			$this->set('id', $id);
			$this->set(compact('user', 'couriers', 'warehouses', 'diststagings', 'roles', 'groups', 'offices', 'schools', 'barangays', 'cities', 'provinces', 'regions'));

    }
	
	public function editajax($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
			$_user = $this->request->getData();
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->modified = date('Y-m-d H:i:s');
			$user->modified_by = $this->Auth->user('refid');
			
			if(isset($_user['regCode_1']) && !empty($_user['regCode_1'])){
				$user->regCode = $_user['regCode_1'];
			}
			
			if(empty($_user['diststaging_id'])){
				$user->diststaging_id = 10;
			}
				
			
			$params = array(
					$_user['brgyCode'],
					$_user['citymunCode'],
					$_user['provCode'],
					$_user['regCode'],
				);
				
			$address = $_user['sitio'].' '.$this->generateAddress($params);
			$user->address = $address;
				
				
            if ($this->Users->save($user)) {
					$this->log($this->getTheAuthor()." MODIFIED ACCOUNT REFID : ". $user->refid." ID #: ".$user->id, "_info");
					
					$resp 	= 1;
					$msg = $this->Message->showMsg('update');
					
				}else{
					$err = '';
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
					
					$msg = $this->Message->showMsg('update_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		$this->set(compact('user'));

    }
	
	public function editnotifyajax($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
		
        if ($this->request->is('ajax')) {
			$this->ajaxLayout();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
					//send notification
					$resp 	= 1;
					$msg = $this->Message->showMsg('update_notify');
					
				}else{
					$err = '';
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
					
					$msg = $this->Message->showMsg('update_failed').' '. $err;
				}
				echo json_encode(array('resp' => $resp, 'msg' => $msg));
        }
		
		$this->set(compact('user'));

    }
	
}
