<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Assert\Assertion;

final class IdClasse
{
    private $id;

    private function __construct()
    {
    }

    public function toString() : string
    {
        return $this->id->toString();
    }

    public function fromString(string $id) : self
    {
        Assertion::notBlank($id);

        $instance = new self;
        $instance->id = Uuid::fromString($id);

        return $instance;
    }
}
