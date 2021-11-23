<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\GroupsTable&\Cake\ORM\Association\BelongsTo $Groups
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsTo $Schools
 * @property \App\Model\Table\OfficesTable&\Cake\ORM\Association\BelongsTo $Offices
 * @property \App\Model\Table\BarangaysTable&\Cake\ORM\Association\BelongsTo $Barangays
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\ProvincesTable&\Cake\ORM\Association\BelongsTo $Provinces
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 * @property \App\Model\Table\ReceivablesTable&\Cake\ORM\Association\HasMany $Receivables
 * @property \App\Model\Table\ReceivesTable&\Cake\ORM\Association\HasMany $Receives
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER',
        ]);

		$this->belongsTo('Diststagings', [
            'foreignKey' => 'diststaging_id',
            'joinType' => 'INNER',
        ]);
		
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
        ]);

		$this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
        ]);
		
        $this->belongsTo('Offices', [
            'foreignKey' => 'office_id',
        ]);
		
		$this->belongsTo('Couriers', [
            'foreignKey' => 'courier_id',
        ]);
        $this->belongsTo('Barangays', [
            'foreignKey' => 'brgyCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'citymunCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'regCode',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'provCode',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Payments', [
            'foreignKey' => 'user_id',
        ]);

        $this->hasMany('Receivables', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Receives', [
            'foreignKey' => 'user_id',
        ]);
    }


    public function validationDefault(Validator $validator): Validator
    {
		
        $validator->requirePresence([
			'group_id' => [
				'mode' => 'create',
				'message' => 'Access group is required'
			],
			'refid' => [
				'mode' => 'create',
				'message' => 'Reference id is required'
			],
			'role_id' => [
				'mode' => 'create',
				'message' => 'Role is required'
			],
			/*'office_id' => [
				'mode' => 'create',
				'message' => 'Office is required'
			],
			'school_id' => [
				'mode' => 'create',
				'message' => 'School is required'
			]*/
		]);
		
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');
		
       $validator
            ->scalar('firstname')
            ->maxLength('firstname', 35)
           // ->requirePresence('firstname', 'create')
            ->allowEmptyString('firstname', 'Given Name is required');

        $validator
            ->scalar('middlename')
            ->maxLength('middlename', 35)
            ->allowEmptyString('middlename', 'Middle Name is required');

        $validator
            ->scalar('lastname')
            ->maxLength('lastname', 35)
           // ->requirePresence('lastname', 'create')
            ->allowEmptyString('lastname', 'Last Name is required');
	
		 $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 11)
           // ->requirePresence('mobile_no', 'create')
            ->allowEmptyString('mobile_no', 'Invalid mobile number format')
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
            ->date('birthdate')
            //->requirePresence('birthdate', 'create')
            ->allowEmptyString('birthdate', 'Date of birth is required');
		
        $validator
            ->email('email')
           // ->requirePresence('email', 'create')
            ->allowEmptyString('email', 'Email is required');
		
		$validator
            ->scalar('regCode')
           // ->requirePresence('regCode', 'create')
            ->allowEmptyString('regCode', 'Region is required');
		
		$validator
            ->scalar('provCode')
            //->requirePresence('provCode', 'create')
            ->allowEmptyString('provCode', 'Province is required');
	
		$validator
            ->scalar('citymunCode')
            //->requirePresence('citymunCode', 'create')
            ->allowEmptyString('citymunCode', 'City is required');
		
		$validator
            ->scalar('brgyCode')
           // ->requirePresence('brgyCode', 'create')
            ->allowEmptyString('brgyCode', 'Barangay is required');
		
		
		$validator
            ->scalar('username')
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Username is required');
		
		$validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Username is required');
	
       
        $validator
            ->scalar('address')
           // ->requirePresence('address', 'create')
            ->allowEmptyString('address', 'Address is required'); 
		
		$validator
            ->scalar('sitio')
           // ->requirePresence('sitio', 'create')
            ->allowEmptyString('sitio', 'Address is required');
		
	
        $validator
            ->dateTime('added')
           // ->requirePresence('added', 'create')
            ->allowEmptyString('added', 'Date is required');

        $validator
            ->dateTime('last_access')
            ->allowEmptyDateTime('last_access')
			->allowEmptyString('last_access', 'Province is required');
		
		
        $validator
            ->scalar('status')
            ->maxLength('status', 8)
            ->allowEmptyString('status', 'Province is required');
		
		$validator
            ->integer('school_id')
            ->allowEmptyString('school_id');
		
		$validator
            ->integer('warehouse_id')
            ->allowEmptyString('warehouse_id');
		
		$validator
            ->integer('office_id')
            ->allowEmptyString('office_id');
		
		$validator
            ->scalar('emergency_name')
            ->maxLength('emergency_name', 50)
            //->requirePresence('emergency_name', 'create')
            ->allowEmptyString('emergency_name', 'Contact person is required');
		
		$validator
            ->scalar('emergency_contact')
            ->maxLength('emergency_contact', 11)
            //->requirePresence('emergency_contact', 'create')
            ->allowEmptyString('emergency_contact', 'Contact person is required')
			->add('emergency_contact', [
				'length' => [
					'rule' => ['minLength', 11],
					'message' => 'Invalid contact person mobile number format',
				]
			])
			->add('emergency_contact', "custom", [
				"rule" => function($value, $context){
					$prefix = substr($value, 0, 2);
					if($prefix!="09"){
						return "Invalid contact person mobile number format";
					}
					
					if(strlen($value) <> 11){
						return "Invalid contact person mobile number format";
					}
					
					return true;
				}
			]);


        return $validator;
		
		
    }

   /*
    public function buildRules(RulesChecker $rules): RulesChecker
    {
       
		$rules->add($rules->isUnique(
			['username'],
			'Username already exists. Please check the details again.'
		  ));
		
		$rules->add($rules->isUnique(
			['email'],
			'Email address already exists. Please check the details again.'
		  ));

        return $rules;
    }*/
}
