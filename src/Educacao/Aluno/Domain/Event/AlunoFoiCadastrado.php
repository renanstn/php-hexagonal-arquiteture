<?php

namespace Acruxx\Educacao\Aluno\Domain\Event;

use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\Nome;

final class AlunoFoiCadastrado
{
    private $id;
    private $nome;

    public function __construct(IdAluno $id, Nome $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId() : IdAluno
    {
        return $this->id;
    }

    public function getNome() : Nome
    {
        return $this->nome;
    }
}
