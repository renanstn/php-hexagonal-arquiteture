<?php

namespace Acruxx\Educacao\Matricula\Infrastructure\Persistence\Component;

use Acruxx\Educacao\Matricula\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Matricula\Domain\Entity\Aluno;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository as AlunoRepositoryFromComponent;
use Acruxx\Educacao\Aluno\Domain\Entity\Aluno as AlunoFromComponent;

class ComponentAlunoRepository implements AlunoRepository
{
    private $alunoRepositoryFromComponent;

    public function __construct(AlunoRepositoryFromComponent $alunoRepositoryFromComponent)
    {
        $this->alunoRepositoryFromComponent = $alunoRepositoryFromComponent;
    }

    public function getById(IdAluno $id) : Aluno
    {
        return Aluno::populate(['id_aluno' => '123']);
    }

    public function findAll() : array
    {
        $alunosFromComponent = $this->alunoRepositoryFromComponent->findAll();

        foreach ($alunosFromComponent as $alunoFromComponent) {
            $alunos[] = $this->convertFromComponentAlunoToMatricula($alunoFromComponent);
        }

        return $alunos;
    }

    private function convertFromComponentAlunoToMatricula(AlunoFromComponent $alunoFromComponent) : Aluno
    {
        return Aluno::populate(['id_aluno' => $alunoFromComponent->getId()->toString()]);
    }
}
