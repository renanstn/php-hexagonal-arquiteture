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
}
