<?php
declare(strict_types=1);

namespace App\Controller;


class BarangaysController extends AppController
{
	private function ajaxLayout(){
		$this->viewBuilder()->setLayout('ajax');
		//$this->render(false);
		$this->autoRender = false;
		$this->view = false;
	}
		
    public function getList($reg=null, $prov=null, $cty=null){
		
		$reg = (strlen($reg)==2 ? $reg : '0'.$reg);
		
		$this->ajaxLayout();
		
		if($this->request->is('Ajax')){
			
			$this->ajaxLayout();
				$data = $this->Barangays->find()
					->select(['brgyCode', 'brgyDesc'])
					->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
					
				$data = $data->all();	
				$_data = array();
				
				if(!empty($data)){
					foreach($data as $c):
						$_data[] = array(
							'id' 	=> $c->brgyCode,
							'name' 	=> strtoupper($c->brgyDesc)
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
				$data = $this->Barangays->find()
					->select(['brgyDesc'])
					->where(['brgyCode' => $code])
					->first();
					//->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
				
				$resp = 0;
				$name = "";
				
				if(!empty($data)){
					$resp = 1;
					$name = strtoupper($data->brgyDesc);
				}
			
				
			echo json_encode(array("status" => $resp, "message" => $name));
		}
	}
	
}
