<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Logistic Entity
 *
 * @property int $id
 * @property string $qrcode
 * @property string|null $serial_no
 * @property string|null $qty
 * @property int|null $program_id
 * @property string|null $budget_year
 * @property \Cake\I18n\FrozenTime|null $inspection_date
 * @property int|null $vendor_id
 * @property string|null $brand_model
 * @property string|null $acq_cost
 * @property \Cake\I18n\FrozenTime|null $acq_date
 * @property string|null $pa_inspector
 * @property \Cake\I18n\FrozenTime|null $inspect_date
 * @property string|null $pa_transit
 * @property \Cake\I18n\FrozenTime|null $transit_date
 * @property int|null $school_id
 * @property string|null $pa_school
 * @property \Cake\I18n\FrozenTime|null $sreceived_date
 * @property int|null $warehouse_id
 * @property string|null $pa_warehouse
 * @property \Cake\I18n\FrozenTime|null $wreceived_date
 * @property \Cake\I18n\FrozenTime|null $warranty_period
 * @property string $status
 *
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Warehouse $warehouse
 * @property \App\Model\Entity\Logistictran[] $logistictrans
 * @property \App\Model\Entity\Schoolinventory[] $schoolinventories
 * @property \App\Model\Entity\Warehouseinventory[] $warehouseinventories
 */
class Logistic extends Entity
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
        'qrcode' => true,
        'serial_no' => true,
        'qty' => true,
        'program_id' => true,
        'budget_year' => true,
        'inspection_date' => true,
        'vendor_id' => true,
        'brand_model' => true,
        'acq_cost' => true,
        'acq_date' => true,
        'pa_inspector' => true,
        'inspect_date' => true,
        'pa_transit' => true,
        'transit_date' => true,
        'school_id' => true,
        'pa_school' => true,
        'sreceived_date' => true,
        'warehouse_id' => true,
        'pa_warehouse' => true,
        'wreceived_date' => true,
        'warranty_period' => true,
        'status' => true,
        'program' => true,
        'vendor' => true,
        'school' => true,
        'warehouse' => true,
        'logistictrans' => true,
        'schoolinventories' => true,
        'warehouseinventories' => true,
    ];
}
