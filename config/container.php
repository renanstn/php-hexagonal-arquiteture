<?php

use Acruxx\Educacao\Aluno\Domain\Service\CadastraAluno;
use Acruxx\Educacao\Aluno\Domain\Service\ArquivaAluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Infraestructure\Persistence\Json\JsonAlunoRepository;
use Psr\Container\ContainerInterface;

$container = new \Slim\Container();

$container[CadastraAluno::class] = static function (ContainerInterface $container) {

    $alunoRepository = $container->get(AlunoRepository::class);

    return new CadastraAluno($alunoRepository);
};

$container[ArquivaAluno::class] = static function (ContainerInterface $container) {

    $alunoRepository = $container->get(AlunoRepository::class);

    return new ArquivaAluno($alunoRepository);
};

$container[AlunoRepository::class] = static function() {

    $storageDir  = __DIR__ . '/../data/storage/';
    $storageFile = 'alunos.json';

    return new JsonAlunoRepository($storageDir, $storageFile);
};

return $container;
