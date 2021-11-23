<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Division Entity
 *
 * @property int $id
 * @property string $regCode
 * @property string|null $name
 * @property string $sds
 * @property string $asds
 * @property string $hqco
 * @property string $supply_officer
 * @property string $contact_no
 * @property string $email
 */
class Division extends Entity
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
        'regCode' => true,
        'name' => true,
        'sds' => true,
        'asds' => true,
        'hqco' => true,
        'supply_officer' => true,
        'contact_no' => true,
        'email' => true,
    ];
}
