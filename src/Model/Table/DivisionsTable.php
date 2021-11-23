<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class DivisionsTable extends Table
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

        $this->setTable('divisions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('regCode')
            ->maxLength('regCode', 15)
            ->requirePresence('regCode', 'create')
            ->notEmptyString('regCode');

        $validator
            ->scalar('name')
            ->allowEmptyString('name');

        $validator
            ->scalar('sds')
            ->requirePresence('sds', 'create')
            ->allowEmptyString('sds');

        $validator
            ->scalar('asds')
            ->requirePresence('asds', 'create')
            ->allowEmptyString('asds');

        $validator
            ->scalar('hqco')
            ->requirePresence('hqco', 'create')
            ->allowEmptyString('hqco');

        $validator
            ->scalar('supply_officer')
            ->requirePresence('supply_officer', 'create')
            ->allowEmptyString('supply_officer');

       $validator
            ->scalar('contact_no')
            ->requirePresence('contact_no', 'create')
			->allowEmptyString('contact_no');
			
			/*
            ->notEmpty('contact_no', 'Invalid mobile number format')
			->add('contact_no', [
				'length' => [
					'rule' => ['minLength', 11],
					'message' => 'Invalid mobile number format',
				]
			])
			->add('contact_no', "custom", [
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
			]);*/

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->allowEmptyString('email');

        return $validator;
    }
	
	
	public function buildRules(RulesChecker $rules): RulesChecker
    {
		$rules->add($rules->isUnique(
		['name', 'regCode'],
			'Data already exists. Please check the details again.'
		 ));
		
        return $rules;
    }
	
}
