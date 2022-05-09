<?php


namespace src;

use Illuminate\Database\Capsule\Manager as Capsule;

class Schema
{
    public function clean()
    {
        Capsule::table('categories')->truncate();

        Capsule::table('categories')->insert([
            ['id' => 1, 'name' => '11111', 'lk' => 1, 'rk' => 32, 'level' => 1],
            ['id' => 2, 'name' => '22222', 'lk' => 2, 'rk' => 9, 'level' => 2],
            ['id' => 3, 'name' => '33333', 'lk' => 10, 'rk' => 23, 'level' => 2],
            ['id' => 4, 'name' => '44444', 'lk' => 24, 'rk' => 31, 'level' => 2],
            ['id' => 5, 'name' => '55555', 'lk' => 3, 'rk' => 8, 'level' => 3],
            ['id' => 6, 'name' => '66666', 'lk' => 11, 'rk' => 12, 'level' => 3],
            ['id' => 7, 'name' => '77777', 'lk' => 13, 'rk' => 20, 'level' => 3],
            ['id' => 8, 'name' => '88888', 'lk' => 21, 'rk' => 22, 'level' => 3],
            ['id' => 9, 'name' => '99999', 'lk' => 25, 'rk' => 30, 'level' => 3],
            ['id' => 10, 'name' => '01000', 'lk' => 4, 'rk' => 5, 'level' => 4],
            ['id' => 11, 'name' => '01101', 'lk' => 6, 'rk' => 7, 'level' => 4],
            ['id' => 12, 'name' => '01200', 'lk' => 14, 'rk' => 15, 'level' => 4],
            ['id' => 13, 'name' => '01300', 'lk' => 16, 'rk' => 17, 'level' => 4],
            ['id' => 14, 'name' => '01400', 'lk' => 18, 'rk' => 19, 'level' => 4],
            ['id' => 15, 'name' => '01500', 'lk' => 26, 'rk' => 27, 'level' => 4],
            ['id' => 16, 'name' => '01600', 'lk' => 28, 'rk' => 29, 'level' => 4],
        ]);
    }
}
