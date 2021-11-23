<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class MessageComponent extends Component
{
    
	public function showMsg($msg=null){
		$messages = array(
			'save' 				=> 'New data has been saved',
			'save_failed' 		=> 'Saving new data failed.',
			'update' 			=> 'Data changes has been saved',
			'update_notify' 	=> 'Data changes has been saved & notification has been sent',
			'update_failed' 	=> 'Saving changes failed.',
			'remove'			=> 'Data has been removed'
		);
		
		return $messages[$msg];
	}
	
	public function requestStatus(){
		$details = array(
			'PENDING',
			'APPROVED',
			'CANCELLED',
			'REJECTED',
			'SORTING',
			'PACKAGING',
			'SHIPPING',
			'DELIVERY',
			'RECEIVED'
		);
		
		$arr = array();
		
		foreach($details as $d):
			$arr[$d] = $d;
		endforeach;
		
		return $arr;
	}
	
	public function requestStatusText($stat=null){
		$details = array(
			'PENDING' 		=> 'Your request is now subject for approval',
			'APPROVED'		=> 'Your request has been approved',
			'CANCELLED'		=> 'Your request has been cancelled',
			'REJECTED'		=> 'Your request has been rejected',
			'SORTING'		=> 'Your item arrived in the sorting hub',
			'PACKAGING'		=> 'Your item will be packed',
			'SHIPPING'		=> 'Your item is on shipment',
			'DELIVERY'		=> 'Your item is out for delivery',
			'RECEIVED'		=> 'Your item has been received'
		);
		
		if(isset($details[$stat])){
			return $details[$stat];
		}else{
			return "NO STATUS";
		}
	}
	
	public function paymentTypes(){
		$details = array(
			'BANK DEPOSIT',
			'CASH',
			'CHECKS',
			'DEBIT CARD',
			'CREDIT CARD',
			'ELECTRONIC BANK TRANSFER',
			'MOBILE PAYMENT'
		);
		
		$arr = array();
		
		foreach($details as $d):
			$arr[$d] = $d;
		endforeach;
		
		return $arr;
	}
	
	public function paymentTerms(){
		$details = array(
			'COD',
			'CIA',
			'CWO',
			'EOM',
			'Net 7',
			'Net 10',
			'Net 60',
			'Net 90',
			'PIA',
			'STAGE PAYMENT'
		);
		
		$arr = array();
		
		foreach($details as $d):
			$arr[$d] = $d;
		endforeach;
		
		return $arr;
	}
	
	public function paymentStatus(){
		$details = array(
			'ONGOING',
			'PAID'
		);
		
		$arr = array();
		
		foreach($details as $d):
			$arr[$d] = $d;
		endforeach;
		
		return $arr;
	}
	
	public function logisticStatus($stat=null){
		$details = array(
			'1' => '<span class="text-success">CHECKED & RECEIVED BY INSPECTION TEAM</span>',
			'2' => '<span class="text-success">IN-TRANSIT</span>',
			'3' => '<span class="text-danger">RECEIVED BY SCHOOL</span>',
			'4' => '<span class="text-warning">RECEIVED BY WAREHOUSE</span>'
		);
		
		if(isset($stat) && !empty($stat)){
			return $details[$stat];
		}else{
			return $details;
		}
	}
	
	public function inventoryStatus($stat=null){
		$details = array(
			'1' => 'STOCK',
			'2' => 'PULLED-OUT',
		);
		
		if(isset($stat) && !empty($stat)){
			return $details[$stat];
		}else{
			return $details;
		}
	}
	
	
}