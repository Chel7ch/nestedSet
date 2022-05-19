<?php

namespace Ugu\NestedSets;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;

abstract class Trees implements ITrees
{
    protected $tableName ='categories';

    public function getTree()
    {
        return Capsule::table($this->tableName)
            ->orderBy('lk')
            ->get();
    }

    public function getNode($key, $value): object
    {
        return Capsule::table($this->tableName)
            ->where($key, $value)
            ->first();
    }

    public function getDescendantNode($node):Collection
    {
        return Capsule::table($this->tableName)
            ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getDescendant($node): Collection
    {
        return Capsule::table($this->tableName)
            ->where('lk', '>', $node->lk)
            ->where('rk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestorsNode($node): Collection
    {
        return Capsule::table($this->tableName)
            ->where('lk', '<=', $node->lk)
            ->where('rk', '>=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getAncestors($node): Collection
    {
        return Capsule::table($this->tableName)
            ->where('lk', '<', $node->lk)
            ->where('rk', '>', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function getEntireBranch($node): Collection
    {
        return Capsule::table($this->tableName)
            ->where('rk', '>', $node->lk)
            ->where('lk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    public function createNode($node, $name)
    {
        Capsule::update("UPDATE $this->tableName SET rk = rk + 2, lk = 
                     IF(lk > ?, lk + 2, lk) WHERE rk >= ?", [$node->rk, $node->rk]);

        Capsule::table($this->tableName)->insert([
            'name' => $name,
            'lk' => $node->rk,
            'rk' => $node->rk + 1,
            'level' => $node->level + 1
        ]);
    }

    public function deleteNode($node): void
    {
        $spread = $node->rk - $node->lk + 1;

        Capsule::table($this->tableName)
            ->where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->delete();

        Capsule::update("UPDATE $this->tableName SET lk = IF(lk > ?, lk - ?, lk), rk = rk - ? WHERE rk > ?",
            [$node->lk, $spread, $spread, $node->rk]);
    }

    public function renameNode($node, $newName): void
    {
        Capsule::table($this->tableName)
            ->where('lk', $node->lk)
            ->orWhere('rk', $node->rk)
            ->orWhere('id', $node->id)
            ->update(['name' => $newName]);
    }

    public function cleanTree(): void
    {
        Capsule::table($this->tableName)->truncate();
    }

    abstract public function moveToUp($node, $newParent);

    abstract public function moveToDown($node, $newParent);

}