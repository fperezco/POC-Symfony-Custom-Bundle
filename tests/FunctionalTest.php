<?php


namespace Paco\CustomPacoBundle\Tests;



use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
    }
}

class KnpULoremIpsumTestingKernel extends Kernel
{
    public function registerBundles()
    {
    }
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}