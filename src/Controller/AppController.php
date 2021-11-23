<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

      
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Message');
        $this->loadComponent('Upload');
		
		//$this->viewBuilder()->setLayout("app");
		 
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        $this->loadComponent('FormProtection');
        $this->loadComponent('Common');
		
		$this->loadComponent('Auth', [
			'authenticate' => [
						'Form' => [
							'fields' => [
								'username' => 'username',
								'password' => 'password'
							]
						]
			],
			'loginAction'	=>	[
				'controller' 	=> 'Users',
				'action'		=> 'login'
			],
			'redirectUrl' 	=> [
				'controller' 	=> 'logistics',
				'action'		=> 'index'
			],
			// If unauthorized, return them to page they were just on
			'unauthorizedRedirect'	=> $this->referer()
		]);
    }
	
	public function beforeRender(\Cake\Event\EventInterface $event){
		parent::beforeRender($event);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->FormProtection->setConfig('unlockedActions', ['bulkreceive', 'showitems', 'importschools', 'importdivision', 'logout','indexajax', 'requestsupplyajax', 'saveajax', 'editajax', 'editnotifyajax', 'importproducts', 'postimage']); //disable for the actual AJAX
		//$this->FormProtection->setConfig('validate', false);
	}
	

	/*-------------------------
	| Places
	------------------------*/

	public function getRegionList(){
				$this->loadModel('Regions');
				$this->Regions->recursive=-1;
				
				$data = $this->Regions->find()
					->select(['regCode', 'regDesc']);
					
					
				$data = $data->all();	
				$_data = array();

				$lists = array();
				if(!empty($data)){
					foreach($data as $c):
						$lists[$c->regCode] =  strtoupper($c->regDesc);
					endforeach;
				}
				return $lists;
	}
	
	public function getProvinceList($reg=null){
				$this->loadModel('Provinces');
				$this->Provinces->recursive=-1;
				
				$data = $this->Provinces->find()
					->select(['provCode', 'provDesc'])
					->where(['regCode' => $reg]);
					
					
				$data = $data->all();	
				$_data = array();

				$lists = array();
				if(!empty($data)){
					foreach($data as $c):
						$lists[$c->provCode] =  strtoupper($c->provDesc);
					endforeach;
				}
				return $lists;
	}
	
	public function getCityList($reg=null, $prov=null){
				$this->loadModel('Cities');
				$this->Cities->recursive=-1;
				
				$data = $this->Cities->find()
					->select(['citymunCode', 'citymunDesc'])
					->where(['regDesc' => $reg, 'provCode' => $prov]);
					
					
				$data = $data->all();	
				$_data = array();

				$lists = array();
				if(!empty($data)){
					foreach($data as $c):
						$lists[$c->citymunCode] =  strtoupper($c->citymunDesc);
					endforeach;
				}
				return $lists;
	}
	
	public function getBarangayList($reg=null, $prov=null, $cty=null){
				$this->loadModel('Barangays');
				$this->Barangays->recursive=-1;
				
				$data = $this->Barangays->find()
					->select(['brgyCode', 'brgyDesc'])
					->where(['regCode' => $reg, 'provCode' => $prov, 'citymunCode' => $cty]);
					
					
				$data = $data->all();	
				$_data = array();

				$lists = array();
				if(!empty($data)){
					foreach($data as $c):
						$lists[$c->brgyCode] = strtoupper($c->brgyDesc);
					endforeach;
				}
				return $lists;
	}
   
   /*-----------------------
   | Place name
   -----------------------*/
   public function getAddressName($model=null, $code=null){
		
	
		$name = "UNKNOWN";
		
		switch($model){
			case "barangay":
				$this->loadModel('Barangays');
				$data = $this->Barangays->find()
					->select(['brgyDesc'])
					->where(['brgyCode' => $code])
					->first();
					
				if(!empty($data)){
					$name = strtoupper($data->brgyDesc);
				}
			break;
			case "city":
				$this->loadModel('Cities');
				$data = $this->Cities->find()
					->select(['citymunDesc'])
					->where(['citymunCode' => $code])
					->first();
					
				if(!empty($data)){
					$name = strtoupper($data->citymunDesc);
				}
			break;
			case "province":
				$this->loadModel('Provinces');
				$data = $this->Provinces->find()
					->select(['provDesc'])
					->where(['provCode' => $code])
					->first();
				
				if(!empty($data)){
					$name = strtoupper($data->provDesc);
				}
				
			break;
			case "region":
				$this->loadModel('Regions');
				$data = $this->Regions->find()
					->select(['regDesc'])
					->where(['regCode' => $code])
					->first();
				
				if(!empty($data)){
					$name = strtoupper($data->regDesc);
				}
				
			break;
		}
			
		
			
		return $name;
	}
	
	public function generateAddress($params){
		$barangay 	= $this->getAddressName("barangay", $params[0]);
		$city 		= $this->getAddressName("city", $params[1]);
		$province 	= $this->getAddressName("province", $params[2]);
		//$region 	= $this->getAddressName("region", $params[3]);
		return $barangay." ".$city." ".$province;
	}
	
	public function getPlaceCode($model=null, $name=null){
		
	
		$code = "";
		
		switch($model){
			case "barangay":
				$this->loadModel('Barangays');
				$data = $this->Barangays->find()
					->select(['brgyCode'])
					->where(['brgyDesc' => $name])
					->first();
					
				if(!empty($data)){
					$code = $data->brgyCode;
				}
			break;
			case "city":
				$this->loadModel('Cities');
				$data = $this->Cities->find()
					->select(['citymunCode'])
					->where(['citymunDesc' => $name])
					->first();
					
				if(!empty($data)){
					$code = $data->citymunCode;
				}
			break;
			case "province":
				$this->loadModel('Provinces');
				$data = $this->Provinces->find()
					->select(['provCode'])
					->where(['provDesc' => $name])
					->first();
				
				if(!empty($data)){
					$code = $data->provCode;
				}
				
			break;
			case "region":
				$this->loadModel('Regions');
				$data = $this->Regions->find()
					->select(['regCode'])
					->where(['regDesc' => $name])
					->first();
				
				if(!empty($data)){
					$code = $data->regCode;
				}
				
			break;
			case "division":
				$this->loadModel('Divisions');
				$data = $this->Divisions->find()
					->select(['id'])
					->where(['name' => $name])
					->first();
				
				if(!empty($data)){
					$code = $data->id;
				}
				
			break;
		}
			
		
			
		return $code;
	}
	
	
   /*------------------------
   | End of place
   ------------------------*/
	
}
