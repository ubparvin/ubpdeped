<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Officeitem Entity
 *
 * @property int $id
 * @property int $school_id
 * @property int $product_id
 * @property int|null $qty
 *
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Product $product
 */
class Officeitem extends Entity
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
        'school_id' => true,
        'product_id' => true,
        'qty' => true,
        'school' => true,
        'product' => true,
    ];
}
