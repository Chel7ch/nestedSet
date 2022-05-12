<?php

namespace Ugu\NestedSets;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\DB;

class Categories extends Trees
{
    public function moveNode($node, $newParent): void
    {
        if ($node->lk > $newParent->lk) {
            $this->moveToUp($node, $newParent);
        }elseif ($node->lk < $newParent->lk) {
            $this->moveToDown($node, $newParent);
        }
//        throw new \InvalidArgumentException("Parameters of the parent and child nodes are the same");
    }

    public function moveToUp($node, $newParent)
    {
        $nodeVolume = $node->rk - $node->lk + 1;
        $offset = $newParent->lk - $node->lk + 1;
        $offsetLevel = $newParent->level - $node->level + 1;
        $arr = $this->prepareIn($node);

        $in = str_repeat('?,', count($arr) - 1) . '?';
        array_unshift($arr, $offsetLevel, $offset, $offset);

        Capsule::update("UPDATE $this->tableName SET rk = IF(rk < ? AND rk > ?,rk + ?,rk),
                      lk = IF(lk < ? AND lk > ?,lk + ?,lk)",
            [
                $node->lk,
                $newParent->lk,
                $nodeVolume,
                $node->lk,
                $newParent->lk,
                $nodeVolume
            ]);

        Capsule::update("UPDATE $this->tableName SET level = level+?,
                      lk=lk+?, rk=rk+? WHERE id IN($in)", $arr);

    }

    public function moveToDown($node, $newParent)
    {
        $nodeVolume = $node->rk - $node->lk + 1;
        $offsetDown = $newParent->lk - $node->lk + 1 - $nodeVolume;
        $offsetLevel = $newParent->level - $node->level + 1;
        $arr = $this->prepareIn($node);

        $in = str_repeat('?,', count($arr) - 1) . '?';
        array_unshift($arr, $offsetLevel, $offsetDown, $offsetDown);

        Capsule::update("UPDATE $this->tableName SET rk = IF(rk <= ? AND rk > ?,rk - ?,rk),
                      lk = IF(lk <= ? AND lk > ?,lk - ?,lk)",
            [
                $newParent->lk,
                $node->rk,
                $nodeVolume,
                $newParent->lk,
                $node->rk,
                $nodeVolume]);

        Capsule::update("UPDATE $this->tableName SET level = level+?, lk=lk+?, rk=rk+? WHERE id IN($in)", $arr);

    }

    private function prepareIn($node)
    {
        foreach ($this->getDescendantNode($node) as $item) {
            $arr[] = $item->id;
        }
        return $arr;
    }

}