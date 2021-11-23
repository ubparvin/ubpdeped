<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Couriertxtitems Model
 *
 * @property \App\Model\Table\CouriercontractsTable&\Cake\ORM\Association\BelongsTo $Couriercontracts
 *
 * @method \App\Model\Entity\Couriertxtitem newEmptyEntity()
 * @method \App\Model\Entity\Couriertxtitem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Couriertxtitem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Couriertxtitem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Couriertxtitem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Couriertxtitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Couriertxtitem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Couriertxtitem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Couriertxtitem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Couriertxtitem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriertxtitem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriertxtitem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Couriertxtitem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CouriertxtitemsTable extends Table
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

        $this->setTable('couriertxtitems');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Couriercontracts', [
            'foreignKey' => 'couriercontract_id',
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
            ->scalar('region')
            ->maxLength('region', 35)
            ->allowEmptyString('region');

        $validator
            ->scalar('division')
            ->maxLength('division', 35)
            ->allowEmptyString('division');

        $validator
            ->scalar('leg_district')
            ->maxLength('leg_district', 5)
            ->allowEmptyString('leg_district');

        $validator
            ->scalar('school_beis')
            ->maxLength('school_beis', 10)
            ->allowEmptyString('school_beis');

        $validator
            ->scalar('no_eas')
            ->maxLength('no_eas', 12)
            ->allowEmptyString('no_eas');

        $validator
            ->scalar('no_district')
            ->maxLength('no_district', 12)
            ->allowEmptyString('no_district');

        $validator
            ->scalar('recipient_district')
            ->allowEmptyString('recipient_district');

        $validator
            ->scalar('school')
            ->allowEmptyString('school');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('esp_tx')
            ->maxLength('esp_tx', 18)
            ->allowEmptyString('esp_tx');

        $validator
            ->scalar('esp_tm')
            ->maxLength('esp_tm', 18)
            ->allowEmptyString('esp_tm');

        $validator
            ->scalar('ar_tx')
            ->maxLength('ar_tx', 18)
            ->allowEmptyString('ar_tx');

        $validator
            ->scalar('ar_tm')
            ->maxLength('ar_tm', 18)
            ->allowEmptyString('ar_tm');

        $validator
            ->scalar('ma_tx')
            ->maxLength('ma_tx', 18)
            ->allowEmptyString('ma_tx');

        $validator
            ->scalar('ma_tm')
            ->maxLength('ma_tm', 18)
            ->allowEmptyString('ma_tm');

        $validator
            ->scalar('kg_ilokano')
            ->maxLength('kg_ilokano', 18)
            ->allowEmptyString('kg_ilokano');

        $validator
            ->scalar('kg_tagalog')
            ->maxLength('kg_tagalog', 18)
            ->allowEmptyString('kg_tagalog');

        $validator
            ->scalar('kg_pangasinan')
            ->maxLength('kg_pangasinan', 18)
            ->allowEmptyString('kg_pangasinan');

        $validator
            ->scalar('kg_ivatan')
            ->maxLength('kg_ivatan', 18)
            ->allowEmptyString('kg_ivatan');

        $validator
            ->scalar('kg_ibanag')
            ->maxLength('kg_ibanag', 18)
            ->allowEmptyString('kg_ibanag');

        $validator
            ->scalar('kg_kapampangan')
            ->maxLength('kg_kapampangan', 18)
            ->allowEmptyString('kg_kapampangan');

        $validator
            ->scalar('kg_sambal')
            ->maxLength('kg_sambal', 18)
            ->allowEmptyString('kg_sambal');

        $validator
            ->scalar('kg_bikol')
            ->maxLength('kg_bikol', 18)
            ->allowEmptyString('kg_bikol');

        $validator
            ->scalar('kg_binisaya')
            ->maxLength('kg_binisaya', 18)
            ->allowEmptyString('kg_binisaya');

        $validator
            ->scalar('kg_waray')
            ->maxLength('kg_waray', 18)
            ->allowEmptyString('kg_waray');

        $validator
            ->scalar('kg_hiligaynon')
            ->maxLength('kg_hiligaynon', 18)
            ->allowEmptyString('kg_hiligaynon');

        $validator
            ->scalar('kg_kinaraya')
            ->maxLength('kg_kinaraya', 18)
            ->allowEmptyString('kg_kinaraya');

        $validator
            ->scalar('kg_akeanon')
            ->maxLength('kg_akeanon', 18)
            ->allowEmptyString('kg_akeanon');

        $validator
            ->scalar('kg_chavacano')
            ->maxLength('kg_chavacano', 18)
            ->allowEmptyString('kg_chavacano');

        $validator
            ->scalar('kg_maguindanao')
            ->maxLength('kg_maguindanao', 18)
            ->allowEmptyString('kg_maguindanao');

        $validator
            ->scalar('kg_maranao')
            ->maxLength('kg_maranao', 18)
            ->allowEmptyString('kg_maranao');

        $validator
            ->scalar('kg_surigaonon')
            ->maxLength('kg_surigaonon', 18)
            ->allowEmptyString('kg_surigaonon');

        $validator
            ->scalar('kg_yakan')
            ->maxLength('kg_yakan', 18)
            ->allowEmptyString('kg_yakan');

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
        $rules->add($rules->existsIn(['couriercontract_id'], 'Couriercontracts'), ['errorField' => 'couriercontract_id']);

        return $rules;
    }
}
