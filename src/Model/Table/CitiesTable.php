<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CitiesTable extends Table
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

        $this->setTable('cities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Offices', [
            'foreignKey' => 'citymunCode',
        ]);
        $this->hasMany('Schools', [
            'foreignKey' => 'citymunCode',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'citymunCode',
        ]);
        $this->hasMany('Vendors', [
            'foreignKey' => 'citymunCode',
        ]);
		$this->hasMany('Distributions', [
            'foreignKey' => 'citymunCode',
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
            ->scalar('citymunDesc')
            ->allowEmptyString('citymunDesc');

        $validator
            ->scalar('regDesc')
            ->maxLength('regDesc', 255)
            ->allowEmptyString('regDesc');

        $validator
            ->scalar('provCode')
            ->maxLength('provCode', 255)
            ->allowEmptyString('provCode');

        $validator
            ->scalar('citymunCode')
            ->maxLength('citymunCode', 255)
            ->allowEmptyString('citymunCode');

        return $validator;
    }
}
