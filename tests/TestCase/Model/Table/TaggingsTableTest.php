<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaggingsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaggingsTable Test Case
 */
class TaggingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TaggingsTable
     */
    protected $Taggings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Taggings',
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
        $config = $this->getTableLocator()->exists('Taggings') ? [] : ['className' => TaggingsTable::class];
        $this->Taggings = $this->getTableLocator()->get('Taggings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Taggings);

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
