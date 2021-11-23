<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diststagings Model
 *
 * @method \App\Model\Entity\Diststaging newEmptyEntity()
 * @method \App\Model\Entity\Diststaging newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Diststaging[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Diststaging get($primaryKey, $options = [])
 * @method \App\Model\Entity\Diststaging findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Diststaging patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Diststaging[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Diststaging|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diststaging saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diststaging[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diststaging[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diststaging[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diststaging[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DiststagingsTable extends Table
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

        $this->setTable('diststagings');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');
		
	   $this->hasMany('Groups', [
            'foreignKey' => 'diststaging_id',
        ]);

		$this->hasMany('Users', [
            'foreignKey' => 'diststaging_id',
        ]);
		
		$this->hasMany('Distributions', [
            'foreignKey' => 'diststaging_id',
        ]);
		
		$this->hasMany('Distransactions', [
            'foreignKey' => 'diststaging_id',
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
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 50)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }
}
