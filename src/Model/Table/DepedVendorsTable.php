<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DepedVendors Model
 *
 * @property \App\Model\Table\BarangaysTable&\Cake\ORM\Association\BelongsTo $Barangays
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\ProvincesTable&\Cake\ORM\Association\BelongsTo $Provinces
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 *
 * @method \App\Model\Entity\DepedVendor newEmptyEntity()
 * @method \App\Model\Entity\DepedVendor newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\DepedVendor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepedVendor get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepedVendor findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\DepedVendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepedVendor[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepedVendor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepedVendor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepedVendor[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepedVendor[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepedVendor[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\DepedVendor[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepedVendorsTable extends Table
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

        $this->setTable('deped_vendors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Barangays', [
            'foreignKey' => 'barangay_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Provinces', [
            'foreignKey' => 'province_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Regions', [
            'foreignKey' => 'region_id',
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
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('mobile_no')
            ->maxLength('mobile_no', 11)
            ->requirePresence('mobile_no', 'create')
            ->notEmptyString('mobile_no');

        $validator
            ->scalar('tel_no')
            ->maxLength('tel_no', 18)
            ->allowEmptyString('tel_no');

        $validator
            ->scalar('contact_person')
            ->maxLength('contact_person', 50)
            ->requirePresence('contact_person', 'create')
            ->notEmptyString('contact_person');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->dateTime('added')
            ->requirePresence('added', 'create')
            ->notEmptyDateTime('added');

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
        $rules->add($rules->existsIn(['barangay_id'], 'Barangays'), ['errorField' => 'barangay_id']);
        $rules->add($rules->existsIn(['city_id'], 'Cities'), ['errorField' => 'city_id']);
        $rules->add($rules->existsIn(['province_id'], 'Provinces'), ['errorField' => 'province_id']);
        $rules->add($rules->existsIn(['region_id'], 'Regions'), ['errorField' => 'region_id']);

        return $rules;
    }
}
