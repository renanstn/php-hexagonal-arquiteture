<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

use Assert\Assertion;

final class Nome
{
    private $nome;

    private function __construct()
    {

    }

    public function toString() : string
    {
        return $this->nome;
    }

    public static function fromString(string $nome) : self
    {
        $instance = new self();
        $instance->nome = $nome;

        return $instance;
    }
}
