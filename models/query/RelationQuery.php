<?php

namespace app\models\query;

use app\models\Relation;

/**
 * This is the ActiveQuery class for [[\app\models\Relation]].
 *
 * @see \app\models\Relation
 */
class RelationQuery extends ActiveQuery
{
    public function variable()
    {
        return $this->andWhere([$this->field('var') => Relation::VAR]);
    }

    public function count($q = '*', $db = null)
    {
        $this->variable();
        return parent::count($q, $db);
    }

    public function all($db = null)
    {
        $this->variable();
        return parent::all($db);
    }

    public function one($db = null)
    {
        $this->variable();
        return parent::one($db);
    }

    public function sum($q, $db = null) 
    {
        $this->variable();
        return parent::sum($q, $db);
    }

    public function average($q, $db = null) 
    {
        $this->variable();
        return parent::average($q, $db);
    }

    public function min($q, $db = null) 
    {
        $this->variable();
        return parent::min($q, $db);
    }

    public function max($q, $db = null) 
    {
        $this->variable();
        return parent::max($q, $db);
    }
}
