<?php

use Acruxx\Educacao\Aluno\Domain\Service\CadastraAluno;
use Acruxx\Educacao\Aluno\Domain\Service\ArquivaAluno;
use Acruxx\Educacao\Aluno\Domain\Repository\AlunoRepository;
use Acruxx\Educacao\Aluno\Infrastructure\Persistence\Json\JsonAlunoRepository;
use Acruxx\Educacao\Aluno\Infrastructure\Persistence\PdoPgSql\PdoPgSqlRepository;
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

$container[AlunoRepository::class] = static function(ContainerInterface $container) {

    /* $storageDir  = __DIR__ . '/../data/storage/';
    $storageFile = 'alunos.json';

    return new JsonAlunoRepository($storageDir, $storageFile); */

    return new PdoPgSqlRepository($container->get('pdo-connection'));
};

$container['pdo-connection'] = static function () {
    $pdo = new \PDO('pgsql:host=postgres;dbname=php;user=root;password=123');
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  
    return $pdo;
  };

return $container;
