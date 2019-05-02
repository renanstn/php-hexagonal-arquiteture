<?php

namespace Acruxx\Educacao\Aluno\Domain\Service;

use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\Event\Dispatcher;

class CadastraAluno
{
    private $alunoRepository;
    private $dispatcher;

    public function __construct(alunoRepository $alunoRepository, Dispatcher $dispatcher)
    {
        $this->alunoRepository = $alunoRepository;
        $this->dispatcher = $dispatcher;
    }


    public function cadastra(CadastraAlunoDto $cadastraAlunoDto) : void
    {
        $ra = $cadastraAlunoDto->getRa();

        if ($this->alunoRepository->findByRA($ra) !== null) {
            throw new \DomainException(sprintf('Aluno com RA %s já existe', $ra->toString()));
        }

        $aluno = Aluno::novoAluno($cadastraAlunoDto);

        $this->alunoRepository->store($aluno);

        $this->dispatcher->dispatch($aluno->releaseEvents());
    }
}
