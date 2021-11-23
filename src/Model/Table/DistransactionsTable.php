<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Distransactions Model
 *
 * @property \App\Model\Table\DistributionsTable&\Cake\ORM\Association\BelongsTo $Distributions
 *
 * @method \App\Model\Entity\Distransaction newEmptyEntity()
 * @method \App\Model\Entity\Distransaction newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Distransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Distransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Distransaction findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Distransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Distransaction[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Distransaction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distransaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distransaction[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distransaction[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distransaction[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distransaction[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DistransactionsTable extends Table
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

        $this->setTable('distransactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Distributions', [
            'foreignKey' => 'distribution_id',
            'joinType' => 'INNER',
        ]);

		$this->belongsTo('Diststagings', [
            'foreignKey' => 'diststaging_id',
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


        return $validator;
    }

}
