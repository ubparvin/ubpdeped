<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Vendor extends Entity
{
    
    protected $_accessible = [
        'name' => true,
        'refid' => true,
        'operatedby' => true,
        'mobile_no' => true,
        'tel_no' => true,
        'email' => true,
        'contact_person' => true,
        'license_no' => true,
        'license_expires' => true,
        'brgyCode' => true,
        'citymunCode' => true,
        'provCode' => true,
        'regCode' => true,
        'sitio' => true,
        'address' => true,
        'added' => true,
        'added_by' => true,
        'modified' => true,
        'modified_by' => true,
        'status' => true,
        'barangay' => true,
        'city' => true,
        'province' => true,
        'region' => true,
        'orders' => true,
        'products' => true,
        'couriercontracts' => true,
    ];
}
