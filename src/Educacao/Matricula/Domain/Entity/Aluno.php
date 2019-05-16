<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Matricula\Domain\ValueObject\Nome;

class Aluno
{
    private $id;
    private $nome;

    public function getId() : IdAluno
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

        $instance->id = IdAluno::fromString($result['id_aluno']);
        $instance->nome = Nome::fromString($result['nome_aluno']);

        return $instance;
    }
}
