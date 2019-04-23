<?php

namespace Acruxx\Educacao\Aluno\Infraestructure\Persistence\Json;

use Acruxx\Educacao\Aluno\Domain\Entity\Aluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\ValueObject\RA;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;

class JsonAlunoRepository implements AlunoRepository
{
    private $storagePath;
    private $fileName;
    private $filePath;


    public function __construct($storagePath, $fileName)
    {
        $this->storagePath  = $storagePath;
        $this->fileName     = $fileName;
        $this->filePath     = $storagePath . $fileName;
    }


    public function store(Aluno $aluno) : void
    {
        $alunos = $this->getJsonDataAsArray();

        $alunoJson = [
            'id'                => $aluno->getId()->toString(),
            'nome'              => $aluno->getNome()->toString(),
            'nome_mae'          => $aluno->getNomeMae()->toString(),
            'ra'                => $aluno->getRa()->toString(),
            'arquivado'         => $aluno->arquivado(),
            'data_arquivado'    => $aluno->getDataArquivado() ? $aluno->getDataArquivado()->format('Y-m-d H:i:s') : null,
        ];

        $alunos[$alunoJson['id']] = $alunoJson;

        \file_put_contents($this->filePath, json_encode($alunos));
    }


    public function getById(IdAluno $id) : Aluno
    {
        $arrAlunos = $this->getJsonDataAsArray();

        foreach ($arrAlunos as $arrAluno) {
            if ($arrAluno['id'] === $id->toString()) {
                return $this->createAlunoFromArray($arrAluno);
            }
        }

        throw new \RuntimeException(
            sprintf('Aluno com ID "%s" não encontrado', $id->toString()
        ));
    }


    public function findByRa(RA $ra) : ?Aluno
    {
        $arrAlunos = $this->getJsonDataAsArray();

        foreach ($arrAlunos as $arrAluno) {
            if ($arrAluno['ra'] === $ra->toString()) {
                return $this->createAlunoFromArray($arrAluno);
            }
        }

        return null;
    }


    public function findAll() : array
    {
        $arrAlunos = $this->getJsonDataAsArray();

        $alunos = [];

        foreach ($arrAlunos as $arrAluno) {
            $alunos[] = $this->createAlunoFromArray($arrAluno);
        }

        return $alunos;
    }


    private function createAlunoFromArray(array $arrAluno) : Aluno
    {
        return Aluno::novoAluno(CadastraAlunoDto::fromArray($arrAluno), $arrAluno);
    }


    private function getJsonDataAsArray() : array
    {
        return (array)\json_decode(file_get_contents($this->filePath), true);
    }
}
