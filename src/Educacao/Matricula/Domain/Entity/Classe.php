<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdClasse;

class Classe
{
    private $id;

    public function getId() : IdClasse
    {
        return $this->id;
    }

    public static function populate(array $result) : self
    {
        $instance = new self;

        $instance->id = IdClasse::fromString($result['id_classe']);

        return $instance;
    }
}
