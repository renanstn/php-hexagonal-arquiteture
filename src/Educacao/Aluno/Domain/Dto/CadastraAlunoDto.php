<?php

namespace Acruxx\Educacao\Aluno\Domain\Dto;

use Acruxx\Educacao\Aluno\Domain\ValueObject\Nome;
use Acruxx\Educacao\Aluno\Domain\ValueObject\RA;
use Acruxx\Educacao\Aluno\Domain\ValueObject\NomeMae;
use Assert\Assertion;

class CadastraAlunoDto
{
    private $nome;
    private $ra;
    private $nomeMae;


    private function __construct()
    {

    }


    public function getNome(): Nome
    {
        return $this->nome;
    }


    public function getRa(): RA
    {
        return $this->ra;
    }


    public function getNomeMae(): NomeMae
    {
        return $this->nomeMae;
    }


    public static function fromArray(array $params) : self
    {
        Assertion::keyIsset($params, 'nome');
        Assertion::keyIsset($params, 'ra');
        Assertion::keyIsset($params, 'nome_mae');

        $instance = new self();

        $instance->nome     = Nome::fromString($params['nome']);
        $instance->ra       = RA::fromString($params['ra']);
        $instance->nomeMae  = nomeMae::fromString($params['nome_mae']);

        return $instance;
    }
}
