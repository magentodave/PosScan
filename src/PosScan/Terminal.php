<?php
namespace PosScan;

use PosScan\TerminalException;
use PosScan\Quote;
use PosScan\Item;
use PosScan\Products;

class Terminal
{
    /**
     * @var \PosScan\Quote
     */
    protected $quote;
    /**
     * @var array
     */
    protected $pricing;

    /**
     * Terminal constructor.
     */
    public function __construct()
    {
        $this->quote = new Quote();
        $this->products = new Products();
    }

    /**
     * @param string $item
     */
    public function scan(string $scanned)
    {
        try {
            $this->addItem($scanned);

        } catch (TerminalException $exception){
            echo $exception->getMessage();
        }
    }

    /**
     * Update the Item Price based on Step/Discount
     */
    private function checkDiscount()
    {
        $i=1;
        foreach($this->quote->getItems() as $item){

            if($this->products->getProductStep($item->getName()) === $i){

                $newPrice = $this->products->getProductDiscount($item->getName()) / $this->products->getProductStep($item->getName());

                $this->quote->updatePrice($item->getName(), $newPrice);
            }
            $i++;
        }
    }

    /**
     * @param $scanned
     * @throws \PosScan\TerminalException
     */
    private function addItem($scanned)
    {
        if(!$this->products->isExist($scanned)){
            throw new TerminalException('Item not found.');
        }
        $item = new Item();
        $item->setPrice($this->products->getProductPrice($scanned));
        $item->setName($scanned);
        $this->quote->add($item);
    }

    /**
     * @param array $pricing
     */
    public function setPricing(array $pricing)
    {
        $this->products->load($pricing);
    }

    /**
     * @return float
     */
    public function total()
    {
        $this->checkDiscount();

        return $this->quote->getTotal();
    }
}