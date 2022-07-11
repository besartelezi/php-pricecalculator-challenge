<?php
declare(strict_types=1);

class CustomerGroup
{
    private int $id;
    private string $name;
    private int $parentID;
    private int $fixedDiscount;
    private int $variableDiscount;

    public function __construct(int $id, string $name, int $parentID, int $fixedDiscount, int $variableDiscount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentID = $parentID;
        $this->fixedDiscount = $fixedDiscount;
        $this->variableDiscount = $variableDiscount;
    }

    public function getCustomerGroupID () {
        return $this->id;
    }

    public function getCustomerGroupName () {
        return $this->name;
    }

    public function getCustomerGroupParentID () {
        return $this->parentID;
    }

    public function getCustomerGroupFixedDiscount () {
        return $this->fixedDiscount;
    }

    public function getCustomerGroupVariableDiscount () {
        return $this->variableDiscount;
    }
}