<?php

namespace Acruxx\Educacao\Matricula\Domain\Service;

use Acruxx\Educacao\Matricula\Domain\Repository\MatriculaRepository;
use Acruxx\Educacao\Matricula\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Matricula\Domain\Repository\ClasseRepository;
use Acruxx\Educacao\Matricula\Domain\Entity\Matricula;

final class MatriculaAluno
{
    private $matriculaRepository;
    private $alunoRepository;
    private $classeRepository;

    public function __construct(
        MatriculaRepository $matriculaRepository,
        AlunoRepository $alunoRepository,
        ClasseRepository $classeRepository
    ) {
        $this->matriculaRepository = $matriculaRepository;
        $this->alunoRepository = $alunoRepository;
        $this->classeRepository = $classeRepository;
    }

    public function matricula(MatriculaAlunoDto $matriculaAlunoDto) : void
    {
        $aluno = $this->alunoRepository->getById($matriculaAlunoDto->getIdAluno());
        $classe = $this->classeRepository->getById($matriculaAlunoDto->getIdClasse());

        $matricula = Matricula::nova($aluno, $classe);

        $this->matriculaRepository->store($matricula);
    }
}
