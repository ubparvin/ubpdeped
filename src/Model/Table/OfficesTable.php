<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class OfficesTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('offices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Barangays', [
            'foreignKey' => 'brgyCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'citymunCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'provCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'regCode',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Receivables', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Receives', [
            'foreignKey' => 'office_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'office_id',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
		
		 $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name',  'create')
            ->notEmpty('name', 'Office name is required')
			->add('name', [
				'length' => [
					'rule' => ['minLength', 2],
					'message' => 'Invalid Office name',
				]
			]);
		
			
        $validator
            ->scalar('contact_person')
            ->maxLength('contact_person', 50)
            ->requirePresence('contact_person', 'create')
            ->notEmpty('contact_person', 'Contact person is required')
			->add('contact_person', [
				'length' => [
					'rule' => ['minLength', 2],
					'message' => 'Invalid Office name',
				]
			]);
			
		$validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 11)
            ->requirePresence('mobile_no', 'create')
			->add('mobile_no', [
				'length' => [
					'rule' => ['minLength', 11],
					'message' => 'Invalid mobile numner format',
				]
			])
			->add('mobile_no', "custom", [
				"rule" => function($value, $context){
					$prefix = substr($value, 0, 2);
					if($prefix!="09"){
						return "Invalid mobile number format";
					}
					
					if(strlen($value) <> 11){
						return "Invalid mobile numner format";
					}
					
					return true;
				}
			]);
			

        $validator
             ->scalar('tel_no')
            ->maxLength('tel_no', 20)
            ->requirePresence('tel_no', 'create')
            ->notEmpty('tel_no', 'Telephone No. is required')
			->add('tel_no', [
				'length' => [
					'rule' => ['minLength', 5],
					'message' => 'Invalid mobile numner format',
				]
			]);
		
			
        $validator->requirePresence([
			'regCode' => [
				'mode' => ['update', 'create'],
				'message' => 'Region is required'
			],
			'provCode' => [
				'mode' => ['update', 'create'],
				'message' => 'Province is required'
			],
			'citymunCode' => [
				'mode' => ['update', 'create'],
				'message' => 'City is required'
			],
			'brgyCode' => [
				'mode' => ['update', 'create'],
				'message' => 'Barangay is required'
			],
		]);
		
		
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');
			
        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmpty('address',  'Address is required')
			->add('address', [
				'length' => [
					'rule' => ['minLength', 2],
					'message' => 'Address is required',
				]
			]);

		$validator
            ->scalar('sitio')
            ->requirePresence('sitio', 'create')
            ->notEmpty('sitio',  'Address is required')
			->add('sitio', [
				'length' => [
					'rule' => ['minLength', 2],
					'message' => 'Address is required',
				]
			]);


        $validator
            ->dateTime('added')
            ->requirePresence('added', 'create')
			->notEmpty('added', 'Date of creation is required')
            ->notEmptyDateTime('added');

        return $validator;
    }

   
    public function buildRules(RulesChecker $rules): RulesChecker
    {
		$rules->add($rules->isUnique(
			//['name', 'account_id'],
			['name'],
			//'This username & account_id combination has already been used.'
			'The same information might already exists. Please check the details again.'
		));

       // $rules->add($rules->existsIn(['barangay_id'], 'Barangays'), ['errorField' => 'barangay_id']);
        //$rules->add($rules->existsIn(['city_id'], 'Cities'), ['errorField' => 'city_id']);
       // $rules->add($rules->existsIn(['province_id'], 'Provinces'), ['errorField' => 'province_id']);
       // $rules->add($rules->existsIn(['region_id'], 'Regions'), ['errorField' => 'region_id']);

        return $rules;
    }
}
