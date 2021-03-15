<?php


namespace Paco\CustomPacoBundle\Controller;

use Paco\CustomPacoBundle\Event\FilterApiResponseEvent;
use Paco\CustomPacoBundle\Event\PacoNumberGeneratorEvents;
use Paco\CustomPacoBundle\PacoNumberGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class NumberGeneratorApiController extends AbstractController
{
    private $pacoNumberGenerator;

    //Event
    private $eventDispatcher;

    public function __construct(PacoNumberGenerator $pacoNumberGenerator, EventDispatcherInterface $eventDispatcher = null)
    {
        $this->pacoNumberGenerator = $pacoNumberGenerator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function index()
    {

        $data =[
            'number' => $this->pacoNumberGenerator->getNumber(),
        ];
        $event = new FilterApiResponseEvent($data);
        //because maybe there aren't anyone listen to it.
        if($this->eventDispatcher){
            //$this->eventDispatcher->dispatch($event,'paco_number_generator.filter_api');
            $this->eventDispatcher->dispatch($event,PacoNumberGeneratorEvents::FILTER_API);
        }

        return $this->json($event->getData());

        /*return $this->json(
            [
                'number' => $this->pacoNumberGenerator->getNumber(),
            ]
        );*/
    }
}