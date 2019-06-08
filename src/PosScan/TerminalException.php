<?php
namespace PosScan;

class TerminalException extends \Exception
{
    /**
     * TerminalException constructor.
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
