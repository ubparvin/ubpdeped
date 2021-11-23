<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Warehouse Entity
 *
 * @property int $id
 * @property string $name
 * @property string $regCode
 * @property string $provCode
 * @property string $citymunCode
 * @property string $brgyCode
 * @property string $sitio
 * @property string $address
 * @property string $mobile_no
 * @property string|null $tel_no
 * @property string $contact_person
 * @property \Cake\I18n\FrozenTime $added
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Logistic[] $logistics
 * @property \App\Model\Entity\Warehouseinventory[] $warehouseinventories
 */
class Warehouse extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'regCode' => true,
        'provCode' => true,
        'citymunCode' => true,
        'brgyCode' => true,
        'sitio' => true,
        'address' => true,
        'mobile_no' => true,
        'tel_no' => true,
        'contact_person' => true,
        'added' => true,
        'modified' => true,
        'logistics' => true,
        'warehouseinventories' => true,
        'users' => true,
    ];
}
