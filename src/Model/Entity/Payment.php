<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property string $refid
 * @property int $user_id
 * @property int $order_id
 * @property string $amount_paid
 * @property string $payment_type
 * @property \Cake\I18n\FrozenTime $added
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Order $order
 */
class Payment extends Entity
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
        'refid' => true,
        'user_id' => true,
        'order_id' => true,
        'amount_paid' => true,
        'payment_type' => true,
        'added' => true,
        'modified' => true,
        'user' => true,
        'order' => true,
    ];
}
