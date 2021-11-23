<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Common cell
 */
class DistributionCell extends Cell
{
	public function displaystatus($status=null, $title=null, $icon=null, $dash=null){
		$this->LoadModel('Logistics');
		
		switch($status){
			case 9:
				$total = $this->Logistics
				->find()
				//->where(['status >=' => $status])
				->where(['status' => 4, 'warehouse_id >=' => 1])
				->count();
			break;
			case 4:
				$total = $this->Logistics
				->find()
				//->where(['status >=' => $status])
				->where(['warehouse_id >' => 0])
				->count();
			break;
			default:
				$total = $this->Logistics
				->find()
				->where(['status' => $status])
				->count();
			break;
		}
		
			
		$this->set('total', $total);
		$this->set('status', $status);
		$this->set('title', $title);
		$this->set('icon', $icon);
		$this->set('dash', $dash);
		
	}
	
	public function displaytotal($title=null, $year=null){
		$this->LoadModel('Distributions');
		//$this->LoadModel('Distributionitems');
		$this->LoadModel('Programs');
		
		$programs = $this->Programs
		->find('all')
		->where(['status' => 'ACTIVE', 'id <' => 6])
		->contain([]);
		
		
		foreach($programs as $p):
		$dist	= $this->Distributions->Distributionitems->find();
		$count_qty = $dist
			->select([
				'sum' => $dist
					->func()
					->sum('Distributionitems.qty')
			])
			->where([
				'YEAR(added)' => $year,
				'program_id'  => $p->id
			])
			->first();
			
			$total = $count_qty->sum;
			$data[] = array(
				'program' 	=> $p->name,
				'total'		=> (($total > 0) ? $total : "0")
			);
			
		endforeach;
	
			
		$this->set('total', $total);
		$this->set('title', $title);
		$this->set('data', $data);
		$this->set('programs', $programs);
		
	}
	
	public function currentstatus($title=null, $year=null){
		//$this->LoadModel('Products');
		//$this->LoadModel('Distributionitems');
		$this->LoadModel('Programs');
		
		$programs = $this->Programs
		->find('all')
		->where(['status' => 'ACTIVE', 'id <' => 6])
		->contain([]);
		
		
		foreach($programs as $p):
		$dist	= $this->Programs->Products->find();
		$count_qty = $dist
			->select([
				'qty' => $dist
					->func()
					->sum('Products.qty'),
				'on_hand' => $dist
					->func()
					->sum('Products.on_hand')
			])
			->where([
				//'YEAR(added)' => $year,
				'program_id'  => $p->id
			])
			->first();
			
			$qty = $count_qty->qty;
			$on_hand = $count_qty->on_hand;
			
			$data[] = array(
				'program' 		=> $p->name,
				'qty'			=> (($qty > 0) ? $qty : "0"),
				'on_hand'		=> (($on_hand > 0) ? $on_hand : "0")
			);
			
		endforeach;
	
			
		$this->set('total', $total);
		$this->set('title', $title);
		$this->set('data', $data);
		$this->set('programs', $programs);
		
	}
	
}
