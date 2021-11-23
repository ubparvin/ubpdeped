<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubitemsTable Test Case
 */
class SubitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubitemsTable
     */
    protected $Subitems;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Subitems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subitems') ? [] : ['className' => SubitemsTable::class];
        $this->Subitems = $this->getTableLocator()->get('Subitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Subitems);

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
