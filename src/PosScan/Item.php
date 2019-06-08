<?php
namespace PosScan;


class Item
{
    /**
     * @var
     */
    protected $price;
    /**
     * @var
     */
    protected $name;

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return floatval($this->price);
    }
}
