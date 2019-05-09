<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

use Acruxx\Educacao\Matricula\Domain\ValueObject\IdMatricula;
use Acruxx\Educacao\Matricula\Domain\ValueObject\StatusMatricula;
use Acruxx\Educacao\Matricula\Domain\ValueObject\DataMatricula;

class Matricula
{
    private $id;
    private $aluno;
    private $classe;
    private $status;
    private $data;

    private function __construct()
    {
        $this->id = IdMatricula::create();
    }

    public function getId() : IdMatricula
    {
        return $this->id;
    }

    public function getAluno() : Aluno
    {
        return $this->aluno;
    }

    public function getClasse() : Classe
    {
        return $this->classe;
    }

    public function getStatus() : StatusMatricula
    {
        return $this->status;
    }

    public function getData() : DataMatricula
    {
        return $this->data;
    }

    public static function nova(Aluno $aluno, Classe $classe) : self
    {
        $instance = new self;
        $instance->aluno    = $aluno;
        $instance->classe   = $classe;
        $instance->status   = StatusMatricula::matriculado();
        $instance->data     = DataMatricula::dataAtual();

        return $instance;
    }

    public static function populate(array $result) : self
    {
        $instance = new self;

        $instance->id       = IdMatricula::fromString($result['id']);
        $instance->status   = StatusMatricula::fromString($result['status']);
        $instance->data     = DataMatricula::fromString($result['data_matricula']);
        $instance->aluno    = Aluno::populate($result);
        $instance->classe   = Classe::populate($result);

        return $instance;
    }
}
