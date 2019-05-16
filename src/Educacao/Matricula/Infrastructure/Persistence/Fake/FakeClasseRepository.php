<?php

namespace Acruxx\Educacao\Matricula\Infrastructure\Persistence\Fake;

use Acruxx\Educacao\Matricula\Domain\Repository\ClasseRepository;
use Acruxx\Educacao\Matricula\Domain\Entity\Classe;
use Acruxx\Educacao\Matricula\Domain\ValueObject\IdClasse;
use Ramsey\Uuid\Uuid;

class FakeClasseRepository implements ClasseRepository
{
    public function getById(IdClasse $id) : Classe
    {
        return Classe::populate([
            'id_classe' => Uuid::uuid4()->toString(),
            'nome_classe' => 'Nome classe #' .\rand(1000, 9999),
        ]);
    }

    public function findAll() : array
    {
        $qtyFake = (int)\rand(10, 30);

        $classes = [];
        for ($i=0; $i < $qtyFake; $i++) { 
            $classes[] = Classe::populate([
                'id_classe' => Uuid::uuid4()->toString(),
                'nome_classe' => 'Nome classe #' . $i,
            ]);
        }

        return $classes;
    }
}