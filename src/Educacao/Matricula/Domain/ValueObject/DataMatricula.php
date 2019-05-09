<?php

namespace Acruxx\Educacao\Matricula\Domain\ValueObject;

final class DataMatricula
{
    private $data;

    private function __construct()
    {
    }

    public function toString() : string
    {
        return $this->id->format('Y-m-d H:i:s');
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
}
