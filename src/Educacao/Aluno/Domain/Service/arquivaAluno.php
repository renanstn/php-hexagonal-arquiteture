<?php

namespace Acruxx\Educacao\Aluno\Domain\Service;

use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;

final class ArquivaAluno
{
    private $alunoRepository;


    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }


    public function arquiva(IdAluno $id) : void
    {
        $aluno = $this->alunoRepository->getById($id);
        $aluno->arquiva();

        $this->alunoRepository->store($aluno);
    }
}
