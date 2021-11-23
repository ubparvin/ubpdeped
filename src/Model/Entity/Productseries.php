<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Productseries Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $series
 * @property string $start
 * @property string $end
 * @property int $qty
 * @property \Cake\I18n\FrozenTime $receive
 * @property int $received_by
 *
 * @property \App\Model\Entity\Product $product
 */
class Productseries extends Entity
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
        'product_id' => true,
        'series' => true,
        'start' => true,
        'end' => true,
        'qty' => true,
        'receive' => true,
        'received_by' => true,
        'product' => true
    ];
}
