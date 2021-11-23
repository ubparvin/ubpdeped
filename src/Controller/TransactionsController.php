<?php
declare(strict_types=1);

namespace App\Controller;


class TransactionsController extends AppController
{
   
   public function initialize(): void{
        parent::initialize();
		$this->set('title', 'Transactions Management');
	}
	 
	private function ajaxLayout(){
			$this->viewBuilder()->setLayout('ajax');
			$this->autoRender = false;
			$this->view = false;
	}
	
   public function receiveitem($pid=null, $prefid=null){
	
	 $product = $this->Transactions->Products->get($pid, [
		'contain' => ['Productimages', 'Categories', 'Subcategories', 'Taggings', 'Programs'],
		'refid' => $prefid
	 ]);
	 
	 $series = $this->Transactions->Products->Programs->Programseries
		->find('list')
		->where(['program_id' => $product->program_id])
		->contain([]);
		
	 if(!empty($product)){
		$this->set(compact('product', 'series'));
	 }
	 
	 $this->set('img_dir', $this->Common->imageDIR("web"));
		 
   }
	
   private function getTheAuthor(){
		$name = $this->Auth->user('firstname').' '.$this->Auth->user('lastname');
		$id   = $this->Auth->user('id');
		return $name." (#".$id.") ";
	}
	
   public function editajax($pid = null, $prefid=null){
        if ($this->request->is('ajax')) {
			
			$product = $this->Transactions->Products->get($pid, [
				'contain' => ['Categories', 'Subcategories', 'Taggings', 'Programs'],
				'refid' => $prefid
			]);
			
			$resp		= 0;
			
			if(!empty($product)){
				
				$this->ajaxLayout();
				$_product 	= $this->request->getData();
				$qty 		= $product->qty;
				$on_hand	= $product->on_hand;
				$product 	= $this->Transactions->Products->patchEntity($product, $this->request->getData());
				
				$new_qty				= $qty + $_product['qty'];
				$product->qty 			= $new_qty;
				$product->on_hand 		= $on_hand + $_product['qty'];
				
				$product->modified 		= date('Y-m-d H:i:s');
				$product->modified_by 	= $this->Auth->user('refid');
				
				$series = $_product['series'];
				$start 	= ltrim($_product['series_start'], "0");
				$end 	= ltrim($_product['series_end'], "0");
				$total 	= count(range($start, $end));
				
				
				

					if(!empty($series) && !empty($start) && !empty($end) && ($end > $start) && ($total > 0)){
						if($total==$_product['qty']){
							//check if series already exists;
							/*$series_exists = $this->Transactions->Products->Productseries
								->find()
								->select(['id'])
								->where([
									'product_id' 	=> $product->id,
									'series'	 	=> $series,
									'start >=' 		=> $start,
									'end <=' 		=> $end
									
								])
								->first();
					
					
							if(!empty($series_exists)){
								$msg = "Product series already exists ";
							}else{*/
								if ($this->Transactions->Products->save($product)) {
									//save in the transaction history
									
									$transactions = $this->Transactions->newEmptyEntity();
									
									$data_to_save = array(
										'type' 			=> 'INVENTORY',
										'product_id' 	=> $pid,
										'current_qty'	=> $qty,
										'added_qty'		=> $_product['qty'],
										'new_qty'		=> $new_qty,
										'series'		=> $series,
										'series_start'	=> $start,
										'series_end'	=> $end,
										'created'		=> date('Y-m-d H:i:s'),
										'trans_by'		=> $this->Auth->user('id')
									);
									
									$transactions = $this->Transactions->newEntity($data_to_save, ['validate' => false]);
									$this->Transactions->save($transactions);
									
									
									$productseries = $this->Transactions->Products->Productseries->newEmptyEntity();
									
									$series_data = array(
										'product_id' 	=> $product->id,
										'series'		=> $series,
										'start'			=> $start,
										'end'			=> $end,
										'qty'			=> $total,
										'receive'		=> date('Y-m-d H:i:s'),
										'received_by'	=> $this->Auth->user('id')
									);
									
									
									$productseries = $this->Transactions->Products->Productseries->newEntity($series_data, ['validate' => false]);
									$this->Transactions->Products->Productseries->save($productseries);
									
									
									$this->log($this->getTheAuthor()."SUCCESSFULLY RECEIVED ITEM (#".$pid.") WITH ADDITIONAL QUANITY: ".$_product['qty'], "_info");
									
									$resp 	= 1;
									$msg = "Additional Item quanity has been received"; 
									
								}else{
										$err = '';
										if($product->getErrors()){
											$error_msg = [];
											foreach( $product->getErrors() as $errors){
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
							//}
						}else{
							$msg = "Series and quantity to received does not match";
						}
						
					}else{
						$msg = "Invalid series data. Please check the details";
					}
			
							
			}else{
				$msg = $this->Message->showMsg('update_failed')." Record not found";
			}
			
			echo json_encode(array('resp' => $resp, 'msg' => $msg));	
			$this->set(compact('product'));
        }
		
		

    }
	
}
