<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Warehouseinventory Entity
 *
 * @property int $id
 * @property int $warehouse_id
 * @property int $logistic_id
 * @property string $item_series
 * @property string $qty
 * @property string $received_by
 * @property \Cake\I18n\FrozenTime $received_date
 *
 * @property \App\Model\Entity\Warehouse $warehouse
 * @property \App\Model\Entity\Logistic $logistic
 */
class Warehouseinventory extends Entity
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
        'warehouse_id' => true,
        'logistic_id' => true,
        'item_series' => true,
        'qty' => true,
        'received_by' => true,
        'received_date' => true,
        'warehouse' => true,
        'logistic' => true,
    ];
}
