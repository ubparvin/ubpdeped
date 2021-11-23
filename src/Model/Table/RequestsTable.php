<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @method \App\Model\Entity\Request newEmptyEntity()
 * @method \App\Model\Entity\Request newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->hasOne('Orders', [
            'foreignKey' => 'request_id',
        ]);
		
		$this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER',
        ]);
		
		$this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
		
    }

  
    public function validationDefault(Validator $validator): Validator
    {
		$validator->requirePresence([
			'refid' 			=> ['mode' => 'create', 'message' => 'Refid is required'],
			'requestor' 		=> ['mode' => 'create', 'message' => 'Requestor is required'],
			'school_id' 		=> ['mode' => 'create', 'message' => 'School is required'],
			'product_id' 		=> ['mode' => 'create', 'message' => 'Product is required'],
		]);
				
        $validator->integer('id')->allowEmptyString('id', null, 'create');
        $validator->scalar('refid')->notEmptyString('refid', 'Refid is required');
        $validator->scalar('requestorid')->notEmptyString('requestorid', 'Refid is required');
        $validator->scalar('school_id')->notEmptyString('school_id', 'School information is required');
        $validator->scalar('product_id')->notEmptyString('product_id', 'Product information is required');
        $validator->scalar('requestorrefid')->notEmptyString('requestorrefid', 'Refid is required');
        //$validator->scalar('delivery_address')->notEmptyString('delivery_address', 'Delivery address is required');
        //$validator->scalar('items')->notEmptyString('items', 'Specific items is required');
        $validator->scalar('status')->notEmptyString('status', 'Status is required');
        $validator->scalar('requestor')->notEmptyString('requestor', 'Requestor is required');
        $validator->dateTime('date')->notEmptyString('date', 'Date is required');
		
        return $validator;
    }
	
	/*
	public function buildRules(RulesChecker $rules): RulesChecker
    {
       
		$check = function($request) {
			if ($request->school !== 'free') {
				return true;
			}
		};
		
		$rules->add($check, [
			'errorField' => 'shipping_mode',
			'message' => 'No free shipping for orders under 100!'
		]);
		
		$validator->add('email', 'valid_email', [
			'rule' => 'email',
			'message' => 'Invalid email'
		]);
	
		$rules->add($rules->isUnique(
			['email', 'username'],
			//'This username & account_id combination has already been used.'
			'Email address already exists. Please check the details again.'
		  ));

        return $rules;
    }*/
	
}
