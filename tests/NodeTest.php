<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Ugu\NestedSets\Node;

class NodeTest extends TestCase
{

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
    }

    public function setUp()
    {
        $data = include __DIR__ . '/data/categories.php';

        Capsule::table('categories')->insert($data);

    }

    public function tearDown()
    {
        Capsule::table('categories')->truncate();
    }

    public function additionProvider(): Generator
    {

        $arr = [
            ['lk' => 2, 'rk' => 32, 'level' => 1],
            ['id' => 2, 'name' => '22222', 'lk' => 2, 'rk' => 9, 'level' => 2],
            ['id' => 3, 'name' => '33333', 'lk' => 10, 'rk' => 23, 'level' => 2],
            ['rk' => 23, 'level' => 2],
            ['rk' => 22],
        ];
        foreach ($arr as $query) {
            yield [
                $query,
            ];
        }
    }

    /** @dataProvider additionProvider */
    public function testPrepare(array $prop): void
    {
        $node = new Node;
        $result = $node->prepare($prop);

        $this->assertNotEmpty($result);
        $this->assertIsObject($result);
    }



}
