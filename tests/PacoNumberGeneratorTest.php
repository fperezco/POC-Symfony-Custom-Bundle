<?php


namespace Paco\CustomPacoBundle\Tests;

use Paco\CustomPacoBundle\PacoNumberGenerator;
use Paco\CustomPacoBundle\MeetingMessageProvider;
use PHPUnit\Framework\TestCase;

class PacoNumberGeneratorTest extends TestCase
{
    public function testGetWords()
    {
        $ipsum = new PacoNumberGenerator(new MeetingMessageProvider());
    }

    public function testGetSentences()
    {
        $ipsum = new PacoNumberGenerator(new MeetingMessageProvider());
    }

    public function testGetParagraphs()
    {
        for ($i = 0; $i < 100; $i++) {
            $ipsum = new PacoNumberGenerator(new MeetingMessageProvider());
        }
    }
}
