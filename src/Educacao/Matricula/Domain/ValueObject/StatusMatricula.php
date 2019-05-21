<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

use Assert\Assertion;

final class StatusMatricula
{
    public const MATRICULADO = 'matriculado';

    private $status;

    private function __construct()
    {
    }

    public function toString() : string
    {
        return $this->status;
    }

    public function matriculado() : self
    {
        $instance = new self;
        $instance->status = static::MATRICULADO;
        return $instance;
    }

    public static function fromString(string $status) : self
    {
        Assertion::inArray($status, [
            static::MATRICULADO
        ]);

        $instance = new self();
        $instance->status = $status;

        return $instance;
    }
}
