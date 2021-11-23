<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Warehouseinventories Model
 *
 * @property \App\Model\Table\WarehousesTable&\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\LogisticsTable&\Cake\ORM\Association\BelongsTo $Logistics
 *
 * @method \App\Model\Entity\Warehouseinventory newEmptyEntity()
 * @method \App\Model\Entity\Warehouseinventory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouseinventory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Warehouseinventory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Warehouseinventory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Warehouseinventory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouseinventory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Warehouseinventory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouseinventory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Warehouseinventory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouseinventory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouseinventory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Warehouseinventory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class WarehouseinventoriesTable extends Table
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

        $this->setTable('warehouseinventories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Logistics', [
            'foreignKey' => 'logistic_id',
            'joinType' => 'INNER',
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
            ->scalar('item_series')
            ->maxLength('item_series', 15)
            ->requirePresence('item_series', 'create')
            ->notEmptyString('item_series');

        $validator
            ->scalar('qty')
            ->maxLength('qty', 11)
            ->requirePresence('qty', 'create')
            ->notEmptyString('qty');

        $validator
            ->scalar('received_by')
            ->maxLength('received_by', 35)
            ->requirePresence('received_by', 'create')
            ->notEmptyString('received_by');

        $validator
            ->dateTime('received_date')
            ->requirePresence('received_date', 'create')
            ->notEmptyDateTime('received_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'), ['errorField' => 'warehouse_id']);
        $rules->add($rules->existsIn(['logistic_id'], 'Logistics'), ['errorField' => 'logistic_id']);

        return $rules;
    }
}
