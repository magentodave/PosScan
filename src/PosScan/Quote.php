<?php
/**
 * Created by PhpStorm.
 * User: dmaji
 * Date: 6/7/2019
 * Time: 10:24 PM
 */

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
        return floatval($this->total);
    }
}