<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Purchase Entity
 *
 * @property int $id
 * @property string $refid
 * @property int $order_id
 * @property int $product_id
 * @property string $price
 * @property string $qty
 * @property string $total_price
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Product $product
 */
class Purchase extends Entity
{

    protected $_accessible = [
        'order_id' => true,
        'order_refid' => true,
        'product_id' => true,
        'price' => true,
        'qty' => true,
        'total_price' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'product' => true,
    ];
}
