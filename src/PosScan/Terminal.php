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
     * @var \PosScan\TerminalException
     */
    protected $exception;
    /**
     * @var array
     */
    protected $pricing;

    /**
     * Terminal constructor.
     * @param \PosScan\Quote $quote
     * @param \PosScan\TerminalException $exception
     */
    public function __construct(
        Quote $quote,
        Products $products,
        TerminalException  $exception
    )
    {
        $this->quote = $quote;
        $this->products = $products;
        $this->exception = $exception;
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
        return $this->quote->getTotal();
    }
}