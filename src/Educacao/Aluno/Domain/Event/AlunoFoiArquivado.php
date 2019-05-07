<?php

namespace Acruxx\Educacao\Aluno\Domain\Event;

use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;

final class AlunoFoiArquivado
{
    private $id;

    public function __construct(IdAluno $id)
    {
        $this->id = $id;
    }

    public function getId() : IdAluno
    {
        return $this->id;
    }
}
