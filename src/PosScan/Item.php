<?php
/**
 * Created by PhpStorm.
 * User: dmaji
 * Date: 6/7/2019
 * Time: 10:24 PM
 */

namespace PosScan;


class Item
{
    /**
     * @var
     */
    public $price;
    /**
     * @var
     */
    public $name;

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
     * @param $price
     * @return float
     */
    public function getPrice()
    {
        return floatval($this->price);
    }
}