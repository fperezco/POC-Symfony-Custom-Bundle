<?php


namespace Paco\CustomPacoBundle\Event;


final class PacoNumberGeneratorEvents
{
    /**
     * Called directly before the Lorem Ipsum API data is returned.
     *
     * Listeners have the opportunity to change that data.
     *
     * @Event("Paco\CustomBundle\Event\FilterApiResponseEvent")
     */
    const FILTER_API = 'paco_number_generator.filter_api';
}