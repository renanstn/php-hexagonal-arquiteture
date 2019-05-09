<?php

namespace Acruxx\Educacao\Matricula\Domain\Repository;

use Acruxx\Educacao\Matricula\Domain\Entity\Matricula;

interface MatriculaRepository
{
    public function store(Matricula $matricula) : void;
}
