<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

use Assert\Assertion;

final class DataMatricula
{
    private $data;

    private function __construct()
    {
    }

    public function toString() : string
    {
        return $this->data->format('Y-m-d H:i:s');
    }

    public function toDateTimeImmutable() : \DateTimeImmutable
    {
        return $this->data;
    }

    public static function dataAtual() : self
    {
        $instance = new self();
        $instance->data = new \DateTimeImmutable('now');

        return $instance;
    }

    public static function fromString(string $data) : self
    {
        Assertion::date($data, 'Y-m-d H:i:s');

        $instance = new self();
        $instance->data = new \DateTimeImmutable($data);

        return $instance;
    }
}
