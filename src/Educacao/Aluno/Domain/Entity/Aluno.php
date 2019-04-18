<?php

namespace Acruxx\Educacao\Aluno\Domain\Entity;

use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\Nome;
use Acruxx\Educacao\Aluno\Domain\ValueObject\Nomemae;
use Acruxx\Educacao\Aluno\Domain\ValueObject\RA;

class Aluno
{
    /** @var IdAluno */
    private $id;

    /** @var Nome */
    private $nome;

    /** @var RA */
    private $ra;

    /** @var NomeMae */
    private $nomeMae;

    /** @var bool */
    private $arquivado;

    /** @var \DateTimeImmutable|null */
    private $dataArquivado;


    private function __construct()
    {

    }

    /**
     * @return IdAluno
     */
    public function getId(): IdAluno
    {
        return $this->id;
    }

    /**
     * @return Nome
     */
    public function getNome(): Nome
    {
        return $this->nome;
    }

    /**
     * @return RA
     */
    public function getRa(): RA
    {
        return $this->ra;
    }

    /**
     * @return NomeMae
     */
    public function getNomeMae(): NomeMae
    {
        return $this->nomeMae;
    }


    public function arquiva() : void
    {
        $this->arquivado        = true;
        $this->dataArquivado    = new \DateTimeImmutable();
    }


    public static function novoAluno(CadastraAlunoDto $cadastraAlunoDto) : self
    {
        $instance = new self();

        $instance->id       = IdAluno::newInstance();
        $instance->nome     = $cadastraAlunoDto->getNome();
        $instance->ra       = $cadastraAlunoDto->getRa();
        $instance->nomeMae  = $cadastraAlunoDto->getNomeMae();

        return $instance;
    }
}