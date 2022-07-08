<?php
declare(strict_types=1);

class product
{
    private int $id;
    private String $name;
    private int $price;

    public function __construct(int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }



    public function getProductID():int
    {
        return $this->id;
    }

    public function getProductName():string
    {
        return $this->name;
    }

    public function getProductPrice():int
    {
        return $this->price;
    }


}