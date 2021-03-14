<?php


namespace Paco\CustomPacoBundle\Controller;

use Paco\CustomPacoBundle\PacoNumberGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NumberGeneratorApiController extends AbstractController
{
    private $pacoNumberGenerator;

    public function __construct(PacoNumberGenerator $pacoNumberGenerator)
    {
        $this->pacoNumberGenerator = $pacoNumberGenerator;
    }

    public function index()
    {
        return $this->json(
            [
                'number' => $this->pacoNumberGenerator->getNumber(),
            ]
        );
    }
}