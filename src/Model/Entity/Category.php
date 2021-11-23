<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity
{

    protected $_accessible = [
        'name' => true,
        'description' => true,
        'status' => true,
        'products' => true,
    ];
}
