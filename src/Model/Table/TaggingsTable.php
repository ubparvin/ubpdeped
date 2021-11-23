<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taggings Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products
 *
 * @method \App\Model\Entity\Tagging newEmptyEntity()
 * @method \App\Model\Entity\Tagging newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tagging[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tagging get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tagging findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tagging patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tagging[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tagging|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagging saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tagging[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagging[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagging[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tagging[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TaggingsTable extends Table
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

        $this->setTable('taggings');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Products', [
            'foreignKey' => 'tagging_id',
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
            ->maxLength('name', 35)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Name is required');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
