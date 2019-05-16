<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Assert\Assertion;

final class IdAluno
{
    private $id;

    private function __construct()
    {
    }

    public function toString() : string
    {
        return $this->id;
    }

    public static function fromString(string $id) : self
    {
        Assertion::string($id);
        Assertion::notBlank($id);

        $instance = new self();
        $instance->id = $id;

        return $instance;
    }
}
