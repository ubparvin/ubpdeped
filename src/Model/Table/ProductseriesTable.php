<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Productseries Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Productseries newEmptyEntity()
 * @method \App\Model\Entity\Productseries newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Productseries[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Productseries get($primaryKey, $options = [])
 * @method \App\Model\Entity\Productseries findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Productseries patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Productseries[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Productseries|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Productseries saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Productseries[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Productseries[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Productseries[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Productseries[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ProductseriesTable extends Table
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

        $this->setTable('productseries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->maxLength('series', 8)
            ->requirePresence('series', 'create')
            ->notEmptyString('series');

        $validator
            ->scalar('start')
            ->maxLength('start', 8)
            ->requirePresence('start', 'create')
            ->notEmptyString('start');

        $validator
            ->scalar('end')
            ->maxLength('end', 8)
            ->requirePresence('end', 'create')
            ->notEmptyString('end');

        $validator
            ->integer('qty')
            ->requirePresence('qty', 'create')
            ->notEmptyString('qty');

        $validator
            ->dateTime('receive')
            ->requirePresence('receive', 'create')
            ->notEmptyDateTime('receive');

        $validator
            ->integer('received_by')
            ->requirePresence('received_by', 'create')
            ->notEmptyString('received_by');

        return $validator;
    }

}
