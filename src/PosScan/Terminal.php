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
            echo $exception->getMessage() . "\n";
        }
    }

    /**
     * Update the Item Price based on Step/Discount
     */
    private function checkDiscount()
    {
        $i=1;
        $u=0;
        foreach($this->quote->getItems() as $key=>$item){
            if($this->quote->getItemCount($item->getName()) >= $this->products->getProductStep($item->getName())){
                $newPrice = $this->products->getProductDiscount($item->getName()) / $this->products->getProductStep($item->getName());
                if($u < $this->products->getProductStep($item->getName())){
                    $this->quote->updatePrice($key, $newPrice);
                    $u++;
                } else {
                    $u=0;
                }
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
