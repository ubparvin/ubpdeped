<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Warehouses Model
 *
 * @property \App\Model\Table\LogisticsTable&\Cake\ORM\Association\HasMany $Logistics
 * @property \App\Model\Table\WarehouseinventoriesTable&\Cake\ORM\Association\HasMany $Warehouseinventories
 *
 * @method \App\Model\Entity\Warehouse newEmptyEntity()
 * @method \App\Model\Entity\Warehouse newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\Warehouse findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Warehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouse|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouse[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WarehousesTable extends Table
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

        $this->setTable('warehouses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Logistics', [
            'foreignKey' => 'warehouse_id',
        ]);
		
        $this->hasMany('Warehouseinventories', [
            'foreignKey' => 'warehouse_id',
        ]);

		$this->hasMany('Users', [
            'foreignKey' => 'warehouse_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('regCode')
            ->maxLength('regCode', 11)
            ->requirePresence('regCode', 'create')
            ->notEmptyString('regCode');

        $validator
            ->scalar('provCode')
            ->maxLength('provCode', 11)
            ->requirePresence('provCode', 'create')
            ->notEmptyString('provCode');


        return $validator;
    }
	
	 public function buildRules(RulesChecker $rules): RulesChecker
    {
       	$rules->add($rules->isUnique(
			['name'],
			'Warehouse already exists. Please check the details again.'
		  ));

        return $rules;
    }
	
}
