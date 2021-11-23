<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courierdcpitems Model
 *
 * @method \App\Model\Entity\Courierdcpitem newEmptyEntity()
 * @method \App\Model\Entity\Courierdcpitem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Courierdcpitem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Courierdcpitem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Courierdcpitem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Courierdcpitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Courierdcpitem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Courierdcpitem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Courierdcpitem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Courierdcpitem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Courierdcpitem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Courierdcpitem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Courierdcpitem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CourierdcpitemsTable extends Table
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

        $this->setTable('courierdcpitems');
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
            ->allowEmptyString('school_beis');

        $validator
            ->scalar('school')
            ->allowEmptyString('school');

        $validator
            ->scalar('municipality')
            ->allowEmptyString('municipality');
			
		$validator
            ->scalar('leg_district')
            ->allowEmptyString('leg_district');

        $validator
            ->scalar('barangay')
            ->allowEmptyString('barangay');

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('package_no')
            ->maxLength('package_no', 12)
            ->allowEmptyString('package_no');

        $validator
            ->scalar('latop')
            ->maxLength('latop', 12)
            ->allowEmptyString('latop');

        $validator
            ->scalar('smart_tv')
            ->maxLength('smart_tv', 12)
            ->allowEmptyString('smart_tv');

        $validator
            ->scalar('lapel')
            ->maxLength('lapel', 12)
            ->allowEmptyString('lapel');

        $validator
            ->scalar('package_lms')
            ->maxLength('package_lms', 12)
            ->allowEmptyString('package_lms');
		
		$validator
            ->scalar('est_cost')
            ->maxLength('est_cost', 12)
            ->allowEmptyString('est_cost');
		
		$validator
            ->scalar('est_total')
            ->maxLength('est_total', 12)
            ->allowEmptyString('est_total');

        return $validator;
    }
}
