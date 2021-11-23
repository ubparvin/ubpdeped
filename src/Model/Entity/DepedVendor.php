<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DepedVendor Entity
 *
 * @property int $id
 * @property string $name
 * @property string $mobile_no
 * @property string|null $tel_no
 * @property string $contact_person
 * @property int $barangay_id
 * @property int $city_id
 * @property int $province_id
 * @property int $region_id
 * @property string $address
 * @property \Cake\I18n\FrozenTime $added
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Barangay $barangay
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Province $province
 * @property \App\Model\Entity\Region $region
 */
class DepedVendor extends Entity
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
        'mobile_no' => true,
        'tel_no' => true,
        'contact_person' => true,
        'barangay_id' => true,
        'city_id' => true,
        'province_id' => true,
        'region_id' => true,
        'address' => true,
        'added' => true,
        'modified' => true,
        'barangay' => true,
        'city' => true,
        'province' => true,
        'region' => true,
    ];
}
