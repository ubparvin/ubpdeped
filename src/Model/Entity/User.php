<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
	protected function _setPassword($value){
		if(strlen($value)){
			$hasher = new DefaultPasswordHasher(); 
			return $hasher->hash($value);
		}
	}

    protected $_accessible = [
        'group_id' => true,
        'role_id' => true,
        'school_id' => true,
        'warehouse_id' => true,
        'office_id' => true,
        'courier_id' => true,
        'diststaging_id' => true,
        'firstname' => true,
        'middlename' => true,
        'lastname' => true,
        'birthdate' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'mobile_no' => true,
        'school_office' => true,
        'emergency_name' => true,
        'emergency_contact' => true,
        'brgyCode' => true,
        'citymunCode' => true,
        'provCode' => true,
        'regCode' => true,
        'address' => true,
        'sitio' => true,
        'added' => true,
        'added_by' => true,
        'modified' => true,
        'modified_by' => true,
        'last_access' => true,
        'status' => true,
        'group' => true,
        'role' => true,
        'school' => true,
        'warehouse' => true,
        'office' => true,
        'barangay' => true,
        'city' => true,
        'region' => true,
        'province' => true,
        'payments' => true,
        'receivables' => true,
        'receives' => true,
        'vendors' => true,
        'couriers' => true,
		'diststagings' => true
    ];
}
