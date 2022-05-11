<?php

namespace Chel7ch\NestedSets;

use Illuminate\Support\Facades\DB;

abstract class Trees implements ITrees
{
    protected $tableName ='categories';

    public function getTree()
    {
        return DB::table($this->tableName)
            ->orderBy('lk')
            ->get();
    }

    public static function getNode($key, $value): object
    {
        return DB::table('categories')
            ->where($key, $value)
            ->first();
    }

    public function getDescendantNode($node)
    {
        return DB::table($this->tableName)
            ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getDescendant($node)
    {
        return DB::table($this->tableName)
            ->where('lk', '>', $node->lk)
            ->where('rk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestorsNode($node)
    {
        return DB::table($this->tableName)
            ->where('lk', '<=', $node->lk)
            ->where('rk', '>=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestors($node)
    {
        return DB::table($this->tableName)
            ->where('lk', '<', $node->lk)
            ->where('rk', '>', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getEntireBranch($node)
    {
        return DB::table($this->tableName)
            ->where('rk', '>', $node->lk)
            ->where('lk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function createNode($node, $name)
    {
        DB::update("UPDATE $this->tableName SET rk = rk + 2, lk = 
                     IF(lk > ?, lk + 2, lk) WHERE rk >= ?", [$node->rk, $node->rk]);

        DB::table($this->tableName)->insert([
            'name' => $name,
            'lk' => $node->rk,
            'rk' => $node->rk + 1,
            'level' => $node->level + 1
        ]);
    }

    public function deleteNode($node)
    {
        $spread = $node->rk - $node->lk + 1;

        DB::table($this->tableName)
            ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->delete();

        DB::update("UPDATE $this->tableName SET lk = IF(lk > ?, lk - ?, lk), rk = rk - ? WHERE rk > ?",
            [$node->lk, $spread, $spread, $node->rk]);
    }

    public function renameNode($node, $newName)
    {
        DB::table($this->tableName)
            ->where('lk', $node->lk)
            ->orWhere('rk', $node->rk)
            ->orWhere('id', $node->id)
            ->update(['name' => $newName]);
    }

    public function cleanTree()
    {
        DB::table($this->tableName)->truncate();
    }

    abstract public function moveToUp($node, $newParent);

    abstract public function moveToDown($node, $newParent);

}