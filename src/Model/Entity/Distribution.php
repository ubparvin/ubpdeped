<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Distribution Entity
 *
 * @property int $id
 * @property string $refid
 * @property int|null $program_id
 * @property int $school_id
 * @property string $region_id
 * @property string $province_id
 * @property string $city_id
 * @property string $barangay_id
 * @property string $sitio
 * @property string $address
 * @property \Cake\I18n\FrozenTime $created
 * @property int $userid
 * @property string $status
 *
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Province $province
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Barangay $barangay
 * @property \App\Model\Entity\Distransaction[] $distransactions
 * @property \App\Model\Entity\Distributionitem[] $distributionitems
 */
class Distribution extends Entity
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
        'refid' => true,
        'program_id' => true,
        'school_id' => true,
        'regCode' => true,
        'provCode' => true,
        'citymunCode' => true,
        'brgyCode' => true,
        'sitio' => true,
        'address' => true,
        'created' => true,
        'est_from' => true,
        'est_to' => true,
        'userid' => true,
        'diststaging_id' => true,
        'program' => true,
        'school' => true,
        'region' => true,
        'province' => true,
        'city' => true,
        'barangay' => true,
        'distransactions' => true,
        'distributionitems' => true,
        'diststagings' => true,
    ];
}
