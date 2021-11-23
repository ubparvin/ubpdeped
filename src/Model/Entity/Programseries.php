<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Programseries Entity
 *
 * @property int $id
 * @property int $program_id
 * @property string $series
 * @property string $start
 * @property string $end
 * @property \Cake\I18n\FrozenDate $date_start
 * @property \Cake\I18n\FrozenDate $date_end
 * @property \Cake\I18n\FrozenTime $added
 *
 * @property \App\Model\Entity\Program $program
 */
class Programseries extends Entity
{

    protected $_accessible = [
        'program_id' => true,
        'series' => true,
        'start' => true,
        'end' => true,
        'date_start' => true,
        'date_end' => true,
        'added' => true,
        'status' => true,
        'program' => true,
    ];
}
