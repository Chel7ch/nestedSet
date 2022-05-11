<?php

namespace Chel7ch\NestedSets;

class Node
{
    public function prepare($prop)
    {
        if (!empty($prop['id']) &&
            null !== $node = $this->query('id', $prop['id'])) {
            return $node;
        }
        if (!empty($prop['lk']) &&
            null !== $node = $this->query('lk', $prop['lk'])) {
            return $node;
        }
        if (!empty($prop['rk']) &&
            null !== $node = $this->query('rk', $prop['rk'])) {
            return $node;
        }
        throw new \InvalidArgumentException("Missing or wrong  input parameters ");
    }

    public function query($key, $value)
    {
        return Trees::getNode($key, $value);
    }

}