<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logistictran Entity
 *
 * @property int $id
 * @property int $logistic_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $date
 * @property string $pa_refid
 * @property string $pa_name
 *
 * @property \App\Model\Entity\Logistic $logistic
 */
class Logistictran extends Entity
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
        'logistic_id' => true,
        'status' => true,
        'date' => true,
        'pa_refid' => true,
        'pa_name' => true,
        'logistic' => true,
    ];
}
