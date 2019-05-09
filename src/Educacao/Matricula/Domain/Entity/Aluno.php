<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;

class Aluno
{
    private $id;

    public function getId() : IdAluno
    {
        return $this->id;
    }

    public static function populate(array $result) : self
    {
        $instance = new self;

        $instance->id = IdAluno::fromString($result['id_aluno']);

        return $instance;
    }
}
