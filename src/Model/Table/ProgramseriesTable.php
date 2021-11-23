<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programseries Model
 *
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 *
 * @method \App\Model\Entity\Programseries newEmptyEntity()
 * @method \App\Model\Entity\Programseries newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Programseries[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Programseries get($primaryKey, $options = [])
 * @method \App\Model\Entity\Programseries findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Programseries patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Programseries[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Programseries|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programseries saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Programseries[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Programseries[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Programseries[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Programseries[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProgramseriesTable extends Table
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

        $this->setTable('programseries');
        $this->setDisplayField('series');
        $this->setPrimaryKey('id');

        $this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
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
            ->scalar('series')
            ->maxLength('series', 10)
            ->requirePresence('series', 'create')
            ->notEmptyString('series', 'Series is required');
		
		$validator
            ->integer('program_id')
           // ->maxLength('program_id', 11)
            ->requirePresence('program_id', 'create')
            ->notEmptyString('program_id', 'Program is required');

        $validator
            ->scalar('start')
            ->maxLength('start', 10)
            ->requirePresence('start', 'create')
            ->notEmptyString('start', 'Series Start is required');

        $validator
            ->scalar('end')
            ->maxLength('end', 10)
            ->requirePresence('end', 'create')
            ->notEmptyString('end', 'Series end is required');

        $validator
            ->scalar('date_start')
            ->requirePresence('date_start', 'create')
            ->notEmptyDate('date_start', 'Series date start is required');

        $validator
            ->scalar('date_end')
            ->requirePresence('date_end', 'create')
            ->notEmptyDate('date_end', 'Series date end is required');
		
		$validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status is required');


        $validator
            ->dateTime('added')
            ->requirePresence('added', 'create')
            ->notEmptyDateTime('added', 'Date created is required');

        return $validator;
    }
	
	 public function buildRules(RulesChecker $rules): RulesChecker
    {
       	  
		$rules->add($rules->isUnique(
			['series'],
			'Program series already exists. Please check the details again.'
		  ));

        return $rules;
    }
	
    
}
