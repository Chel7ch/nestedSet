<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Ugu\NestedSets\Categories;
use Ugu\NestedSets\CheckOfTree;
use Ugu\NestedSets\Node;

class CategoriesTest extends TestCase
{
    public $tree;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Node
     */
    private $stub;

    public static function setUpBeforeClass(): void
    {
        $schema = Capsule::schema();

        $schema->dropIfExists('categories');

        $schema->create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->unsignedInteger('lk');
            $table->unsignedInteger('rk');
            $table->unsignedInteger('level');
        });

        $data = include __DIR__ . '/data/categories.php';

        Capsule::table('categories')->insert($data);
    }

    protected function setUp()
    {
        $this->tree = new Categories();

        $obj = (object)array('id' => 16, 'name' => 01600, 'lk' => 28, 'rk' => 29, 'level' => 4);

        $this->stub = $this->createMock(Node::class);
        $this->stub->method('prepare')
            ->willReturn($obj);
    }

    protected function tearDown()
    {
        $this->tree = NULL;
    }

    public static function tearDownAfterClass(): void
    {
        Capsule::table('categories')->truncate();
    }

    public function testGetTree()
    {
        $check = new CheckOfTree(new Categories);

        $this->assertEmpty($check->leftKeyLessRightKey());
        $this->assertEmpty($check->oddDiffBetweenKeys());
        $this->assertEmpty($check->ifLevelOdd());
        $this->assertEmpty($check->duplicateKey());
        $this->assertEmpty($check->maxRightKey());
    }

    public function nodeProvider(): Generator
    {
        $arr = [
            ['lk' => 2, 'rk' => 32, 'level' => 1],
            ['rk' => 22],
        ];
        foreach ($arr as $query) {
            yield [
                $query,
            ];
        }
    }

    /** @dataProvider nodeProvider */
    public function testGetDescendantNode(array $prop): void
    {
        $result = $this->tree->getDescendantNode($this->stub->prepare($prop));

        $this->assertIsObject($result);
        $this->assertIsIterable($result);
    }

    /** @dataProvider nodeProvider */
    public function testGetDescendant(array $prop): void
    {
        $result = $this->tree->getDescendant($this->stub->prepare($prop));

        $this->assertIsObject($result);
        $this->assertIsIterable($result);
    }

    /** @dataProvider nodeProvider */
    public function testGetAncestorsNode(array $prop): void
    {
        $result = $this->tree->getAncestorsNode($this->stub->prepare($prop));

        $this->assertIsObject($result);
        $this->assertIsIterable($result);
    }

    /** @dataProvider nodeProvider */
    public function testGetAncestors(array $prop): void
    {
        $result = $this->tree->getAncestors($this->stub->prepare($prop));

        $this->assertIsObject($result);
        $this->assertIsIterable($result);
    }


}