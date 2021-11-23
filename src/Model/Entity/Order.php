<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $refid
 * @property int $user_id
 * @property int $vendor_id
 * @property string|null $vat
 * @property string|null $vatable_sales
 * @property string|null $amount_due
 * @property string|null $receiver_address
 * @property string|null $payment_address
 * @property \Cake\I18n\FrozenDate|null $estimated_delivery
 * @property string|null $payment_type
 * @property string|null $payment
 * @property string|null $payment_status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $order_status
 * @property string|null $note
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Payment[] $payments
 * @property \App\Model\Entity\Purchase[] $purchases
 * @property \App\Model\Entity\Receivable[] $receivables
 */
class Order extends Entity
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
        'request_id' 		=> true,
        'request_refid' 	=> true,
        'refid' 			=> true,
        'vendor_id' 		=> true,
        'vat' 				=> true,
        'vatable_sales' 	=> true,
        'amount_due' 		=> true,
        'receiver_address' 	=> true,
        'payment_address' 	=> true,
        'estimated_delivery' => true,
        'payment_type' 		=> true,
        'payment' 			=> true,
        'payment_status' 	=> true,
        'added' 			=> true,
        'added_by' 			=> true,
        'modified' 			=> true,
        'modified_by' 		=> true,
        'order_status' 		=> true,
        'note' 				=> true,
        'vendor' 			=> true,
        'payments' 			=> true,
        'purchases' 		=> true,
        'receivables' 		=> true,
    ];
}
