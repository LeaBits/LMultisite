<?php


namespace App\Exception\Base;


use Throwable;

class MisplacedException implements \Throwable
{
    private $message;

    public function __construct(string $message){
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getFile()
    {
        // TODO: Implement getFile() method.
    }

    public function getLine()
    {
        // TODO: Implement getLine() method.
    }

    public function getTrace()
    {
        // TODO: Implement getTrace() method.
    }

    public function getTraceAsString()
    {
        // TODO: Implement getTraceAsString() method.
    }

    public function getPrevious()
    {
        // TODO: Implement getPrevious() method.
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}