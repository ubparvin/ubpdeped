<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Province Entity
 *
 * @property int $id
 * @property string|null $psgcCode
 * @property string|null $provDesc
 * @property string|null $regCode
 * @property string|null $provCode
 *
 * @property \App\Model\Entity\Office[] $offices
 * @property \App\Model\Entity\School[] $schools
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Vendor[] $vendors
 */
class Province extends Entity
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
        'psgcCode' => true,
        'provDesc' => true,
        'regCode' => true,
        'provCode' => true,
        'offices' => true,
        'schools' => true,
        'users' => true,
        'vendors' => true,
        'distributions' => true,
    ];
}
