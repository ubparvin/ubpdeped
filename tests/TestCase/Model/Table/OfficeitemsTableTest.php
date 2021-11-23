<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfficeitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfficeitemsTable Test Case
 */
class OfficeitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OfficeitemsTable
     */
    protected $Officeitems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Officeitems',
        'app.Schools',
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
        $config = $this->getTableLocator()->exists('Officeitems') ? [] : ['className' => OfficeitemsTable::class];
        $this->Officeitems = $this->getTableLocator()->get('Officeitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Officeitems);

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
