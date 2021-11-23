<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubcategoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubcategoriesTable Test Case
 */
class SubcategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubcategoriesTable
     */
    protected $Subcategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Subcategories',
        'app.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subcategories') ? [] : ['className' => SubcategoriesTable::class];
        $this->Subcategories = $this->getTableLocator()->get('Subcategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Subcategories);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
