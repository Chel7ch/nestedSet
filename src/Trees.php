<?php

namespace src;

use Illuminate\Database\Capsule\Manager as Capsule;
use src\models\Category;

abstract class Trees implements TreesI
{

//1. само дерево:
    public function getTree()
    {
        return Category::select()
            ->orderBy('lk')
            ->get();
    }

//2. Выбор подчиненных узлов с узлом
    public function getDescendantNode($node)
    {
        return Category::where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    //2.1 Выбор потомков узла
    public function getDescendant($node)
    {
        return Category::where('lk', '>', $node->lk)
            ->where('rk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    //3. Выбор родительской "ветки":
    public function getAncestorsNode($node)
    {
        return Category::where('lk', '<=', $node->lk)
            ->where('rk', '>=', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    //3. Выбор родительской "ветки":
    public function getAncestors($node)
    {
        return Category::where('lk', '<', $node->lk)
            ->where('rk', '>', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    //4. Выбор ветки в которой участвует наш узел:
    public function getEntireBranch($node)
    {
        return Category::where('rk', '>', $node->lk)
            ->where('lk', '<', $node->rk)
            ->orderBy('lk')
            ->get();
    }

    //6. СОЗДАНИЕ УЗЛА:
    public function createNode($node, $name)
    {

        Capsule::update('UPDATE categories SET rk = rk + 2, lk = 
                     IF(lk > ?, lk + 2, lk) WHERE rk >= ?',[$node->rk,$node->rk]);

        Category::create(['name' => $name,
            'lk' => $node->rk,
            'rk' => $node->rk + 1,
            'level' => $node->level + 1]);
    }

    //7.УДАЛЕНИЕ УЗЛА c потомками
    public function deleteNode($node)
    {
        $diapazon = $node->rk - $node->lk + 1;

        Category::where('lk', '>=', $node->lk)
            ->where('rk', '<=', $node->rk)
            ->delete();

        Capsule::update(' UPDATE categories SET lk = IF(lk > ?, lk - ?, lk),
                       rk = rk - ? WHERE rk > ?',[$node->lk,$diapazon,$diapazon,$node->rk]);


    }

    public abstract function moveToUp($node, $newParent);


    public abstract function moveToDown($node, $newParent);

}