<?php

namespace Acruxx\Educacao\Matricula\Domain\Repository;

use Acruxx\Educacao\Matricula\Domain\Entity\Classe;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdClasse;

interface ClasseRepository
{
    public function getById(IdClasse $id) : Classe;
}
