<?php

namespace Acruxx\Educacao\Matricula\Domain\Entity;

class Matricula
{
    private $id;
    private $aluno;
    private $classe;
    private $status;
    private $data;

    private function __construct()
    {

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
}
