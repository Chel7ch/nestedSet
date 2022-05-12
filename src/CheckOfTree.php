<?php

namespace Ugu\NestedSets;

class CheckOfTree
{

    private $trees;


    public function __construct(ITrees $tree)
    {
        $this->trees = $tree->getTree();
    }

    public function leftKeyLessRightKey(): array
    {
        $err = array();
        foreach ($this->trees as $item) {
            if ($item->lk < $item->rk) {
                continue;
            }
            $err[] = $item->id;
        }
        return $err;
    }

    public function maxRightKey(): bool
    {
        return $this->trees->max('rk') / $this->trees->count() !== 2;
    }

    public function oddDiffBetweenKeys(): array
    {
        $err = array();
        foreach ($this->trees as $item) {
            if (($item->rk - $item->lk) % 2) {
                continue;
            }
            $err[] = $item->id;
        }
        return $err;
    }

    public function ifLevelOdd(): array
    {
        $err = array();
        foreach ($this->trees as $item) {
            if (!(($item->lk - $item->level + 2) % 2)) {
                continue;
            }
            $err[] = $item->id;
        }
        return $err;
    }

    public function duplicateKey(): array
    {
        foreach ($this->trees as $item) {
            $duplicates[] = $item->lk;
            $duplicates[] = $item->rk;
        }
        return array_unique(
            array_diff_assoc($duplicates, array_unique($duplicates)));
    }

    private function message($array): string
    {
        return implode(', ', $array);
    }

    public function inspect(): void
    {


        if ($this->maxRightKey()) {
            throw new \InvalidArgumentException("the max right
                 key is not equal to the number of nodes multiplied by 2");
        }

        $id = array_unique(array_merge($this->leftKeyLessRightKey(),
                 $this->oddDiffBetweenKeys(), $this->ifLevelOdd()));
        sort($id);

        if ($this->ifLevelOdd()) {
            throw new \InvalidArgumentException('node with id ' .
                $this->message($id) .
                ': the right or left key of node isn t correct.'
            );
        }
        if ($this->duplicateKey()) {
            throw new \InvalidArgumentException('left or right keys ' .
                $this->message($this->duplicateKey()) . ' duplicated'
            );
        }
    }
}
