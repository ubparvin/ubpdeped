<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SchoolsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SchoolsTable Test Case
 */
class SchoolsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SchoolsTable
     */
    protected $Schools;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Schools',
        'app.Barangays',
        'app.Cities',
        'app.Provinces',
        'app.Regions',
        'app.Officeitems',
        'app.Receivables',
        'app.Receives',
        'app.Schoolitems',
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
        $config = $this->getTableLocator()->exists('Schools') ? [] : ['className' => SchoolsTable::class];
        $this->Schools = $this->getTableLocator()->get('Schools', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Schools);

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
