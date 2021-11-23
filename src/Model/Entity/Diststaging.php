<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diststaging Entity
 *
 * @property int $id
 * @property string $code
 * @property string $description
 */
class Diststaging extends Entity
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
        'name' => true,
        'description' => true,
		'groups' => true,
		'users'	=> true,
		'distributions'	=> true,
		'distransactions'	=> true
    ];
}
