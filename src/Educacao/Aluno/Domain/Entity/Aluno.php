<?php

namespace Acruxx\Educacao\Aluno\Domain\Entity;

use Acruxx\Educacao\Aluno\Domain\Dto\CadastraAlunoDto;
use Acruxx\Educacao\Aluno\Domain\ValueObject\IdAluno;
use Acruxx\Educacao\Aluno\Domain\ValueObject\Nome;
use Acruxx\Educacao\Aluno\Domain\ValueObject\Nomemae;
use Acruxx\Educacao\Aluno\Domain\ValueObject\RA;
use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiCadastrado;
use Acruxx\Educacao\Aluno\Domain\Event\AlunoFoiArquivado;

class Aluno extends Entity
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

    public function arquivado() : bool
    {
        return (bool)$this->arquivado;
    }

    public function getDataArquivado() : ?\DateTimeImmutable
    {
        return $this->dataArquivado;
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

        $this->raise(new AlunoFoiArquivado($this->id));
    }


    public static function novoAluno(CadastraAlunoDto $cadastraAlunoDto, array $arrAluno=[]) : self
    {
        $instance = new self();

        $instance->id       = IdAluno::newInstance();
        $instance->nome     = $cadastraAlunoDto->getNome();
        $instance->ra       = $cadastraAlunoDto->getRa();
        $instance->nomeMae  = $cadastraAlunoDto->getNomeMae();

        if (isset($arrAluno['id'])) {
            $instance->id = IdAluno::fromString($arrAluno['id']);
        }

        if (isset($arrAluno['arquivado'])) {
            $instance->arquivado = $arrAluno['arquivado'];
        }

        if (isset($arrAluno['data_arquivado'])) {
            $instance->dataArquivado = new \DateTimeImmutable($arrAluno['data_arquivado']);
        }

        if (!count($arrAluno)) {
            $instance->raise(new AlunoFoiCadastrado(
                $instance->id,
                $instance->nome
            ));
        }

        return $instance;
    }
}
