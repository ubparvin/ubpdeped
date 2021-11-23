<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Receife Entity
 *
 * @property int $id
 * @property string $refid
 * @property int $receiveable_id
 * @property int $school_id
 * @property int $office_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $received_date
 *
 * @property \App\Model\Entity\Receiveable $receiveable
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Office $office
 * @property \App\Model\Entity\User $user
 */
class Receife extends Entity
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
        'receiveable_id' => true,
        'school_id' => true,
        'office_id' => true,
        'user_id' => true,
        'received_date' => true,
        'receiveable' => true,
        'school' => true,
        'office' => true,
        'user' => true,
    ];
}
