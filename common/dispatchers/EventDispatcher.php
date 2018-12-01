<?php
namespace app\common\dispatchers;

interface EventDispatcher
{
    public function dispatch(array $events);
}
