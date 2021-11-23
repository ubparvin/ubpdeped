<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subitems Model
 *
 * @method \App\Model\Entity\Subitem newEmptyEntity()
 * @method \App\Model\Entity\Subitem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subitem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subitem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subitem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subitem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subitem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subitem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subitem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subitem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subitem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subitem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SubitemsTable extends Table
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

        $this->setTable('subitems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('status')
            ->maxLength('status', 8)
            ->notEmptyString('status');

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
