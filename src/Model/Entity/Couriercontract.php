<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Couriercontract Entity
 *
 * @property int $id
 * @property int|null $courier_id
 * @property int|null $program_id
 * @property int|null $vendor_id
 * @property string|null $level
 * @property string|null $name
 * @property string|null $description
 * @property string|null $contract_year
 *
 * @property \App\Model\Entity\Courier $courier
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Couriertxtitem[] $couriertxtitems
 */
class Couriercontract extends Entity
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
        'courier_id' => true,
        'program_id' => true,
        'vendor_id' => true,
        'level' => true,
        'name' => true,
        'description' => true,
        'contract_year' => true,
        'courier' => true,
        'program' => true,
        'vendor' => true,
        'couriertxtitems' => true,
        'courierdcpitems' => true,
    ];
}
