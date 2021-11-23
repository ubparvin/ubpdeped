<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Logistictrans Model
 *
 * @property \App\Model\Table\LogisticsTable&\Cake\ORM\Association\BelongsTo $Logistics
 *
 * @method \App\Model\Entity\Logistictran newEmptyEntity()
 * @method \App\Model\Entity\Logistictran newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Logistictran[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Logistictran get($primaryKey, $options = [])
 * @method \App\Model\Entity\Logistictran findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Logistictran patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Logistictran[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Logistictran|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistictran saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Logistictran[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistictran[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistictran[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Logistictran[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LogistictransTable extends Table
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

        $this->setTable('logistictrans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->scalar('status')
            ->maxLength('status', 22)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmptyDateTime('date');

        $validator
            ->scalar('pa_refid')
            ->maxLength('pa_refid', 35)
            ->requirePresence('pa_refid', 'create')
            ->notEmptyString('pa_refid');

        $validator
            ->scalar('pa_name')
            ->maxLength('pa_name', 50)
            ->requirePresence('pa_name', 'create')
            ->notEmptyString('pa_name');

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
        $rules->add($rules->existsIn(['logistic_id'], 'Logistics'), ['errorField' => 'logistic_id']);

        return $rules;
    }
}
