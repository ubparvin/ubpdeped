<?php
declare(strict_types=1);

namespace App\Controller;

class RegionsController extends AppController
{
    private function ajaxLayout(){
		$this->viewBuilder()->setLayout('ajax');
		//$this->render(false);
		$this->autoRender = false;
		$this->view = false;
	}
		
    public function getList(){
		
		$this->ajaxLayout();
		
		if($this->request->is('Ajax')){
			
			$this->ajaxLayout();
				$data = $this->Regions->find()
					->select(['regCode', 'regDesc']);
					//->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
					
				$data = $data->all();	
				$_data = array();
				
				if(!empty($data)){
					foreach($data as $c):
						$_data[] = array(
							'id' 	=> $c->regCode,
							'name' 	=> strtoupper($c->regDesc)
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
				$data = $this->Regions->find()
					->select(['regDesc'])
					->where(['regCode' => $code])
					->first();
					//->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
				
				$resp = 0;
				$name = "";
				
				if(!empty($data)){
					$resp = 1;
					$name = strtoupper($data->regDesc);
				}
			
				
			echo json_encode(array("status" => $resp, "message" => $name));
		}
	}
}
