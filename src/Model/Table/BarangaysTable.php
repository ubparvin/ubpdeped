<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


class BarangaysTable extends Table
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

        $this->setTable('barangays');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Offices', [
            'foreignKey' => 'brgyCode',
        ]);
        $this->hasMany('Schools', [
            'foreignKey' => 'brgyCode',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'brgyCode',
        ]);
        $this->hasMany('Vendors', [
            'foreignKey' => 'brgyCode',
        ]);
		$this->hasMany('Distributions', [
            'foreignKey' => 'brgyCode',
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
            ->scalar('brgyCode')
            ->maxLength('brgyCode', 255)
            ->allowEmptyString('brgyCode');

        $validator
            ->scalar('brgyDesc')
            ->allowEmptyString('brgyDesc');

        $validator
            ->scalar('regCode')
            ->maxLength('regCode', 255)
            ->allowEmptyString('regCode');

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
