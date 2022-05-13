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

    public static function setUpBeforeClass()
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

    public function testGetDescendantNode(): void
    {
        $property = array('name' => '55555', 'lk' => 3, 'rk' => 8, 'level' => 3);

        $node = new Node;
        $z = $node->prepare($property);
        $result = $this->tree->getDescendantNode($z);

        $this->assertIsObject($result);
        $this->assertIsIterable($result);
    }

}