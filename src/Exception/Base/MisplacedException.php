<?php


namespace App\Exception\Base;


use Throwable;

class MisplacedException extends \Exception
{
    public function __construct(string $message){
        $this->message = $message;
    }
}