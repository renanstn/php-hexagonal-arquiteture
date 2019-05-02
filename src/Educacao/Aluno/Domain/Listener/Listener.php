<?php

namespace Acruxx\Educacao\Aluno\Domain\Listener;

interface Listener
{
    public function handle($event) : void;
}