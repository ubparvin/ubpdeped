<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProvincesTable extends Table
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

        $this->setTable('provinces');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Offices', [
            'foreignKey' => 'provCode',
        ]);
        $this->hasMany('Schools', [
            'foreignKey' => 'provCode',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'provCode',
        ]);
        $this->hasMany('Vendors', [
            'foreignKey' => 'provCode',
        ]);
		$this->hasMany('Distributions', [
            'foreignKey' => 'provCode',
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
            ->scalar('psgcCode')
            ->maxLength('psgcCode', 255)
            ->allowEmptyString('psgcCode');

        $validator
            ->scalar('provDesc')
            ->allowEmptyString('provDesc');

        $validator
            ->scalar('regCode')
            ->maxLength('regCode', 255)
            ->allowEmptyString('regCode');

        $validator
            ->scalar('provCode')
            ->maxLength('provCode', 255)
            ->allowEmptyString('provCode');

        return $validator;
    }
}
