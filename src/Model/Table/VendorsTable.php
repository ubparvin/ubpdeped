<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class VendorsTable extends Table
{
    
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('vendors');
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
		
        $this->hasMany('Orders', [
            'foreignKey' => 'vendor_id',
        ]);
		
		$this->hasMany('Products', [
            'foreignKey' => 'vendor_id',
        ]);
		
		$this->hasMany('Couriercontracts', [
            'foreignKey' => 'vendor_id',
        ]);
    }

    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator->requirePresence([
			'name' 				=> ['mode' => 'create', 'message' => 'Vendor/Supplier name is required'],
			'operatedby' 		=> ['mode' => 'create', 'message' => 'Manage & Operated by is required'],
			'refid' 			=> ['mode' => 'create', 'message' => 'Reference id is required'],
			'mobile_no' 		=> ['mode' => 'create', 'message' => 'Mobile number is required'],
			'contact_person' 	=> ['mode' => 'create', 'message' => 'Contact person is required'],
			'regCode' 			=> ['mode' => 'create', 'message' => 'Region is required'],
			'provCode' 			=> ['mode' => 'create', 'message' => 'Province is required'],
			'citymunCode' 		=> ['mode' => 'create', 'message' => 'City is required'],
			'brgyCode' 			=> ['mode' => 'create', 'message' => 'Barangay is required'],
			'sitio' 			=> ['mode' => 'create', 'message' => 'Sitio is required'],
			'address' 			=> ['mode' => 'create', 'message' => 'Address is required'],
			'added' 			=> ['mode' => 'create', 'message' => 'Registration date is required'],
			'added_by' 			=> ['mode' => 'create', 'message' => 'Author is required'],
			'status' 			=> ['mode' => 'create', 'message' => 'Status is required'],
			'license_no' 		=> ['mode' => 'create', 'message' => 'License is required'],
			'license_expires' 	=> ['mode' => 'create', 'message' => 'License is required'],
		]);
		
        $validator->scalar('name')->maxLength('name', 50)->notEmptyString(
		'name', 'Vendor/Supplier name is required'
		);
		
        $validator->scalar('operatedby')->maxLength('operatedby', 64)->notEmptyString(
		'operatedby', 'Manage & Operated by is required'
		);

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 11)
            ->requirePresence('mobile_no', 'create')
            ->notEmpty('mobile_no', 'Invalid mobile number format')
			->add('mobile_no', [
				'length' => [
					'rule' => ['minLength', 11],
					'message' => 'Invalid mobile number format',
				]
			])
			->add('mobile_no', "custom", [
				"rule" => function($value, $context){
					$prefix = substr($value, 0, 2);
					if($prefix!="09"){
						return "Invalid mobile number format";
					}
					
					if(strlen($value) <> 11){
						return "Invalid mobile number format";
					}
					
					return true;
				}
			]);
			

        $validator
            ->scalar('tel_no')
            ->maxLength('tel_no', 18)
            ->allowEmptyString('tel_no');
		
		$validator->scalar('contact_person')->maxLength('contact_person', 50)->notEmptyString(
		'contact_person', 'Contact person is required'
		);
		
		$validator->scalar('license_no')->maxLength('license_no', 35)->notEmptyString(
		'license_no', 'License is required'
		);
		
		$validator->scalar('address')->notEmptyString(
		'address', 'Address is required'
		);
		
		$validator->scalar('sitio')->notEmptyString(
		'sitio', 'Address is required'
		);
		

        return $validator;
    }


    public function buildRules(RulesChecker $rules): RulesChecker
    {
       $rules->add($rules->isUnique(
			//['name', 'account_id'],
			['email', 'name', 'license_no'],
			//'This username & account_id combination has already been used.'
			'The same information might already exists. Please check the details again.'
		  ));

        return $rules;
    }
}
