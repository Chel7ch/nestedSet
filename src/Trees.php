<?php

namespace Chel7ch\NestedSets;

use Chel7ch\NestedSets\Models\Category;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

abstract class Trees implements TreesI
{
    protected static function getTableName(): string
    {
        return 'categories';
    }

    public function getTree(): object
    {
        return DB::table(self::getTableName())
            ->orderBy('lk')
            ->get();
    }

    public function getDescendantNode($node)
    {
        return DB::table(self::getTableName())
            ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getDescendant($node)
    {
        return DB::table(self::getTableName())
            ->where('lk', '>', $node->lk)
            ->where('rk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestorsNode($node)
    {
        return DB::table(self::getTableName())
            ->where('lk', '<=', $node->lk)
            ->where('rk', '>=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestors($node)
    {
        return DB::table(self::getTableName())
            ->where('lk', '<', $node->lk)
            ->where('rk', '>', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getEntireBranch($node)
    {
        return DB::table(self::getTableName())
            ->where('rk', '>', $node->lk)
            ->where('lk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function createNode($node, $name)
    {

        Capsule::update('UPDATE categories SET rk = rk + 2, lk = 
                     IF(lk > ?, lk + 2, lk) WHERE rk >= ?', [$node->rk, $node->rk]);

        Category::create(['name' => $name,
            'lk' => $node->rk,
            'rk' => $node->rk + 1,
            'level' => $node->level + 1]);
    }

    public function deleteNode($node)
    {
        $diapazon = $node->rk - $node->lk + 1;

        DB::table(self::getTableName())
        ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->delete();

        DB::update(' UPDATE categories SET lk = IF(lk > ?, lk - ?, lk),
                       rk = rk - ? WHERE rk > ?', [$node->lk, $diapazon, $diapazon, $node->rk]);
    }

    public abstract function moveToUp($node, $newParent);


    public abstract function moveToDown($node, $newParent);

}