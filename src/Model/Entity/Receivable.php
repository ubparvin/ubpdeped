<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Receivable Entity
 *
 * @property int $id
 * @property string $refid
 * @property int $user_id
 * @property int $order_id
 * @property int $school_id
 * @property int $office_id
 * @property \Cake\I18n\FrozenDate $estimated_delivery
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Office $office
 */
class Receivable extends Entity
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
        'school_id' => true,
        'office_id' => true,
        'estimated_delivery' => true,
        'created' => true,
        'user' => true,
        'order' => true,
        'school' => true,
        'office' => true,
    ];
}
