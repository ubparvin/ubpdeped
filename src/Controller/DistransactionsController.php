<?php
declare(strict_types=1);

namespace App\Controller;

class DistransactionsController extends AppController
{
	private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
	public function testTrans(){
		$this->ajaxLayout();
		$trans = $this->Distransactions->newEmptyEntity();
		$trans_data = array(
			'distribution_id' 	=> 1,
			'date_received'		=> date('Y-m-d H:i:s'),
			'date_released'		=> date('Y-m-d H:i:s'),
			'diststaging_id'	=> 1,
			'userid'			=> 1
		);

		$trans = $this->Distransactions->newEntity($trans_data, ['validate' => false]);
		$this->Distransactions->save($trans);
												
	}
	
}
