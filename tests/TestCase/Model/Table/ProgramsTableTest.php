<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProgramsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProgramsTable Test Case
 */
class ProgramsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProgramsTable
     */
    protected $Programs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Programs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Programs') ? [] : ['className' => ProgramsTable::class];
        $this->Programs = $this->getTableLocator()->get('Programs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Programs);

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
