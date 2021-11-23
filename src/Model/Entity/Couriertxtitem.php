<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Couriertxtitem Entity
 *
 * @property int $id
 * @property int $couriercontract_id
 * @property string|null $region
 * @property string|null $division
 * @property string|null $leg_district
 * @property string|null $school_beis
 * @property string|null $no_eas
 * @property string|null $no_district
 * @property string|null $recipient_district
 * @property string|null $school
 * @property string|null $address
 * @property string|null $esp_tx
 * @property string|null $esp_tm
 * @property string|null $ar_tx
 * @property string|null $ar_tm
 * @property string|null $ma_tx
 * @property string|null $ma_tm
 * @property string|null $kg_ilokano
 * @property string|null $kg_tagalog
 * @property string|null $kg_pangasinan
 * @property string|null $kg_ivatan
 * @property string|null $kg_ibanag
 * @property string|null $kg_kapampangan
 * @property string|null $kg_sambal
 * @property string|null $kg_bikol
 * @property string|null $kg_binisaya
 * @property string|null $kg_waray
 * @property string|null $kg_hiligaynon
 * @property string|null $kg_kinaraya
 * @property string|null $kg_akeanon
 * @property string|null $kg_chavacano
 * @property string|null $kg_maguindanao
 * @property string|null $kg_maranao
 * @property string|null $kg_surigaonon
 * @property string|null $kg_yakan
 *
 * @property \App\Model\Entity\Couriercontract $couriercontract
 */
class Couriertxtitem extends Entity
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
        'couriercontract_id' => true,
        'region' => true,
        'division' => true,
        'leg_district' => true,
        'school_beis' => true,
        'no_eas' => true,
        'no_district' => true,
        'recipient_district' => true,
        'school' => true,
        'cust_name' => true,
        'cust_email' => true,
        'cust_contact' => true,
        'address' => true,
        'tx' => true,
        'tm' => true,
        'esp_tx' => true,
        'esp_tm' => true,
        'ap_tx' => true,
        'ap_tm' => true,
        'ar_tx' => true,
        'ar_tm' => true,
        'ma_tx' => true,
        'ma_tm' => true,
        'kg_total' => true,
        'kg_ilokano' => true,
        'kg_tagalog' => true,
        'kg_pangasinan' => true,
        'kg_ivatan' => true,
        'kg_ibanag' => true,
        'kg_kapampangan' => true,
        'kg_sambal' => true,
        'kg_bikol' => true,
        'kg_binisaya' => true,
        'kg_waray' => true,
        'kg_hiligaynon' => true,
        'kg_kinaraya' => true,
        'kg_akeanon' => true,
        'kg_chavacano' => true,
        'kg_maguindanao' => true,
        'kg_maranao' => true,
        'kg_tausug' => true,
        'kg_surigaonon' => true,
        'kg_yakan' => true,
        'couriercontract' => true,
        'status' => true,
        'dispatch_date' => true,
        'dn' => true,
    ];
}
