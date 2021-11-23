<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $tagging_id
 * @property string $sku
 * @property string $name
 * @property int|null $qty
 * @property int|null $on_hand
 * @property string|null $program
 * @property string|null $subitem
 * @property \Cake\I18n\FrozenTime|null $date_received
 * @property string|null $location
 * @property string|null $lifespan
 * @property \Cake\I18n\FrozenDate|null $warranty_expires
 * @property string|null $maintenance
 * @property \Cake\I18n\FrozenTime $added
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Subcategory $subcategory
 * @property \App\Model\Entity\Tagging $tagging
 * @property \App\Model\Entity\Officeitem[] $officeitems
 * @property \App\Model\Entity\Productimage[] $productimages
 * @property \App\Model\Entity\Purchase[] $purchases
 * @property \App\Model\Entity\Schoolitem[] $schoolitems
 */
class Product extends Entity
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
        'category_id' => true,
        'subcategory_id' => true,
        'subitem_id' => true,
        'program_id' => true,
        'tagging_id' => true,
        'vendor_id' => true,
        'refid' => true,
        'sku' => true,
        'name' => true,
        'subname' => true,
        'label' => true,
        'brand' => true,
        'qty' => true,
        'on_hand' => true,
        'good_condition' => true,
        'has_defect' => true,
        'program' => true,
        'date_received' => true,
        'location' => true,
        'lifespan' => true,
        'warranty_expires' => true,
        'maintenance' => true,
        'added' => true,
        'added_by' => true,
        'modified' => true,
        'modified_by' => true,
        'note' => true,
        'category' => true,
        'subcategory' => true,
        'subitem' => true,
        'tagging' => true,
        'officeitems' => true,
        'productimages' => true,
        'purchases' => true,
        'schoolitems' => true,
        'vendor' => true,
        'requests' => true,
        'transactions' => true,
        'distributions' => true,
        'productseries' => true
    ];
}
