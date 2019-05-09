<?php

namespace Acruxx\Educacao\Matricula\Domain\Repository;

use Acruxx\Educacao\Matricula\Domain\Entity\Aluno;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;

interface AlunoRepository
{
    public function getById(IdAluno $id) : Aluno;
}
