<?php
declare(strict_types=1);

namespace App\Controller;


class CitiesController extends AppController
{
   
   private function ajaxLayout(){
		$this->viewBuilder()->setLayout('ajax');
		//$this->render(false);
		$this->autoRender = false;
		$this->view = false;
	}
		
    public function getList($reg=null, $prov=null){
		
		$reg = (strlen($reg)==2 ? $reg : '0'.$reg);
		
		$this->ajaxLayout();
		
		if($this->request->is('Ajax')){
			
			$this->ajaxLayout();
				$data = $this->Cities->find()
					->select(['citymunCode', 'citymunDesc'])
					->where(['regDesc' => $reg, 'provCode' => $prov]);
					
				$data = $data->all();	
				$_data = array();
				
				if(!empty($data)){
					foreach($data as $c):
						$_data[] = array(
							'id' 	=> $c->citymunCode,
							'name' 	=> strtoupper($c->citymunDesc)
						);
						
					endforeach;
				}
				
			echo json_encode(array("status" => 200, "message" => "Oks", "data" => $_data));
		}
	}
	
	public function getAddressName($code=null){
		
		$this->ajaxLayout();
		
		if($this->request->is('Ajax')){
			
				$this->ajaxLayout();
				$data = $this->Cities->find()
					->select(['citymunDesc'])
					->where(['citymunCode' => $code])
					->first();
					//->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
				
				$resp = 0;
				$name = "";
				
				if(!empty($data)){
					$resp = 1;
					$name = strtoupper($data->citymunDesc);
				}
			
				
			echo json_encode(array("status" => $resp, "message" => $name));
		}
	}
	
}
