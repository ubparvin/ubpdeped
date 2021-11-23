<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Distributions Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsTo $Schools
 * @property \App\Model\Table\RegionsTable&\Cake\ORM\Association\BelongsTo $Regions
 * @property \App\Model\Table\ProvincesTable&\Cake\ORM\Association\BelongsTo $Provinces
 * @property \App\Model\Table\CitiesTable&\Cake\ORM\Association\BelongsTo $Cities
 * @property \App\Model\Table\BarangaysTable&\Cake\ORM\Association\BelongsTo $Barangays
 * @property \App\Model\Table\DistransactionsTable&\Cake\ORM\Association\HasMany $Distransactions
 * @property \App\Model\Table\DistributionitemsTable&\Cake\ORM\Association\HasMany $Distributionitems
 *
 * @method \App\Model\Entity\Distribution newEmptyEntity()
 * @method \App\Model\Entity\Distribution newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Distribution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Distribution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Distribution findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Distribution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Distribution[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Distribution|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distribution saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distribution[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distribution[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distribution[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distribution[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DistributionsTable extends Table
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

        $this->setTable('distributions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
        ]);
        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
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
        $this->belongsTo('Cities', [
            'foreignKey' => 'citymunCode',
            'joinType' => 'INNER',
        ]);
		
		$this->belongsTo('Diststagings', [
            'foreignKey' => 'diststaging_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Barangays', [
            'foreignKey' => 'brgyCode',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Distransactions', [
            'foreignKey' => 'distribution_id',
        ]);
        $this->hasMany('Distributionitems', [
            'foreignKey' => 'distribution_id',
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
            ->scalar('refid')
            ->maxLength('refid', 35)
            ->requirePresence('refid', 'create')
            ->notEmptyString('refid', 'Reference id is required');
		
		$validator
            ->scalar('est_from')
            ->requirePresence('est_from', 'create', 'Estimated delivery is required')
            ->notEmptyString('est_from');
		
		$validator
            ->scalar('est_to')
            ->requirePresence('est_to', 'create', 'Estimated delivery is required')
            ->notEmptyString('est_to');
		
        $validator
            ->scalar('sitio')
            ->requirePresence('sitio', 'create')
            ->notEmptyString('sitio', 'Address is required');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address', 'Address is required');

        $validator
            ->integer('userid')
            ->requirePresence('userid', 'create')
            ->notEmptyString('userid', 'Auther is required');

        $validator
            ->scalar('diststaging_id')
            ->maxLength('diststaging_id', 2)
            ->requirePresence('diststaging_id', 'create')
            ->notEmptyString('diststaging_id', 'Staging is required');
		
		 	
        return $validator;
    }

   
}
