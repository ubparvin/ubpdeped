<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Distributionitems Model
 *
 * @property \App\Model\Table\DistributionsTable&\Cake\ORM\Association\BelongsTo $Distributions
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\ProgramsTable&\Cake\ORM\Association\BelongsTo $Programs
 *
 * @method \App\Model\Entity\Distributionitem newEmptyEntity()
 * @method \App\Model\Entity\Distributionitem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Distributionitem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Distributionitem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Distributionitem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Distributionitem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Distributionitem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Distributionitem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distributionitem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Distributionitem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distributionitem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distributionitem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Distributionitem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DistributionitemsTable extends Table
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

        $this->setTable('distributionitems');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Distributions', [
            'foreignKey' => 'distribution_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
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
            ->scalar('qty')
            ->requirePresence('qty', 'create')
            ->notEmptyString('qty');

        $validator
            ->dateTime('added')
            ->requirePresence('added', 'create')
            ->notEmptyDateTime('added');

        return $validator;
    }


}
