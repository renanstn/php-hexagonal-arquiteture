<?php

namespace Acruxx\Educacao\Aluno\Domain\Repository;

use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\RA;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;

interface AlunoRepository
{
    public function store(Aluno $aluno) : void;

    public function getById(idAluno $id) : Aluno;

    public function findByRa(RA $ra) : ?Aluno;

    /**
     * @return Aluno
     */
    public function findAll() : array;
}
