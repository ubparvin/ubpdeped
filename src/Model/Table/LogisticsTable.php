<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logistics Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\VendorsTable&\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsTo $Schools
 * @property \App\Model\Table\WarehousesTable&\Cake\ORM\Association\BelongsTo $Warehouses
 * @property \App\Model\Table\LogistictransTable&\Cake\ORM\Association\HasMany $Logistictrans
 * @property \App\Model\Table\SchoolinventoriesTable&\Cake\ORM\Association\HasMany $Schoolinventories
 * @property \App\Model\Table\WarehouseinventoriesTable&\Cake\ORM\Association\HasMany $Warehouseinventories
 *
 * @method \App\Model\Entity\Logistic newEmptyEntity()
 * @method \App\Model\Entity\Logistic newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Logistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Logistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\Logistic findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Logistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Logistic|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistic[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistic[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistic[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistic[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LogisticsTable extends Table
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

        $this->setTable('logistics');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
        ]);
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
        ]);
        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
        ]);
        $this->hasMany('Logistictrans', [
            'foreignKey' => 'logistic_id',
        ]);
        $this->hasMany('Schoolinventories', [
            'foreignKey' => 'logistic_id',
        ]);
        $this->hasMany('Warehouseinventories', [
            'foreignKey' => 'logistic_id',
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
            ->scalar('qrcode')
            ->maxLength('qrcode', 35)
            ->requirePresence('qrcode', 'create')
            ->notEmptyString('qrcode');

        $validator
            ->scalar('serial_no')
            ->maxLength('serial_no', 15)
            ->allowEmptyString('serial_no');

        $validator
            ->scalar('qty')
            ->maxLength('qty', 11)
            ->allowEmptyString('qty');

        $validator
            ->scalar('budget_year')
            ->allowEmptyString('budget_year');

        $validator
            ->dateTime('inspection_date')
            ->allowEmptyDateTime('inspection_date');

        $validator
            ->scalar('brand_model')
            ->maxLength('brand_model', 15)
            ->allowEmptyString('brand_model');

        $validator
            ->decimal('acq_cost')
            ->allowEmptyString('acq_cost');

        $validator
            ->dateTime('acq_date')
            ->allowEmptyDateTime('acq_date');

        $validator
            ->scalar('pa_inspector')
            ->maxLength('pa_inspector', 35)
            ->allowEmptyString('pa_inspector');

        $validator
            ->dateTime('inspect_date')
            ->allowEmptyDateTime('inspect_date');

        $validator
            ->scalar('pa_transit')
            ->maxLength('pa_transit', 35)
            ->allowEmptyString('pa_transit');

        $validator
            ->dateTime('transit_date')
            ->allowEmptyDateTime('transit_date');

        $validator
            ->scalar('pa_school')
            ->maxLength('pa_school', 35)
            ->allowEmptyString('pa_school');

        $validator
            ->dateTime('sreceived_date')
            ->allowEmptyDateTime('sreceived_date');

        $validator
            ->scalar('pa_warehouse')
            ->maxLength('pa_warehouse', 35)
            ->allowEmptyString('pa_warehouse');

        $validator
            ->dateTime('wreceived_date')
            ->allowEmptyDateTime('wreceived_date');

        $validator
            ->dateTime('warranty_period')
            ->allowEmptyDateTime('warranty_period');

        $validator
            ->scalar('status')
            ->maxLength('status', 22)
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['program_id'], 'Programs'), ['errorField' => 'program_id']);
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'), ['errorField' => 'vendor_id']);
        $rules->add($rules->existsIn(['school_id'], 'Schools'), ['errorField' => 'school_id']);
        $rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'), ['errorField' => 'warehouse_id']);

        return $rules;
    }
}
