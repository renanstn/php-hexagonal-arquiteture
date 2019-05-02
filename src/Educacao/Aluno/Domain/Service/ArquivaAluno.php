<?php

namespace Acruxx\Educacao\Aluno\Domain\Service;

use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\Event\Dispatcher;

final class ArquivaAluno
{
    private $alunoRepository;
    private $dispatcher;


    public function __construct(AlunoRepository $alunoRepository, Dispatcher $dispatcher)
    {
        $this->alunoRepository = $alunoRepository;
        $this->dispatcher = $dispatcher;
    }


    public function arquiva(IdAluno $id) : void
    {
        $aluno = $this->alunoRepository->getById($id);
        $aluno->arquiva();

        $this->alunoRepository->store($aluno);

        $this->dispatcher->dispatch($aluno->releaseEvents());
    }
}
