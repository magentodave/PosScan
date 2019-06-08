<?php
namespace PosScan;

use PosScan\Item;

class Quote
{
    /**
     * @var
     */
    protected $total;
    /**
     * @var
     */
    protected $items;
    /**
     * @param \PosScan\Item $item
     */
    public function add(Item $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        $return = [];
        foreach ($this->items as $item){
            $return[] = $item->getPrice();
        }

        return number_format(array_sum($return), 2);
    }

    /**
     * @return mixed
     */
    protected function getItemsByName(string $name)
    {
        $return = [];
        foreach ($this->items as $item){
            if($item->getName() === $name){
                $return[] = $item;
            }
        }

        return $return;
    }

    /**
     * @return mixed
     */
    public function getItems(string $name = null)
    {
        if(!is_null($name)){
            return $this->getItemsByName($name);
        }

        return $this->items;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getItemCount(string $name)
    {
        $return = [];
        foreach ($this->items as $item){
            if($item->getName() === $name){
                $return[] = $item->getName();
            }
        }
        $counts = array_count_values($return);

        return $counts[$name];
    }

    /**
     * @return bool
     */
    public function isItemsExist()
    {
        return (count($this->items) > 0) ? true : false;
    }
    /**
     * @param $name
     * @param $price
     */
    public function updatePrice($key, $price)
    {
        $this->items[$key]->setPrice($price);
    }
}
