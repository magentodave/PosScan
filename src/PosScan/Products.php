<?php
namespace PosScan;


class Products
{
    const PRICING_NAME     = 'name';
    const PRICING_PRICE    = 'price';
    const PRICING_STEP     = 'step';
    const PRICING_DISCOUNT = 'discount';
    /**
     * @var
     */
    public $products;

    /**
     * @param array $products
     */
    public function load(array $products)
    {
        foreach($products as $product){
            $this->products[$product[self::PRICING_NAME]][self::PRICING_PRICE]    = $product[self::PRICING_PRICE] ?? (float) 0.00;
            $this->products[$product[self::PRICING_NAME]][self::PRICING_STEP]     = $product[self::PRICING_STEP] ?? 1;
            $this->products[$product[self::PRICING_NAME]][self::PRICING_DISCOUNT] = $product[self::PRICING_DISCOUNT] ?? $this->products[$product[self::PRICING_NAME]][self::PRICING_PRICE];
        }
    }
    public function isExist($name)
    {
        return (true === isset($this->products[$name]));
    }
    /**
     * @param $name
     * @return mixed
     */
    public function getProductPrice($name){
        return $this->products[$name][self::PRICING_PRICE];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getProductStep($name){
        return $this->products[$name][self::PRICING_STEP];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getProductDiscount($name){
        return $this->products[$name][self::PRICING_DISCOUNT];
    }
}