<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Common cell
 */
class CommonCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display(){
		
    }
	
	public function headertitle(){
	
		
	}
	
	public function newrequest($status=null){
		$this->LoadModel('Requests');
		$request = $this->Requests->find()->where(['status' => $status])->count();
		//$request->select(['count' => $query->func()->count('*')]);
		$this->set('request', $request);
	}
	
	public function displaystatus($status=null){
		$this->LoadModel('Disitrbutions');
		$total = $this->Disitrbutions
			->find()
			->where(['diststaging_id' => $status])
			->count();
			
			
		$this->set('total', $total);
		
	}
	
	public function authorname($id=null){
		$this->LoadModel('Users');
		$user = $this->Users
			->find()
			->select(['firstname', 'lastname'])
			->where(['id' => $id])
			->first();
			
			
		$this->set('id', $id);
		$this->set('user', $user);
		
	}
	
}
