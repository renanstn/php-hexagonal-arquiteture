<?php

namespace Acruxx\Educacao\Aluno\Domain\Event;

use Acruxx\Educacao\Aluno\Domain\Listener\Listener;

interface Dispatcher
{
    public function attach(string $eventName, Listener $listener) : void;
    public function dispatch(array $events) : void;
}
