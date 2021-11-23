<?php
declare(strict_types=1);

namespace App\Controller;


class ProvincesController extends AppController
{
    private function ajaxLayout(){
		$this->viewBuilder()->setLayout('ajax');
		//$this->render(false);
		$this->autoRender = false;
		$this->view = false;
	}
		
    public function getList($reg=null){
		
		$reg = (strlen($reg)==2 ? $reg : '0'.$reg);
		
		$this->ajaxLayout();
		
		if($this->request->is('Ajax')){
			
				$this->ajaxLayout();
				$data = $this->Provinces->find()
					->select(['provCode', 'provDesc'])
					->where(['regCode' => $reg]);
					
				$data = $data->all();	
				$_data = array();
				
				if(!empty($data)){
					foreach($data as $c):
						$_data[] = array(
							'id' 	=> $c->provCode,
							'name' 	=> strtoupper($c->provDesc)
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
				$data = $this->Provinces->find()
					->select(['provDesc'])
					->where(['provCode' => $code])
					->first();
					//->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
				
				$resp = 0;
				$name = "";
				
				if(!empty($data)){
					$resp = 1;
					$name = strtoupper($data->provDesc);
				}
			
				
			echo json_encode(array("status" => $resp, "message" => $name));
		}
	}
	
}
