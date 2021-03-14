<?php


namespace Paco\CustomPacoBundle;


use Paco\CustomPacoBundle\Interfaces\MeetingMessageProviderInterface;

class MeetingMessageProvider implements MeetingMessageProviderInterface
{
    public function getWordList(): array
    {
        return [
            'Hi adorable ',
            'Hi active ',
            'Hi admire ',
            'Hi adventurous ',
            'Hi agreeable ',
        ];
    }
}