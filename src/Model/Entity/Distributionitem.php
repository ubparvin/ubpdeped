<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Distributionitem Entity
 *
 * @property int $id
 * @property int $distribution_id
 * @property int $product_id
 * @property int $program_id
 * @property int $qty
 * @property \Cake\I18n\FrozenTime $added
 *
 * @property \App\Model\Entity\Distribution $distribution
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Program $program
 */
class Distributionitem extends Entity
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
        'distribution_id' => true,
        'product_id' => true,
        'program_id' => true,
        'series' => true,
        'series_start' => true,
        'series_end' => true,
        'qty' => true,
        'added' => true,
        'distribution' => true,
        'product' => true,
        'program' => true,
    ];
}
