<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;
use Ugu\NestedSets\Node;

class NodeTest extends TestCase
{

    private $node;

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
        $this->node = new Node;
    }

    protected function tearDown()
    {
        $this->node = NULL;
    }

    public static function tearDownAfterClass(): void
    {
        Capsule::table('categories')->truncate();
    }

    public function nodeProvider(): Generator
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

    /** @dataProvider nodeProvider */
    public function testPrepare(array $prop): void
    {
        $result = $this->node->prepare($prop);

        $this->assertNotEmpty($result);
        $this->assertIsObject($result);
    }

    public function errorProvider(): Generator
    {
        $arr = [
            [],
            ['level' => 2],
            ['name' => '33333', 'level' => 2],
            ['name' => '55555'],
            'aa'
        ];
        foreach ($arr as $query) {
            yield [
                $query,
            ];
        }
    }

    /** @dataProvider errorProvider */
    public function testExeption($prop): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->node->prepare($prop);
    }
}