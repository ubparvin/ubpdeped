<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property string $type
 * @property int $product_id
 * @property int|null $current_qty
 * @property int|null $added_qty
 * @property int|null $new_qty
 * @property \Cake\I18n\FrozenTime $created
 * @property int $trans_by
 *
 * @property \App\Model\Entity\Product $product
 */
class Transaction extends Entity
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
        'type' => true,
        'product_id' => true,
        'current_qty' => true,
        'added_qty' => true,
        'new_qty' => true,
        'series' => true,
        'series_start' => true,
        'series_end' => true,
        'created' => true,
        'trans_by' => true,
        'product' => true
    ];
}
