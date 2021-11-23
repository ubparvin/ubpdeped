<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceivablesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceivablesTable Test Case
 */
class ReceivablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceivablesTable
     */
    protected $Receivables;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Receivables',
        'app.Users',
        'app.Orders',
        'app.Schools',
        'app.Offices',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Receivables') ? [] : ['className' => ReceivablesTable::class];
        $this->Receivables = $this->getTableLocator()->get('Receivables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Receivables);

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
