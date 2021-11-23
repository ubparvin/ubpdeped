<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Group newEmptyEntity()
 * @method \App\Model\Entity\Group newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Group[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Group get($primaryKey, $options = [])
 * @method \App\Model\Entity\Group findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Group patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Group[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Group|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Group saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Group[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class GroupsTable extends Table
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

        $this->setTable('groups');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Users', [
            'foreignKey' => 'group_id',
        ]);
		
		$this->BelongsTo('Diststagings', [
            'foreignKey' => 'diststaging_id',
        ]);
		
		/*$this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'added' => 'new',
                    //'modified_at' => 'always'
                ]
            ]
        ]);*/
    }
	
	/*
	public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options){
		
		$entity = $event->getData('entity');
		if(empty($entity->group['added'])){
		  $entity->group['added'] = date('Y-m-d H:i:s');
		}
		
		return true;
	}*/
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
            ->maxLength('name', 35)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Please provide the group name')
			->add('name', [
				'length' => [
					'rule' => ['minLength', 2],
					'message' => 'Please provide the group name',
				]
			]);
		
		$validator
            ->scalar('diststaging_id')
            ->requirePresence('diststaging_id', 'create')
            ->notEmptyString('diststaging_id', 'Please provide the staging');
			
        $validator
            ->scalar('description')
            ->allowEmptyString('description');
		
		$validator
            ->scalar('status')
           ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Status is required');

        $validator
            ->dateTime('added')
           // ->requirePresence('added', 'create')
            ->requirePresence(['added' => [
				'mode' => 'create',
				'message' => 'Registration date is required.'
			]])
            ->notEmptyDateTime('added', 'Please provide the group name')
			->notEmptyString('added', 'Please provide the group name');
			

        return $validator;
    }
	
	public function buildRules(RulesChecker $rules): RulesChecker{
      
		$rules->add($rules->isUnique(
			//['name', 'account_id'],
			['name'],
			//'This username & account_id combination has already been used.'
			'The same information might already exists. Please check the details again.'
		  ));

        return $rules;
    }
	
}
