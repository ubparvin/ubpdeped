<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Distransaction Entity
 *
 * @property int $int
 * @property int $distribution_id
 * @property \Cake\I18n\FrozenTime $received
 * @property \Cake\I18n\FrozenTime|null $release
 * @property string $type
 * @property int $userid
 *
 * @property \App\Model\Entity\Distribution $distribution
 */
class Distransaction extends Entity
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
        'date_received' => true,
        'date_released' => true,
        'diststaging_id' => true,
        'userid' => true,
        'distribution' => true,
        'diststaging' => true
    ];
}
