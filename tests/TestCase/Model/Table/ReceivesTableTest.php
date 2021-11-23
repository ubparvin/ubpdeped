<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReceivesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReceivesTable Test Case
 */
class ReceivesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReceivesTable
     */
    protected $Receives;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Receives',
        'app.Receiveables',
        'app.Schools',
        'app.Offices',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Receives') ? [] : ['className' => ReceivesTable::class];
        $this->Receives = $this->getTableLocator()->get('Receives', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Receives);

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
