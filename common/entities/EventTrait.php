<?php
namespace app\common\entities;


trait EventTrait
{
    private $events = [];
    protected function recordEvent($event): void
    {
        $this->events[] = $event;
    }
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}