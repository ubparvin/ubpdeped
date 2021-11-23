<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * Common cell
 */
class TxtitemsCell extends Cell
{
	public function displaystatus($contract_id=null){
		$this->LoadModel('Couriertxtitems');
		$total = 0;
		
		//$items = TableRegistry::get('Couriertxtitems');
		switch($contract_id){
			case 1:
				$total = $this->Couriertxtitems->find('all')
				->select(['total_tx' => 'SUM(tx)'])
				->where(['couriercontract_id' => 1]);
			break;
			case 2:
				$total = $this->Couriertxtitems->find('all')
				->select(['total_tx' => 'SUM(tx)', 'total_tm' => 'SUM(tm)'])
				->where(['couriercontract_id' => 2]);
			break;
			case 3:
				$total = $this->Couriertxtitems->find('all')
				->select([
				'total_esp_tx' 	=> 'SUM(esp_tx)', 
				'total_esp_tm' 	=> 'SUM(esp_tm)',
				'total_ap_tx' 	=> 'SUM(ap_tx)',
				'total_ap_tm' 	=> 'SUM(ap_tm)'
				])
				->where(['couriercontract_id' => 3]);
			break;
			case 4:
				$total = $this->Couriertxtitems->find('all')
				->select([
				'total_kg_total' 	=> 'SUM(kg_total)'
				])
				->where(['couriercontract_id' => 4]);
			break;
			case 5:
				$total = $this->Couriertxtitems->find('all')
				->select([
				'total_ma_tx' 	=> 'SUM(ma_tx)', 
				'total_ma_tm' 	=> 'SUM(ma_tm)', 
				])
				->where(['couriercontract_id' => 5]);
			break;
			case 6:
				$total = $this->Couriertxtitems->find('all')
				->select([
				'total_kg_total' 	=> 'SUM(kg_total)'
				])
				->where(['couriercontract_id' => 6]);
			break;
			default:
			break;
		}
		
		$this->set('total', $total);
		$this->set('contract_id', $contract_id);
		
	}
	
	
}
