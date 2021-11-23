<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductimagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductimagesTable Test Case
 */
class ProductimagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductimagesTable
     */
    protected $Productimages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Productimages',
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
        $config = $this->getTableLocator()->exists('Productimages') ? [] : ['className' => ProductimagesTable::class];
        $this->Productimages = $this->getTableLocator()->get('Productimages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Productimages);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
