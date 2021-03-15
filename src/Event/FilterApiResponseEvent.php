<?php


namespace Paco\CustomPacoBundle\Event;


use Symfony\Component\EventDispatcher\EventDispatcher;

class FilterApiResponseEvent extends EventDispatcher
{
    private $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function getData(): array
    {
        return $this->data;
    }
    public function setData(array $data)
    {
        $this->data = $data;
    }
}