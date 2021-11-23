<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Courierdcpitem Entity
 *
 * @property int $id
 * @property int $true
 * @property string|null $region
 * @property string|null $division
 * @property string|resource|null $school_beis
 * @property string|null $school
 * @property string|null $municipality
 * @property string|null $barangay
 * @property string|null $address
 * @property string|null $package_no
 * @property string|null $latop
 * @property string|null $smart_tv
 * @property string|null $lapel
 * @property string|null $package_lms
 */
class Courierdcpitem extends Entity
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
        'couriercontract_id' => true,
        'region' => true,
        'division' => true,
        'leg_district' => true,
        'school_beis' => true,
        'school' => true,
        'cust_name' => true,
        'cust_email' => true,
        'cust_contact' => true,
        'municipality' => true,
        'barangay' => true,
        'address' => true,
        'package_no' => true,
        'latop' => true,
        'smart_tv' => true,
        'lapel' => true,
        'package_lms' => true,
        'est_cost' => true,
        'est_total' => true,
		'couriercontract' => true,
		'status' => true,
		'dispatch_date' => true,
		'dn' => true,
    ];
}
