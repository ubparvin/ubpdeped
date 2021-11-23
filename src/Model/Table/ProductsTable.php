<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\SubcategoriesTable&\Cake\ORM\Association\BelongsTo $Subcategories
 * @property \App\Model\Table\TaggingsTable&\Cake\ORM\Association\BelongsTo $Taggings
 * @property \App\Model\Table\OfficeitemsTable&\Cake\ORM\Association\HasMany $Officeitems
 * @property \App\Model\Table\ProductimagesTable&\Cake\ORM\Association\HasMany $Productimages
 * @property \App\Model\Table\PurchasesTable&\Cake\ORM\Association\HasMany $Purchases
 * @property \App\Model\Table\SchoolitemsTable&\Cake\ORM\Association\HasMany $Schoolitems
 *
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
		
        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
            'joinType' => 'INNER',
        ]);

		$this->belongsTo('Subitems', [
            'foreignKey' => 'subitems_id',
            'joinType' => 'INNER',
        ]);
		
        $this->belongsTo('Taggings', [
            'foreignKey' => 'tagging_id',
            'joinType' => 'INNER',
        ]);

		$this->belongsTo('Programs', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER',
        ]);
		
		$this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER',
        ]);
		
        $this->hasMany('Transactions', [
            'foreignKey' => 'product_id',
        ]);

		$this->hasMany('Officeitems', [
            'foreignKey' => 'product_id',
        ]);
		
		$this->hasMany('Distributionitems', [
            'foreignKey' => 'product_id',
        ]);
		
		$this->hasMany('Requests', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasOne('Productimages', [
            'foreignKey' => 'product_id',
        ]);
        $this->hasMany('Purchases', [
            'foreignKey' => 'product_id',
        ]);
		
        $this->hasMany('Schoolitems', [
            'foreignKey' => 'product_id',
        ]);
		
		$this->hasMany('Productseries', [
            'foreignKey' => 'product_id',
        ]);
    }


    public function validationDefault(Validator $validator): Validator
    {
        $validator->requirePresence([
			//'sku' 				=> ['mode' => 'create', 'message' => 'SKU is required'],
			'name' 				=> ['mode' => 'create', 'message' => 'Item name is required'],
			'category_id' 		=> ['mode' => 'create', 'message' => 'Category is required'],
			'subcategory_id' 	=> ['mode' => 'create', 'message' => 'Sub Category is required'],
			'tagging_id' 		=> ['mode' => 'create', 'message' => 'Tagging is required'],
			'program_id' 		=> ['mode' => 'create', 'message' => 'Program is required'],
			'subitem_id' 		=> ['mode' => 'create', 'message' => 'Sub-item is required'],
			//'vendor_id' 		=> ['mode' => 'create', 'message' => 'Vendor is required'],
			'label' 			=> ['mode' => 'create', 'message' => 'Item label is required'],
			'brand' 			=> ['mode' => 'create', 'message' => 'Item brand is required'],
			'part_number' 		=> ['mode' => 'create', 'message' => 'Part number is required'],
			'qty' 				=> ['mode' => 'create', 'message' => 'Quantity is required'],
			'on_hand' 			=> ['mode' => 'create', 'message' => 'Quantity on hand is required'],
			'date_received' 	=> ['mode' => 'create', 'message' => 'Date received is required'],
			//'warranty_expires' 	=> ['mode' => 'create', 'message' => 'Warranty expires is required'],
			'added' 			=> ['mode' => 'create', 'message' => 'Date created is required'],
			//'modified' 			=> ['mode' => 'update', 'message' => 'Date modified is required'],
			'added_by' 			=> ['mode' => 'create', 'message' => 'Author is required'],
			//'modified_by' 		=> ['mode' => 'update', 'message' => 'Author is required']
		]);
				
        $validator->integer('id')->allowEmptyString('id', null, 'create');

        $validator->integer('program_id')->notEmptyString('program_id', 'Program is required');
		$validator->scalar('sku')->maxLength('sku', 15)->allowEmptyString('sku');
		$validator->scalar('subname')->allowEmptyString('subname');
        $validator->scalar('category_id')->notEmptyString('category_id', 'Category is required');
        $validator->scalar('name')->notEmptyString('name', 'Item name is required');
        $validator->scalar('label')->maxLength('label', 64)->notEmptyString('label', 'Item label is required');
        $validator->scalar('brand')->maxLength('brand', 35)->notEmptyString('brand', 'Item brand is required');
        $validator->scalar('part_number')->maxLength('part_number', 35)->notEmptyString('part_number', 'Part number is required');
        $validator->scalar('vendor_id')->allowEmptyString('vendor_id');
        $validator->scalar('tagging_id')->notEmptyString('tagging_id', 'Tagging is required');
        $validator->scalar('subcategory_id')->notEmptyString('subcategory_id', 'Sub-category is required');
        $validator->scalar('subitem_id')->notEmptyString('subitem_id', 'Sub-item is required');
		
		$validator->date('expiration')->allowEmptyDateTime('expiration', 'create');
		$validator->date('warranty_expiration')->allowEmptyDateTime('warranty_expiration', 'create');
		$validator->scalar('qty')->notEmptyString('qty', 'Quantity is required');
		$validator->scalar('on_hand')->notEmptyString('on_hand', 'Quantity on hand is required');
		$validator->scalar('good_condition')->allowEmptyString('good_condition', null, 'create');
		$validator->scalar('has_defect')->allowEmptyString('has_defect', null, 'create');
		$validator->dateTime('date_received')->notEmptyString('date_received', 'Date received is required');
		$validator->scalar('status')->notEmptyString('status', 'Status is required');
		//$validator->dateTime('added')->notEmptyString('added', 'Date received is required')->allowEmptyDateTime('date_received', 'create');
		//$validator->scalar('added_by')->notEmptyString('added_by', 'Date received is required')->allowEmptyDateTime('date_received', 'create');
		//$validator->dateTime('modified')->notEmptyString('modified', 'Date received is required')->allowEmptyDateTime('date_received', 'create');
		//$validator->scalar('modified_by')->notEmptyString('modified_by', 'Date received is required')->allowEmptyDateTime('date_received', 'create');
		
        return $validator;
    }

   
    public function buildRules(RulesChecker $rules): RulesChecker
    {
       /*$rules->add($rules->isUnique(
			['name'],
			'The same information might already exists. Please check the details again.'
		));*/
	
	   $rules->add($rules->isUnique(['name', 'subname', 'category_id', 'tagging_id']), 'The same item with the same category & tagging already exists');
	   
        return $rules;
    }
}
