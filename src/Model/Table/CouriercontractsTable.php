<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Couriercontracts Model
 *
 * @property \App\Model\Table\CouriersTable&\Cake\ORM\Association\BelongsTo $Couriers
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\VendorsTable&\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\CouriertxtitemsTable&\Cake\ORM\Association\HasMany $Couriertxtitems
 *
 * @method \App\Model\Entity\Couriercontract newEmptyEntity()
 * @method \App\Model\Entity\Couriercontract newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Couriercontract[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Couriercontract get($primaryKey, $options = [])
 * @method \App\Model\Entity\Couriercontract findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Couriercontract patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Couriercontract[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Couriercontract|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Couriercontract saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Couriercontract[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriercontract[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriercontract[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriercontract[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CouriercontractsTable extends Table
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

        $this->setTable('couriercontracts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Couriers', [
            'foreignKey' => 'courier_id',
        ]);
        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
        ]);
        $this->hasMany('Couriertxtitems', [
            'foreignKey' => 'couriercontract_id',
        ]);

		$this->hasMany('Courierdcpitems', [
            'foreignKey' => 'couriercontract_id',
        ]);

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
            ->scalar('level')
            ->maxLength('level', 35)
            ->allowEmptyString('level');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('contract_year')
            ->allowEmptyString('contract_year');

        return $validator;
    }

    
    public function buildRules(RulesChecker $rules): RulesChecker
    {
       
		$rules->add($rules->isUnique(
			['program_id', 'name'],
			'Data already exists. Please check the details again.'
		  ));
		
		

        return $rules;
    }
}
