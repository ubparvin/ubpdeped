<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property string $refid
 * @property string $requestor
 * @property string $details
 * @property \Cake\I18n\FrozenTime $date
 * @property string|null $school
 * @property string|null $office
 * @property string|null $delivery_address
 * @property string $items
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $modified_by
 * @property string $status
 */
class Request extends Entity
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
        'refid' 			=> true,
        'requestor' 		=> true,
		'requestorid'		=> true,
		'requestorrefid'	=> true,
        'school_id' 		=> true,
        'product_id' 		=> true,
        'qty' 				=> true,
        'added' 			=> true,
        'modified' 			=> true,
        'modified_by' 		=> true,
        'status' 			=> true,
        'note' 				=> true
    ];
}
