<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdClasse;
use Acruxx\Educacao\Matricula\Domain\ValueObject\Nome;

class Classe
{
    private $id;
    private $nome;

    public function getId() : IdClasse
    {
        return $this->id;
    }

    public function getNome() : Nome
    {
        return $this->nome;
    }

    public static function populate(array $result) : self
    {
        $instance = new self;

        $instance->id = IdClasse::fromString($result['id_classe']);
        $instance->nome = Nome::fromString($result['nome_classe']);

        return $instance;
    }
}
